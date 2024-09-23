<?php

namespace src\controller;

use Exception;
use src\core\Request;
use src\core\Response;
use src\dto\CarRequest;
use src\exception\InvalidCarDataException;
use src\service\CarService;

class CarController {

    /* @throws Exception */
    public static function getCar($carId): void
    {
        $car = CarService::getCar($carId);
        Response::json(['car' => $car], 201);
    }

    /* @throws Exception */
    public static function getCars(): void
    {
        $cars = CarService::getAllCars();
        Response::json(['cars' => $cars], 201);
    }

    public static function getCarPhoto($photoUrl): void
    {
        $filePath = __DIR__ . '/../' . $photoUrl;

        if (file_exists($filePath)) {
            $baseUrl = 'http://localhost:8000';
            $imageUrl = $baseUrl . '/' . ltrim($photoUrl, '/');

            echo json_encode(['imageUrl' => $imageUrl], JSON_UNESCAPED_SLASHES);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Photo not found"]);
        }
    }

    /**
     * @throws InvalidCarDataException
     * @throws Exception
     */
    public static function createCar(): void
    {
        $data = CarRequest::validateCreateData(Request::getFormData());
        $car = CarService::createCar($data);
        Response::json(['car' => $car], 201);
    }

    /**
     * @throws InvalidCarDataException
     * @throws Exception
     */
    public static function updateCar(): void
    {
        $data = CarRequest::validateUpdateData(Request::getFormData());
        $car = CarService::updateCar($data);
        Response::json(['car' => $car], 201);
    }

    /* @throws Exception */
    public static function deleteCar($carId): void
    {
        CarService::deleteCar($carId);
        Response::json(['message' => "Car successful deleted"], 201);
    }

}