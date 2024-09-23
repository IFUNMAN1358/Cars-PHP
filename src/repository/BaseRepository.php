<?php

namespace src\repository;
use Exception;
use PDO;
use PDOStatement;
use src\database\Database;

class BaseRepository {

    /* @throws Exception */
    private static function executeQuery(string $sql, array $values): PDOStatement
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($values);
        return $stmt;
    }

    /* @throws Exception */
    public static function getFirst(string $sql, array $values): ?array
    {
        $stmt = self::executeQuery($sql, $values);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    /* @throws Exception */
    public static function getAll(string $sql, array $values): array
    {
        $stmt = self::executeQuery($sql, $values);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* @throws Exception */
    public static function save(string $sql, array $values): int
    {
        self::executeQuery($sql, $values);
        $pdo = Database::getConnection();
        return (int) $pdo->lastInsertId();
    }

    /* @throws Exception */
    public static function update(string $sql, array $values): void
    {
        self::executeQuery($sql, $values);
    }

    /* @throws Exception */
    public static function delete(string $sql, array $values): void
    {
        self::executeQuery($sql, $values);
    }
}