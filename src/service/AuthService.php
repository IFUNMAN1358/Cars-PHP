<?php

namespace src\service;

use Exception;
use src\exception\InvalidUserDataException;

class AuthService {

    /**
     * @throws InvalidUserDataException
     * @throws Exception
     */
    public static function registration($requestBody): array
    {
        $user = UserService::createUser($requestBody);
        $tokens = JwtService::generateJwtTokens($user);
        return [
            "user" => $user,
            "jwt" => $tokens
        ];
    }

    /**
     * @throws InvalidUserDataException
     * @throws Exception
     */
    public static function login($requestBody): array
    {
        $user = UserService::getUser($requestBody);
        $tokens = JwtService::generateJwtTokens($user);
        return [
            "user" => $user,
            "jwt" => $tokens
        ];
    }

}