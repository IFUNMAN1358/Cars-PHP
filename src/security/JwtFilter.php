<?php

namespace src\security;

use Exception;
use Firebase\JWT\SignatureInvalidException;
use src\core\AuthContext;
use src\core\Request;
use src\core\Response;
use src\repository\JwtRepository;
use src\service\JwtService;

class JwtFilter
{
    public static function handle(callable $next, array $requiredRoles): void
    {
        try {
            $accessToken = self::getAccessTokenFromHeader();
            $decodedToken = JwtRepository::decodeAccessToken($accessToken);

            if (!JwtService::validateAccessToken($decodedToken)) {
                throw new SignatureInvalidException();
            }

            AuthContext::setAuthInfo($decodedToken);

            if (!self::hasRequiredRoles($decodedToken['roles'], $requiredRoles)) {
                throw new Exception("Access denied");
            }

            $next();
        } catch (Exception $e) {
            Response::json(["error" => $e->getMessage()], 401);
        }
    }

    /* @throws Exception */
    private static function getAccessTokenFromHeader(): ?string
    {
        $authorizationHeader = Request::getAuthorizationHeader();

        if (!$authorizationHeader) {
            throw new Exception("Missing authorization header");
        }

        if (preg_match('/Bearer\s(\S+)/', $authorizationHeader, $matches)) {
            return $matches[1];
        }
        return null;
    }

    private static function hasRequiredRoles(array $userRoles, array $requiredRoles): bool
    {
        return !empty(array_intersect($userRoles, $requiredRoles));
    }
}