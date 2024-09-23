<?php

use src\controller\UserController;
use src\core\Router;

$user_router = new Router();

$user_router->post("/api/m/user", function () {
    $controller = new UserController();
    $controller->getMUser();
}, ['ROLE_MANAGER']);

$user_router->get("/api/account/user", function () {
    $controller = new UserController();
    $controller->getUser();
}, ['ROLE_USER']);

$user_router->delete("/api/account/user", function () {
    $controller = new UserController();
    $controller->deleteUser();
}, ['ROLE_USER']);

$user_router->patch("/api/account/user/full-name", function () {
    $controller = new UserController();
    $controller->updateFullName();
}, ['ROLE_USER']);

$user_router->patch("/api/account/user/email", function () {
    $controller = new UserController();
    $controller->updateEmail();
}, ['ROLE_USER']);

$user_router->patch("/api/account/user/phone", function () {
    $controller = new UserController();
    $controller->updatePhone();
}, ['ROLE_USER']);

$user_router->patch("/api/account/user/password", function () {
    $controller = new UserController();
    $controller->updatePassword();
}, ['ROLE_USER']);

return $user_router;