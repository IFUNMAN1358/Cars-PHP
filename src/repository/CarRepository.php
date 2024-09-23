<?php

namespace src\repository;

use Exception;

class CarRepository extends BaseRepository {

    /* @throws Exception */
    public static function saveCar($data): int
    {
        return self::save("INSERT INTO cars (name, description, price, engine_power, transmission, seats_number, issue_year, color, steering_wheel, status)
                        VALUES (:name, :description, :price, :engine_power, :transmission, :seats_number, :issue_year, :color, :steering_wheel, :status)",
            [
                ':name' => $data['name'],
                ':description' => $data['description'],
                ':price' => $data['price'],
                ':engine_power' => $data['enginePower'],
                ':transmission' => $data['transmission'],
                ':seats_number' => $data['seatsNumber'],
                ':issue_year' => $data['issueYear'],
                ':color' => $data['color'],
                ':steering_wheel' => $data['steeringWheel'],
                ':status' => $data['status']
            ]
        );
    }

    /* @throws Exception */
    public static function updateCarById($carId, $data): void
    {
        self::update("UPDATE cars 
                            SET name = :name, description = :description, price = :price,
                                engine_power = :engine_power, transmission = :transmission, seats_number = :seats_number,
                                issue_year = :issue_year, color = :color, steering_wheel = :steering_wheel, status = :status
                            WHERE id = :id",
            [
                ':id' => $carId,
                ':name' => $data['name'],
                ':description' => $data['description'],
                ':price' => $data['price'],
                ':engine_power' => $data['enginePower'],
                ':transmission' => $data['transmission'],
                ':seats_number' => $data['seatsNumber'],
                ':issue_year' => $data['issueYear'],
                ':color' => $data['color'],
                ':steering_wheel' => $data['steeringWheel'],
                ':status' => $data['status']
            ]
        );
    }

    /* @throws Exception */
    public static function getCarById($carId): array
    {
        return self::getFirst("SELECT * FROM cars WHERE id = :id",
            [':id' => $carId]
        );
    }

    /* @throws Exception */
    public static function getAllCars(): array
    {
        return self::getAll("SELECT * FROM cars", []);
    }

    /* @throws Exception */
    public static function deleteCarById($carId): void
    {
        self::delete("DELETE FROM cars WHERE id = :id",
        [':id' => $carId]);
    }

}