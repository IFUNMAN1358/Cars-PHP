<?php

namespace src\security;

class CorsFilter {

    public static function permit(): void
    {
        header("Access-Control-Allow-Origin: http://localhost:7000");
        header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }
    }

}