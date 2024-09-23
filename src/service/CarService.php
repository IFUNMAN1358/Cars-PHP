<?php

namespace src\service;

use Exception;
use src\core\PhotoManager;
use src\database\Database;
use src\repository\CarPhotoRepository;
use src\repository\CarRepository;

class CarService {

    /* @throws Exception */
    public static function createCar($data)
    {
        return Database::beginTransaction(function() use ($data) {

            $carId = CarRepository::saveCar($data);

            CarPhotoRepository::saveCarPhoto($carId, PhotoManager::savePhoto('car_photos', $data['photo1'], $carId));
            CarPhotoRepository::saveCarPhoto($carId, PhotoManager::savePhoto('car_photos', $data['photo2'], $carId));
            CarPhotoRepository::saveCarPhoto($carId, PhotoManager::savePhoto('car_photos', $data['photo3'], $carId));
            CarPhotoRepository::saveCarPhoto($carId, PhotoManager::savePhoto('car_photos', $data['photo4'], $carId));

            $car = CarRepository::getCarById($carId);
            $car['photos'] = CarPhotoRepository::getCarPhotosById($carId);

            return $car;
        });
    }

    /* @throws Exception */
    public static function getCar($carId): array
    {
        $car = CarRepository::getCarById($carId);
        $car['photos'] = CarPhotoRepository::getCarPhotosById($carId);
        return $car;
    }

    /* @throws Exception */
    public static function getAllCars(): array
    {
        $cars = CarRepository::getAllCars();

        foreach ($cars as &$car) {
            $car['photos'] = CarPhotoRepository::getCarPhotosById($car['id']);
        }
        return $cars;
    }

    /* @throws Exception */
    public static function updateCar($data): array
    {
        return Database::beginTransaction(function() use ($data) {
            $carId = $data['carId'];

            $currentPhotos = CarPhotoRepository::getCarPhotosById($carId);

            for ($i = 1; $i <= 4; $i++) {
                $photoKey = 'photo' . $i;

                if (isset($data[$photoKey]) && !empty($data[$photoKey])) {
                    if (isset($currentPhotos[$i - 1])) {
                        PhotoManager::deletePhoto($currentPhotos[$i - 1]);

                        $newPhotoUrl = PhotoManager::savePhoto('car_photos', $data[$photoKey], $carId);
                        CarPhotoRepository::updateCarPhotoUrlById($currentPhotos[$i - 1]['id'], $newPhotoUrl);
                    } else {
                        $newPhotoUrl = PhotoManager::savePhoto('car_photos',$data[$photoKey], $carId);
                        CarPhotoRepository::saveCarPhoto($carId, $newPhotoUrl);
                    }
                }
            }

            CarRepository::updateCarById($carId, $data);

            $car = CarRepository::getCarById($carId);
            $car['photos'] = CarPhotoRepository::getCarPhotosById($carId);
            return $car;
        });
    }

    /* @throws Exception */
    public static function deleteCar($carId): void
    {
        $carPhotos = CarPhotoRepository::getCarPhotosById($carId);

        foreach ($carPhotos as $photo) {
            PhotoManager::deletePhoto($photo);
        }
        CarRepository::deleteCarById($carId);
    }

}