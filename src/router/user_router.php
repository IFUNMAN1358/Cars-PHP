<?php

use src\controller\UserController;
use src\core\Router;
use src\repository\UserRepository;
use src\service\UserService;

$user_router = new Router();

$user_router->post('/api/user', function () {
    $controller = new UserController(new UserService(new UserRepository()));
    $controller->createUser();
});

return $user_router;