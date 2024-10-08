<?php

namespace src\repository;

use Exception;

class UserRepository extends BaseRepository {

    /* @throws Exception */
    public static function getUserById($userId): ?array
    {
        return self::getFirst(
            "SELECT * FROM users WHERE id = :user_id",
            [':user_id' => $userId]
        );
    }

    /* @throws Exception */
    public static function getUserByEmailOrPhone($email, $phone): ?array
    {
        return self::getFirst(
            "SELECT * FROM users WHERE email = :email OR phone = :phone",
            [':email' => $email, ':phone' => $phone]
        );
    }

    /* @throws Exception */
    public static function getUserByIdOrEmailOrPhone($id, $email, $phone): ?array
    {
        return self::getFirst(
            "SELECT * FROM users WHERE id = :id OR email = :email OR phone = :phone",
            [':id' => $id, ':email' => $email, ':phone' => $phone]
        );
    }

    /* @throws Exception */
    public static function saveUser($first_name, $last_name, $phone, $email, $password): int {
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

    /* @throws Exception */
    public static function updateUserFirstNameAndLastName($userId, $firstName, $lastName): void {
        self::update(
            "UPDATE users 
                SET first_name = :first_name, last_name = :last_name
                WHERE id = :id",
            [
                ':id' => $userId,
                ':first_name' => $firstName,
                ':last_name' => $lastName
            ]
        );
    }

    /* @throws Exception */
    public static function updateUserEmail($userId, $email): void {
        self::update(
            "UPDATE users SET email = :email WHERE id = :id",
            [':id' => $userId, ':email' => $email]
        );
    }

    /* @throws Exception */
    public static function updateUserPhone($userId, $phone): void {
        self::update(
            "UPDATE users SET phone = :phone WHERE id = :id",
            [':id' => $userId, ':phone' => $phone]
        );
    }

    /* @throws Exception */
    public static function updateUserPassword($userId, $password): void {
        self::update(
            "UPDATE users SET password = :password WHERE id = :id",
            [':id' => $userId, ':password' => $password]
        );
    }

    /* @throws Exception */
    public static function deleteUser($userId): void {
        self::delete(
            "DELETE FROM users WHERE id = :id",
            [':id' => $userId]
        );
    }

}