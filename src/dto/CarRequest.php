<?php

namespace src\dto;

use src\exception\InvalidCarDataException;

class CarRequest {

    /* @throws InvalidCarDataException */
    public static function validateCreateData($data): ?array {
        if (!isset(
            $data['name'], $data['description'], $data['price'], $data['enginePower'], $data['transmission'],
            $data['seatsNumber'], $data['issueYear'], $data['color'], $data['steeringWheel'], $data['status'],
            $data['photo1'], $data['photo2'], $data['photo3'], $data['photo4']
        )) {
            throw new InvalidCarDataException();
        }
        return $data;
    }

    /* @throws InvalidCarDataException */
    public static function validateUpdateData($data): ?array {
        $requiredFields = [
            'carId', 'name', 'description', 'price', 'enginePower',
            'transmission', 'seatsNumber', 'issueYear', 'color',
            'steeringWheel', 'status'
        ];

        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                throw new InvalidCarDataException();
            }
        }
        $photoFields = ['photo1', 'photo2', 'photo3', 'photo4'];
        $photosPresent = array_filter($photoFields, fn($photo) => isset($data[$photo]));

        return $data;
    }

}