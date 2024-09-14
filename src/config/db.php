<?php

use src\config\Env;

/**
 * @throws Exception
 */
function connect_db() {
    $dsn = "mysql:host=" . Env::$dbHost . ";port=" . Env::$dbPort . ";dbname=" . Env::$dbName . ";charset=" . Env::$dbCharset;
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, Env::$dbUser, Env::$dbPass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}