<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/config/Env.php';
require_once __DIR__ . '/database/Database.php';
require_once __DIR__ . '/core/ErrorHandler.php';

use src\config\Env;
use src\core\ErrorHandler;
use src\core\Router;

Env::init();

set_exception_handler([ErrorHandler::class, 'handleException']);

$router = new Router();

$router->addRouter(require_once __DIR__ . '/router/test_router.php');
$router->addRouter(require_once __DIR__ . '/router/auth_router.php');
$router->addRouter(require_once __DIR__ . '/router/account/user_router.php');
$router->addRouter(require_once __DIR__ . '/router/account/address_router.php');
$router->addRouter(require_once __DIR__ . '/router/account/passport_router.php');
$router->addRouter(require_once __DIR__ . '/router/account/driver_license_router.php');
$router->run();