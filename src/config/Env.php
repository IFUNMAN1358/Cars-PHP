<?php

namespace src\config;

use Dotenv\Dotenv;

class Env {

    public static $dbHost;
    public static $dbPort;
    public static $dbName;
    public static $dbUser;
    public static $dbPass;
    public static $dbCharset;

    public static function init() {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        self::$dbHost = $_ENV['DB_HOST'];
        self::$dbPort = $_ENV['DB_PORT'];
        self::$dbName = $_ENV['DB_DATABASE'];
        self::$dbUser = $_ENV['DB_USERNAME'];
        self::$dbPass = $_ENV['DB_PASSWORD'];
        self::$dbCharset = $_ENV['DB_CHARSET'];
    }
}