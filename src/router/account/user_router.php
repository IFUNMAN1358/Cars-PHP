<?php

use src\controller\UserController;
use src\core\Router;
use src\security\JwtFilter;

$user_router = new Router();

$user_router->patch("/api/account/user/full-name", function () {
    $controller = new UserController();
    $controller->updateFullName();
}, [JwtFilter::class]);

$user_router->patch("/api/account/user/email", function () {
    $controller = new UserController();
    $controller->updateEmail();
}, [JwtFilter::class]);

$user_router->patch("/api/account/user/phone", function () {
    $controller = new UserController();
    $controller->updatePhone();
}, [JwtFilter::class]);

$user_router->patch("/api/account/user/password", function () {
    $controller = new UserController();
    $controller->updatePassword();
}, [JwtFilter::class]);

return $user_router;
