<?php

namespace src\repository;
use Exception;

class RoleRepository extends BaseRepository
{
    /* @throws Exception */
    public static function getUserRolesById($userId): array {
        $roles = self::getAll(
            "SELECT r.name FROM roles r
                 JOIN role_user ru ON r.id = ru.role_id
                 WHERE ru.user_id = :user_id",
            [':user_id' => $userId]
        );
        return array_column($roles, 'name');
    }

    /* @throws Exception */
    public static function assignRoleToUser($userId, $roleId): int {
        return self::save(
            "INSERT INTO role_user (user_id, role_id) VALUES (:user_id, :role_id)",
            [':user_id' => $userId, ':role_id' => $roleId]);
    }

    /* @throws Exception */
    public static function saveRole(string $name): int
    {
        return self::save(
            "INSERT INTO roles (name) VALUES (:name)",
            [":name" => $name]
        );
    }

    /* @throws Exception */
    public static function getRoleByName(string $name): ?array
    {
        return self::getFirst(
            "SELECT * FROM roles WHERE name = :name",
            [":name" => $name]
        );
    }
}