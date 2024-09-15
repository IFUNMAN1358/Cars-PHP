<?php

namespace src\repository;
use Exception;

class RoleRepository extends BaseRepository
{
    /**
     * @throws Exception
     */
    public static function saveRole($name) {
        return self::save(
            "INSERT INTO roles (name) VALUES (:name)",
            [":name" => $name]
        );
    }

    /**
     * @throws Exception
     */
    public static function getRoleByName($name) {
        return self::get(
            "SELECT * FROM roles WHERE name = :name",
            [":name" => $name]
        );
    }
}