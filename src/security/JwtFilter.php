<?php

namespace src\security;

use Exception;
use Firebase\JWT\SignatureInvalidException;
use src\core\Request;
use src\core\Response;
use src\repository\JwtRepository;
use src\service\JwtService;

class JwtFilter
{
    public static function handle(callable $next): void
    {
        try {
            $accessToken = self::getAccessTokenFromHeader();
            $decodedToken = JwtRepository::decodeAccessToken($accessToken);

            if (!JwtService::validateAccessToken($decodedToken)) {
                throw new SignatureInvalidException();
            }

            AuthContext::setAuthInfo($decodedToken);
            $next();
        } catch (Exception $e) {
            Response::json(["error" => $e->getMessage()], 401);
        }
    }

    /**
     * @throws Exception
     */
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
}