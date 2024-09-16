<?php

namespace src\repository;
use Exception;

class RoleRepository extends BaseRepository
{
    /**
     * @throws Exception
     */
    public static function saveRole(string $name): int
    {
        return self::save(
            "INSERT INTO roles (name) VALUES (:name)",
            [":name" => $name]
        );
    }

    /**
     * @throws Exception
     */
    public static function getRoleByName(string $name)
    {
        return self::getFirst(
            "SELECT * FROM roles WHERE name = :name",
            [":name" => $name]
        );
    }
}