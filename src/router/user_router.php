<?php

use src\controller\UserController;
use src\core\Router;

$user_router = new Router();

$user_router->post('/api/user', function () {
    $controller = new UserController();
    $controller->createUser();
});

return $user_router;