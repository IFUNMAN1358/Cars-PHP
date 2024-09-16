<?php

namespace src\controller;

use Exception;
use src\core\Request;
use src\core\Response;
use src\security\AuthContext;

class UserController {

    public function updateFullName(): void {
        try {
            $requestBody = Request::getBody();
            $authInfo = AuthContext::getAuthInfo();

            $data = "";
            Response::json($data);
        } catch (Exception) {
            Response::json(["error" => "Update user full name error"], 500);
        }
    }

    public function updateEmail(): void {
        try {
            $requestBody = Request::getBody();
            $authInfo = AuthContext::getAuthInfo();

            $data = "";
            Response::json($data);
        } catch (Exception) {
            Response::json(["error" => "Update user email error"], 500);
        }
    }

    public function updatePhone(): void {
        try {
            $requestBody = Request::getBody();
            $authInfo = AuthContext::getAuthInfo();

            $data = "";
            Response::json($data);
        } catch (Exception) {
            Response::json(["error" => "Update user phone error"], 500);
        }
    }

    public function updatePassword(): void {
        try {
            $requestBody = Request::getBody();
            $authInfo = AuthContext::getAuthInfo();

            $data = "";
            Response::json($data);
        } catch (Exception) {
            Response::json(["error" => "Update user password error"], 500);
        }
    }

}