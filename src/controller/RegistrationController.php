<?php

namespace src\controller;

use Exception;
use src\core\Request;
use src\core\Response;
use src\exception\InvalidUserDataException;
use src\exception\RoleNotFoundException;
use src\service\RegistrationService;

class RegistrationController {

    public function registration() {
        $requestBody = Request::getBody();

        try {
            $user = RegistrationService::registration($requestBody);
            Response::json(["user" => $user], 201);
        } catch (InvalidUserDataException $e) {
            Response::json(["error" => "Invalid input user data"], 400);
        } catch (RoleNotFoundException $e) {
            Response::json(["error" => "Role not found"], 500);
        } catch (Exception $e) {
            Response::json(["error" => "User registration error"], 500);
        }
    }

}