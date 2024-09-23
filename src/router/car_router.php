<?php

use src\controller\CarController;
use src\core\Router;

$car_router = new Router();

// getCarById
$car_router->get("/api/car", function () {
    $carId = $_GET['carId'];
    $controller = new CarController();
    $controller->getCar($carId);
}, []);

// getAllCars
$car_router->get("/api/cars", function () {
    $controller = new CarController();
    $controller->getCars();
}, []);

// getCarPhoto
$car_router->get("/api/car/photo", function () {
    $photoUrl = $_GET['photoUrl'];
    $controller = new CarController();
    $controller->getCarPhoto($photoUrl);
}, []);

// createCar
$car_router->post("/api/car", function () {
    $controller = new CarController();
    $controller->createCar();
}, ['ROLE_MANAGER']);

// updateCar
$car_router->post("/api/car/update", function () {
    $controller = new CarController();
    $controller->updateCar();
}, ['ROLE_MANAGER']);

// deleteCar
$car_router->delete("/api/car", function () {
    $carId = $_GET['carId'];
    $controller = new CarController();
    $controller->deleteCar($carId);
}, ['ROLE_MANAGER']);

return $car_router;