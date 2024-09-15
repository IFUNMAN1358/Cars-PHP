<?php

use src\controller\RegistrationController;
use src\core\Router;

$registration_router = new Router();

$registration_router->post("/api/registration", function () {
    $controller = new RegistrationController();
    $controller->registration();
});

return $registration_router;