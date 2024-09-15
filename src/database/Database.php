<?php

namespace src\database;

use Exception;
use PDO;
use PDOException;
use src\config\Env;

class Database {

    private static $pdo = null;

    /**
     * @throws Exception
     */
    public static function getConnection() {
        if (self::$pdo === null) {
            $dsn = "mysql:host=" . Env::$dbHost . ";port=" . Env::$dbPort . ";dbname=" . Env::$dbName . ";charset=" . Env::$dbCharset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                self::$pdo = new PDO($dsn, Env::$dbUser, Env::$dbPass, $options);
            } catch (PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        }
        return self::$pdo;
    }

    /**
     * @throws Exception
     */
    public static function beginTransaction(callable $callback) {
        $pdo = self::getConnection();
        try {
            $pdo->beginTransaction();
            $result = $callback($pdo);
            $pdo->commit();

            return $result;
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }
    }
}