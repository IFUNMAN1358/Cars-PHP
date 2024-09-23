<?php

namespace src\dto;

use src\exception\InvalidRentDataException;

class RentRequest {

    /* @throws InvalidRentDataException */
    public static function validateCreateData($data): ?array {
        if (!isset( $data['carId'], $data['address'], $data['daysRent'], $data['totalAmount'], $data['startDate'], $data['endDate'])) {
            throw new InvalidRentDataException();
        }
        return $data;
    }

    /* @throws InvalidRentDataException */
    public static function validateRentIdData($data): ?array {
        if (!isset($data['rentId'])) {
            throw new InvalidRentDataException();
        }
        return $data;
    }

}