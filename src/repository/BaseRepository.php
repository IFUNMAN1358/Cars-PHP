<?php

namespace src\repository;
use Exception;
use PDO;
use src\database\Database;

class BaseRepository {

    /**
     * @throws Exception
    */
    public static function save(string $sql, array $values): int
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($values);
        return $pdo->lastInsertId();
    }

    /**
     * @throws Exception
     */
    public static function getFirst(string $sql, array $values) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($values);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @throws Exception
     */
    public static function getAll(string $sql, array $values): bool|array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($values);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}