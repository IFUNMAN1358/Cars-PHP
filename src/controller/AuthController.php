<?php

namespace src\controller;

use Exception;
use src\core\Request;
use src\core\Response;
use src\exception\IncorrectPasswordException;
use src\exception\InvalidUserDataException;
use src\exception\RoleNotFoundException;
use src\exception\UserAlreadyExistsException;
use src\exception\UserNotFoundException;
use src\security\AuthContext;
use src\service\AuthService;

class AuthController {

    public function registration(): void
    {
        try {
            $requestBody = Request::getBody();

            $data = AuthService::registration($requestBody);
            Response::json($data, 201);

        } catch (InvalidUserDataException) {
            Response::json(["error" => "Invalid input user data"], 400);
        } catch (UserAlreadyExistsException) {
            Response::json(["error" => "User already exists"], 500);
        } catch (RoleNotFoundException) {
            Response::json(["error" => "Role not found"], 500);
        } catch (Exception) {
            Response::json(["error" => "User registration error"], 500);
        }
    }

    public function login(): void
    {
        try {
            $requestBody = Request::getBody();

            $data = AuthService::login($requestBody);
            Response::json($data);

        } catch (InvalidUserDataException) {
            Response::json(["error" => "Invalid input user data"], 400);
        } catch (UserNotFoundException) {
            Response::json(["error" => "User not found"], 500);
        } catch (IncorrectPasswordException) {
            Response::json(["error" => "Incorrect password"], 400);
        } catch (Exception) {
            Response::json(["error" => "User login error"], 500);
        }
    }

    public function logout(): void
    {
        try {
            $authInfo = AuthContext::getAuthInfo();
            Response::json(["message" => "Logout successful"]);
        } catch (Exception) {
            Response::json(["error" => "Logout error"], 500);
        }
    }

}