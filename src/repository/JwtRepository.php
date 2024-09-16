<?php

namespace src\repository;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use src\config\Env;

class JwtRepository {

    public static function encodeAccessToken(array $payload): string {
        $payload['exp'] = time() + (Env::$jwtAccessExpMinutes * 60);
        return JWT::encode($payload, Env::$jwtAccessSecret, 'HS256');
    }

    public static function encodeRefreshToken(array $payload): string {
        $payload['exp'] = time() + (Env::$jwtRefreshExpHours * 3600);
        return JWT::encode($payload, Env::$jwtRefreshSecret, 'HS256');
    }

    public static function decodeAccessToken(string $accessToken): ?array {
        $decoded = JWT::decode($accessToken, new Key(Env::$jwtAccessSecret, 'HS256'));
        return (array) $decoded;
    }

    public static function decodeRefreshToken(string $refreshToken): ?array {
        $decoded = JWT::decode($refreshToken, new Key(Env::$jwtRefreshSecret, 'HS256'));
        return (array) $decoded;
    }

}