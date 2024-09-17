<?php

namespace src\dto;

use src\exception\InvalidUserDataException;

class UserRequest {

    /**
     * @throws InvalidUserDataException
     */
    public static function validateRegisterData($data): ?array {
        if (!isset($data['firstName'], $data['lastName'], $data['phone'], $data['email'], $data['password'])) {
            throw new InvalidUserDataException();
        }
        return $data;
    }

    /**
     * @throws InvalidUserDataException
     */
    public static function validateLoginData($data): ?array {
        if (!((isset($data['email']) || isset($data['phone'])) && isset($data['password']))) {
            throw new InvalidUserDataException();
        };
        return $data;
    }

    /**
     * @throws InvalidUserDataException
     */
    public static function validateFullNameData($data): ?array {
        if (!isset($data['firstName'], $data['lastName'])) {
            throw new InvalidUserDataException();
        }
        return $data;
    }

    /**
     * @throws InvalidUserDataException
     */
    public static function validateEmailData($data): ?array {
        if (!isset($data['email'])) {
            throw new InvalidUserDataException();
        };
        return $data;
    }

    /**
     * @throws InvalidUserDataException
     */
    public static function validatePhoneData($data): ?array {
        if (!isset($data['phone'])) {
            throw new InvalidUserDataException();
        };
        return $data;
    }

    /**
     * @throws InvalidUserDataException
     */
    public static function validatePasswordData($data): ?array {
        if (!isset($data['oldPassword'], $data['newPassword'])) {
            throw new InvalidUserDataException();
        };
        return $data;
    }

}