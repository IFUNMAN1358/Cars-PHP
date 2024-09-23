<?php

namespace src\repository;

use Exception;

class CarPhotoRepository extends BaseRepository {

    /* @throws Exception */
    public static function saveCarPhoto($carId, $photoUrl): int
    {
        return self::save(
            "INSERT INTO car_photos (car_id, photo_url)
                VALUES (:car_id, :photo_url)",
            ['car_id' => $carId, 'photo_url' => $photoUrl]
        );
    }

    /* @throws Exception */
    public static function getCarPhotosById($carId): array
    {
        return self::getAll(
            "SELECT * FROM car_photos WHERE car_id = :car_id",
            ['car_id' => $carId]
        );
    }

    /* @throws Exception */
    public static function updateCarPhotoUrlById($photoId, $photo_url): void
    {
        self::update(
            "UPDATE car_photos SET photo_url = :photo_url WHERE id = :id",
            ['id' => $photoId, 'photo_url' => $photo_url]
        );
    }

}