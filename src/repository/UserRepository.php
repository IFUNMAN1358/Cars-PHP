<?php

namespace src\repository;

use Exception;

class UserRepository extends BaseRepository
{
    /**
     * @throws Exception
     */
    public static function saveUser($first_name, $last_name, $phone, $email, $password): int
    {
        return self::save(
            "INSERT INTO users (first_name, last_name, phone, email, password)
                VALUES (:first_name, :last_name, :phone, :email, :password)",
            [
                ':first_name' => $first_name,
                ':last_name' => $last_name,
                ':phone' => $phone,
                ':email' => $email,
                ':password' => $password,
            ]
        );
    }

    /**
     * @throws Exception
     */
    public static function getUserById($userId)
    {
        return self::getFirst(
            "SELECT * FROM users WHERE id = :user_id",
            [':user_id' => $userId]
        );
    }

    /**
     * @throws Exception
     */
    public static function getUserByEmail($email)
    {
        return self::getFirst(
            "SELECT * FROM users WHERE email = :email",
            [':email' => $email]
        );
    }

    /**
     * @throws Exception
     */
    public static function getUserByEmailOrPhone($email, $phone)
    {
        return self::getFirst(
            "SELECT * FROM users WHERE email = :email OR phone = :phone",
            [':email' => $email, ':phone' => $phone]
        );
    }


    /**
     * @throws Exception
     */
    public static function getUserRolesById($userId): array
    {
        $roles = self::getAll(
            "SELECT r.name FROM roles r
                 JOIN role_user ru ON r.id = ru.role_id
                 WHERE ru.user_id = :user_id",
            [':user_id' => $userId]
        );
        return array_column($roles, 'name');
    }

    /**
     * @throws Exception
     */
    public static function assignRoleToUser($userId, $roleId): int
    {
        return self::save(
            "INSERT INTO role_user (user_id, role_id) VALUES (:user_id, :role_id)",
            [
                ':user_id' => $userId,
                ':role_id' => $roleId
            ]
        );
    }
}