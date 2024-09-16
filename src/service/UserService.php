<?php

namespace src\service;

use Exception;
use src\database\Database;
use src\dto\UserDto;
use src\exception\IncorrectPasswordException;
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
    public static function createUser($requestBody) {
        return Database::beginTransaction(function() use ($requestBody) {

            if (!UserDto::validateRegisterData($requestBody)) {
                throw new InvalidUserDataException();
            }

            $existingUser = UserRepository::getUserByEmailOrPhone($requestBody['email'], $requestBody['phone']);
            if ($existingUser) {
                throw new UserAlreadyExistsException();
            }

            $userId = UserRepository::saveUser(
                $requestBody['firstName'],
                $requestBody['lastName'],
                $requestBody['phone'],
                $requestBody['email'],
                password_hash($requestBody['password'], PASSWORD_BCRYPT)
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
     * @throws InvalidUserDataException
     * @throws Exception
     */
    public static function getUser($requestBody) {
        if (!UserDto::validateLoginData($requestBody)) {
            throw new InvalidUserDataException();
        }

        $email = $requestBody['email'] ?? null;
        $phone = $requestBody['phone'] ?? null;

        $user = UserRepository::getUserByEmailOrPhone($email, $phone);
        if (!$user) {
            throw new UserNotFoundException();
        }

        if (!password_verify($requestBody['password'], $user['password'])) {
            throw new IncorrectPasswordException();
        }

        $user['roles'] = UserRepository::getUserRolesById($user['id']);
        return $user;
    }

}