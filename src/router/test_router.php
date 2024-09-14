<?php

use src\controller\TestController;
use src\core\Router;

$test_router = new Router();

$test_router->get('/api/test', function () {
    $controller = new TestController();
    $controller->getTest();
});

return $test_router;