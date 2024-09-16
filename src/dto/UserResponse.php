<?php

namespace src\dto;

class UserResponse {

    public static function map($user): array {
        return [
            "userId" => $user['id'],
            "firstName" => $user['first_name'],
            "lastName" => $user['last_name'],
            "email" => $user['email'],
            "phone" => $user['phone'],
            "roles" => $user['roles']
        ];
    }

}