<?php

namespace src\exception;

class UserAlreadyExistsException extends HttpException {

    public function __construct()
    {
        parent::__construct("User already exists", 500);
    }

}