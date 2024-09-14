<?php

namespace src\controller;

use Exception;
use src\core\Response;
use src\exception\InvalidUserDataException;
use src\service\UserService;

class UserController {

    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    function createUser() {
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            $user = $this->userService->createUser($data);
            Response::json(["user" => $user], 201);
        } catch (InvalidUserDataException $e) {
            Response::json(["error" => "Invalid input user data"], 400);
        } catch (Exception $e) {
            Response::json(["error" => "Failed to create user"], 500);
        }
    }

}