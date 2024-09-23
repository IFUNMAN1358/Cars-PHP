<?php

namespace src\service;

use Exception;
use src\database\Database;
use src\exception\RoleNotFoundException;
use src\exception\UserAlreadyExistsException;
use src\exception\UserNotFoundException;
use src\repository\RoleRepository;
use src\repository\UserRepository;

class UserService {

    /**
     * @throws UserAlreadyExistsException
     * @throws RoleNotFoundException
     * @throws Exception
     */
    public static function createUser($data) {
        return Database::beginTransaction(function() use ($data) {

            $existingUser = UserRepository::getUserByEmailOrPhone($data['email'], $data['phone']);
            if ($existingUser) {
                throw new UserAlreadyExistsException();
            }

            $userId = UserRepository::saveUser(
                $data['firstName'],
                $data['lastName'],
                $data['phone'],
                $data['email'],
                password_hash($data['password'], PASSWORD_BCRYPT)
            );

            $role = RoleRepository::getRoleByName('ROLE_USER');
            if (!$role) {
                throw new RoleNotFoundException();
            }
            RoleRepository::assignRoleToUser($userId, $role['id']);

            $user = UserRepository::getUserById($userId);
            $user['roles'] = RoleRepository::getUserRolesById($userId);
            return $user;
        });
    }

    /**
     * @throws UserNotFoundException
     * @throws Exception
     */
    public static function getUser($data): array
    {

        $id = $data['userId'] ?? null;
        $email = $data['email'] ?? null;
        $phone = $data['phone'] ?? null;

        $user = UserRepository::getUserByIdOrEmailOrPhone($id, $email, $phone);
        if (!$user) {
            throw new UserNotFoundException();
        }

        $user['roles'] = RoleRepository::getUserRolesById($user['id']);
        return $user;
    }

    /**
     * @throws UserNotFoundException
     * @throws Exception
     */
    public static function updateUserFullName($userId, $data): void {
        $user = UserRepository::getUserById($userId);
        if (!$user) {
            throw new UserNotFoundException();
        }
        UserRepository::updateUserFirstNameAndLastName($userId, $data["firstName"], $data["lastName"]);
    }

    /**
     * @throws UserNotFoundException
     * @throws Exception
     */
    public static function updateUserEmail($userId, $data): void {
        $user = UserRepository::getUserById($userId);
        if (!$user) {
            throw new UserNotFoundException();
        }
        UserRepository::updateUserEmail($userId, $data["email"]);
    }

    /**
     * @throws UserNotFoundException
     * @throws Exception
     */
    public static function updateUserPhone($userId, $data): void {
        $user = UserRepository::getUserById($userId);
        if (!$user) {
            throw new UserNotFoundException();
        }
        UserRepository::updateUserPhone($userId, $data["phone"]);
    }

    /**
     * @throws UserNotFoundException
     * @throws Exception
     */
    public static function updateUserPassword($userId, $data): void {
        $user = UserRepository::getUserById($userId);
        if (!$user) {
            throw new UserNotFoundException();
        }
        UserRepository::updateUserPassword($userId, password_hash($data['newPassword'], PASSWORD_BCRYPT));
    }

    /**
     * @throws UserNotFoundException
     * @throws Exception
     */
    public static function deleteUser($userId,): void {
        $user = UserRepository::getUserById($userId);
        if (!$user) {
            throw new UserNotFoundException();
        }
        UserRepository::deleteUser($userId);
    }

}