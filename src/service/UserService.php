<?php

namespace src\service;

use src\database\Database;
use src\dto\user\UserDto;
use src\exception\InvalidUserDataException;
use src\exception\RoleNotFoundException;
use src\repository\RoleRepository;
use src\repository\UserRepository;
use Exception;

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

            return UserRepository::getUserById($userId);
        });
    }
}