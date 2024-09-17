<?php

namespace src\exception;

class InvalidUserDataException extends HttpException {

    public function __construct()
    {
        parent::__construct("Invalid input user data", 400);
    }

}