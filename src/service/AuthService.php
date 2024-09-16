<?php

namespace src\service;

use Exception;
use src\dto\UserRequest;
use src\dto\UserResponse;
use src\exception\IncorrectPasswordException;
use src\exception\InvalidUserDataException;

class AuthService {

    /**
     * @throws InvalidUserDataException
     * @throws Exception
     */
    public static function registration($requestBody): array
    {
        if (!UserRequest::validateRegisterData($requestBody)) {
            throw new InvalidUserDataException();
        }

        $user = UserService::createUser($requestBody);
        return [
            "user" => UserResponse::map($user),
            "jwt" => JwtService::generateJwtTokens($user)
        ];
    }

    /**
     * @throws InvalidUserDataException
     * @throws Exception
     */
    public static function login($requestBody): array
    {
        if (!UserRequest::validateLoginData($requestBody)) {
            throw new InvalidUserDataException();
        }

        $user = UserService::getUser($requestBody);

        if (!password_verify($requestBody['password'], $user['password'])) {
            throw new IncorrectPasswordException();
        }

        return [
            "user" => UserResponse::map($user),
            "jwt" => JwtService::generateJwtTokens($user)
        ];
    }

}