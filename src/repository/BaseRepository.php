<?php

namespace src\repository;
use Exception;
use PDO;
use src\database\Database;

class BaseRepository {

    /**
     * @throws Exception
    */
    public static function save($sql, array $values) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($values);
        return $pdo->lastInsertId();
    }

    /**
     * @throws Exception
     */
    public static function get($sql, array $values) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($values);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}