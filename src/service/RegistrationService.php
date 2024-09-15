<?php

namespace src\service;

use src\exception\InvalidUserDataException;

class RegistrationService {

    /**
     * @throws InvalidUserDataException
     */
    public static function registration($requestBody) {
        $user = UserService::createUser($requestBody);
        if ($user) {
            // pirate ship
        }
        return $user;
    }

}