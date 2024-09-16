<?php

namespace src\config;

use Dotenv\Dotenv;

class Env {

    public static string $dbHost;
    public static string $dbPort;
    public static string $dbName;
    public static string $dbUser;
    public static string $dbPass;
    public static string $dbCharset;

    public static string $jwtAccessSecret;
    public static string $jwtRefreshSecret;
    public static int $jwtAccessExpMinutes;
    public static int $jwtRefreshExpHours;

    public static function init(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        self::$dbHost = $_ENV['DB_HOST'];
        self::$dbPort = $_ENV['DB_PORT'];
        self::$dbName = $_ENV['DB_DATABASE'];
        self::$dbUser = $_ENV['DB_USERNAME'];
        self::$dbPass = $_ENV['DB_PASSWORD'];
        self::$dbCharset = $_ENV['DB_CHARSET'];

        self::$jwtAccessSecret = $_ENV['JWT_ACCESS_SECRET'];
        self::$jwtRefreshSecret = $_ENV['JWT_REFRESH_SECRET'];
        self::$jwtAccessExpMinutes = $_ENV['JWT_ACCESS_EXP_MINUTES'];
        self::$jwtRefreshExpHours = $_ENV['JWT_REFRESH_EXP_HOURS'];
    }
}