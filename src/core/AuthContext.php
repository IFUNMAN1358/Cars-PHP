<?php

namespace src\core;

class AuthContext
{
    private static array $authInfo = [];

    public static function setAuthInfo(array $authInfo): void
    {
        self::$authInfo = $authInfo;
    }

    public static function getAuthInfo(): array
    {
        return self::$authInfo;
    }
}