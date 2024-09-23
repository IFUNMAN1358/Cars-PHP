<?php

use src\controller\RentController;
use src\core\Router;

$rent_router = new Router();

$rent_router->post("/api/rent", function () {
    $controller = new RentController();
    $controller->createRent();
}, ['ROLE_USER']);

$rent_router->get("/api/rents", function () {
    $controller = new RentController();
    $controller->getUserRents();
}, ['ROLE_USER']);

$rent_router->get("/api/m/rents", function () {
    $controller = new RentController();
    $controller->getAllRents();
}, ['ROLE_MANAGER']);

$rent_router->post("/api/m/rent/accept", function () {
    $controller = new RentController();
    $controller->acceptRent();
}, ['ROLE_MANAGER']);

$rent_router->post("/api/m/rent/reject", function () {
    $controller = new RentController();
    $controller->rejectRent();
}, ['ROLE_MANAGER']);

return $rent_router;