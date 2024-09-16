<?php

namespace src\core;

class Request {

    public static function getBody() {
        return json_decode(file_get_contents('php://input'), true);
    }

    public static function getAuthorizationHeader(): ?string
    {
        if (isset($_SERVER['Authorization'])) {
            return trim($_SERVER['Authorization']);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            return trim($_SERVER['HTTP_AUTHORIZATION']);
        }
        return null;
    }

}