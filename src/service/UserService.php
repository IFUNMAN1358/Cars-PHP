<?php

namespace src\service;

use Exception;
use src\database\Database;
use src\exception\InvalidUserDataException;
use src\exception\RoleNotFoundException;
use src\exception\UserAlreadyExistsException;
use src\exception\UserNotFoundException;
use src\repository\RoleRepository;
use src\repository\UserRepository;

class UserService {

    /**
     * @throws InvalidUserDataException
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
            UserRepository::assignRoleToUser($userId, $role['id']);

            $user = UserRepository::getUserById($userId);
            $user['roles'] = UserRepository::getUserRolesById($userId);
            return $user;
        });
    }

    /**
     * @throws UserNotFoundException
     */
    public static function getUser($data) {

        $id = $data['userId'] ?? null;
        $email = $data['email'] ?? null;
        $phone = $data['phone'] ?? null;

        $user = UserRepository::getUserByIdOrEmailOrPhone($id, $email, $phone);
        if (!$user) {
            throw new UserNotFoundException();
        }

        $user['roles'] = UserRepository::getUserRolesById($user['id']);
        return $user;
    }

}