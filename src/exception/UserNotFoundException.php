<?php

namespace src\exception;

class UserNotFoundException extends HttpException {

    public function __construct()
    {
        parent::__construct("User not found", 500);
    }

}