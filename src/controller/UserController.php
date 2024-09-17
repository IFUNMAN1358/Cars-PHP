<?php

namespace src\controller;

use Exception;
use src\core\Request;
use src\core\Response;
use src\dto\UserRequest;
use src\exception\IncorrectPasswordException;
use src\exception\InvalidUserDataException;
use src\security\AuthContext;
use src\service\UserService;

class UserController {

    /**
     * @throws InvalidUserDataException
     * @throws Exception
     */
    public function updateFullName(): void {
        $data = UserRequest::validateFullNameData(Request::getBody());
        $authInfo = AuthContext::getAuthInfo();

        UserService::updateUserFullName($authInfo['userId'], $data);
        Response::json(["message" => "User full name successful updated"], 200);
    }

    /**
     * @throws InvalidUserDataException
     * @throws Exception
     */
    public function updateEmail(): void {
        $data = UserRequest::validateEmailData(Request::getBody());
        $authInfo = AuthContext::getAuthInfo();

        UserService::updateUserEmail($authInfo['userId'], $data);
        Response::json(["message" => "User email successful updated"], 200);
    }

    /**
     * @throws InvalidUserDataException
     * @throws Exception
     */
    public function updatePhone(): void {
        $data = UserRequest::validatePhoneData(Request::getBody());
        $authInfo = AuthContext::getAuthInfo();

        UserService::updateUserPhone($authInfo['userId'], $data);
        Response::json(["message" => "User phone successful updated"], 200);
    }

    /**
     * @throws InvalidUserDataException
     * @throws IncorrectPasswordException
     * @throws Exception
     */
    public function updatePassword(): void {
        $data = UserRequest::validatePasswordData(Request::getBody());
        $authInfo = AuthContext::getAuthInfo();

        $user = UserService::getUser($authInfo);

        if (!password_verify($data['oldPassword'], $user['password'])) {
            throw new IncorrectPasswordException();
        }

        UserService::updateUserPassword($authInfo['userId'], $data);
        Response::json(["message" => "User password successful updated"], 200);
    }

}