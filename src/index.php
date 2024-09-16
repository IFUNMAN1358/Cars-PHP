<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/config/Env.php';
require_once __DIR__ . '/database/Database.php';

use src\config\Env;
use src\core\Router;

Env::init();

$router = new Router();

$router->addRouter(require_once __DIR__ . '/router/test_router.php');
$router->addRouter(require_once __DIR__ . '/router/auth_router.php');
$router->addRouter(require_once __DIR__ . '/router/user_router.php');
$router->run();