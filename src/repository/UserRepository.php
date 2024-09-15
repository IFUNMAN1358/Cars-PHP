<?php

namespace src\repository;

use Exception;

class UserRepository extends BaseRepository
{
    /**
     * @throws Exception
     */
    public static function saveUser($first_name, $last_name, $phone, $email, $password) {
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
    public static function getUserById($userId) {
        return self::get(
            "SELECT * FROM users WHERE id = :id",
            [':id' => $userId]
        );
    }

    /**
     * @throws Exception
     */
    public static function assignRoleToUser($userId, $roleId) {
        return self::save(
            "INSERT INTO role_user (user_id, role_id) VALUES (:user_id, :role_id)",
            [
                ':user_id' => $userId,
                ':role_id' => $roleId
            ]
        );
    }
}