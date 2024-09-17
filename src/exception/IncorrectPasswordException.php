<?php

namespace src\exception;

class IncorrectPasswordException extends HttpException {

    public function __construct()
    {
        parent::__construct("Incorrect password", 400);
    }

}