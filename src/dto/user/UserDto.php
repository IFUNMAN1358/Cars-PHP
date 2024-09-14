<?php

namespace src\dto\user;

class UserDto {

    public static function validateRegisterData($data) {
        return isset($data['firstName'], $data['lastName'], $data['phone'], $data['email'], $data['password']);
    }

}