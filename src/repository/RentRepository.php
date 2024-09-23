<?php

namespace src\repository;

use Exception;

class RentRepository extends BaseRepository {

    /* @throws Exception */
    public static function saveRent($userId, $data): int
    {
        return self::save(
            "INSERT INTO rentals (user_id, car_id, address, days_rent, total_amount, start_date, end_date, status)
                VALUES (:user_id, :car_id, :address, :days_rent, :total_amount, :start_date, :end_date, :status)",
            [
                ':user_id' => $userId,
                ':car_id' => $data['carId'],
                ':address' => $data['address'],
                ':days_rent' => $data['daysRent'],
                ':total_amount' => $data['totalAmount'],
                ':start_date' => $data['startDate'],
                ':end_date' => $data['endDate'],
                ':status' => 'рассматривается'
            ]
        );
    }

    /* @throws Exception */
    public static function getRentById($rentId): ?array
    {
        return self::getFirst("SELECT * FROM rentals WHERE id = :id", [
            ':id' => $rentId
        ]);
    }

    /* @throws Exception */
    public static function getAllUserRentsByUserId($userId): ?array
    {
        return self::getAll("SELECT * FROM rentals WHERE user_id = :user_id", [
            ':user_id' => $userId
        ]);
    }

    /* @throws Exception */
    public static function getAllRents(): ?array
    {
        return self::getAll("SELECT * FROM rentals WHERE status = :status", [
            ':status' => 'рассматривается'
        ]);
    }

    /* @throws Exception */
    public static function setRentStatusById($rentId, $status): void
    {
        self::update("UPDATE rentals SET status = :status WHERE id = :id", [
            ':id' => $rentId,
            ':status' => $status
        ]);
    }

}