<?php

namespace src\repository;

use Exception;

class UserRepository extends BaseRepository {

    public static function saveUser($first_name, $last_name, $phone, $email, $password): ?int {
        try {
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
        } catch (Exception) {
            return null;
        }
    }

    public static function getUserById($userId) {
        try {
            return self::getFirst(
                "SELECT * FROM users WHERE id = :user_id",
                [':user_id' => $userId]
            );
        } catch (Exception) {
            return null;
        }
    }

    public static function getUserByEmail($email) {
        try {
            return self::getFirst(
                "SELECT * FROM users WHERE email = :email",
                [':email' => $email]
            );
        } catch (Exception) {
            return null;
        }
    }

    public static function getUserByEmailOrPhone($email, $phone) {
        try {
            return self::getFirst(
                "SELECT * FROM users WHERE email = :email OR phone = :phone",
                [':email' => $email, ':phone' => $phone]
            );
        } catch (Exception) {
            return null;
        }
    }

    public static function getUserByIdOrEmailOrPhone($id, $email, $phone) {
        try {
            return self::getFirst(
                "SELECT * FROM users WHERE id = :id OR email = :email OR phone = :phone",
                [':id' => $id, ':email' => $email, ':phone' => $phone]
            );
        } catch (Exception) {
            return null;
        }
    }

    public static function getUserRolesById($userId): ?array {
        try {
            $roles = self::getAll(
                "SELECT r.name FROM roles r
                     JOIN role_user ru ON r.id = ru.role_id
                     WHERE ru.user_id = :user_id",
                [':user_id' => $userId]
            );
            return array_column($roles, 'name');
        } catch (Exception) {
            return null;
        }
    }

    public static function assignRoleToUser($userId, $roleId): ?int {
        try {
            return self::save(
                "INSERT INTO role_user (user_id, role_id) VALUES (:user_id, :role_id)",
                [
                    ':user_id' => $userId,
                    ':role_id' => $roleId
                ]
            );
        } catch (Exception) {
            return null;
        }
    }
}