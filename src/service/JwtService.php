<?php

namespace src\service;

use src\repository\JwtRepository;

class JwtService {

    public static function generateJwtTokens($user): array
    {
        $accessToken = JwtRepository::encodeAccessToken([
            "userId" => $user['id'],
            "roles" => $user['roles']
        ]);
        $refreshToken = JwtRepository::encodeRefreshToken([
            "userId" => $user['id']
        ]);
        return ["accessToken" => $accessToken, "refreshToken" => $refreshToken];
    }

    public static function validateAccessToken(array $accessToken): bool
    {
        $requiredFields = ['userId', 'roles', 'exp'];
        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $accessToken)) {
                return false;
            }
        }
        return true;
    }

}