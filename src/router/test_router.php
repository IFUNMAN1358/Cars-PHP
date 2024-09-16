<?php

use src\controller\TestController;
use src\core\Router;
use src\security\JwtFilter;

$test_router = new Router();

$test_router->get('/api/test', function () {
    $controller = new TestController();
    $controller->getTest();
}, [JwtFilter::class]);

return $test_router;