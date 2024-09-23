<?php

use src\controller\AuthController;
use src\core\Router;
use src\security\JwtFilter;

$auth_router = new Router();

$auth_router->post("/api/auth/registration", function () {
    $controller = new AuthController();
    $controller->registration();
}, []);

$auth_router->post("/api/auth/login", function () {
    $controller = new AuthController();
    $controller->login();
}, []);

$auth_router->post("/api/auth/logout", function () {
    $controller = new AuthController();
    $controller->logout();
}, ['ROLE_USER']);


return $auth_router;