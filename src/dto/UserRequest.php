<?php

namespace src\dto;

class UserRequest {

    public static function validateRegisterData($data): bool {
        return isset($data['firstName'], $data['lastName'], $data['phone'], $data['email'], $data['password']);
    }

    public static function validateLoginData($data): bool {
        return (isset($data['email']) || isset($data['phone'])) && isset($data['password']);
    }

}