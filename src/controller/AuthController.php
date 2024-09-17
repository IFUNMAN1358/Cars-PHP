<?php

namespace src\controller;

use Exception;
use src\core\Request;
use src\core\Response;
use src\dto\UserRequest;
use src\dto\UserResponse;
use src\exception\IncorrectPasswordException;
use src\exception\InvalidUserDataException;
use src\exception\RoleNotFoundException;
use src\exception\UserAlreadyExistsException;
use src\exception\UserNotFoundException;
use src\security\AuthContext;
use src\service\JwtService;
use src\service\UserService;

class AuthController {

    /**
     * @throws InvalidUserDataException
     * @throws UserAlreadyExistsException
     * @throws RoleNotFoundException
     * @throws Exception
     */
    public function registration(): void {
        $data = UserRequest::validateRegisterData(Request::getBody());

        $user = UserService::createUser($data);

        Response::json([
            "user" => UserResponse::map($user),
            "jwt" => JwtService::generateJwtTokens($user)
        ], 201);
    }

    /**
     * @throws InvalidUserDataException
     * @throws IncorrectPasswordException
     * @throws UserNotFoundException
     * @throws Exception
     */
    public function login(): void {
        $data = UserRequest::validateLoginData(Request::getBody());

        $user = UserService::getUser($data);

        if (!password_verify($data['password'], $user['password'])) {
            throw new IncorrectPasswordException();
        }

        Response::json([
            "user" => UserResponse::map($user),
            "jwt" => JwtService::generateJwtTokens($user)
        ], 200);
    }

    /**
     * @throws Exception
     */
    public function logout(): void {
        $authInfo = AuthContext::getAuthInfo();
        Response::json(["message" => "Logout successful"], 200);
    }

}