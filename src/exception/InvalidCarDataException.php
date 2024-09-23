<?php

namespace src\exception;

class InvalidCarDataException extends HttpException {

    public function __construct()
    {
        parent::__construct("Invalid input car data", 400);
    }

}