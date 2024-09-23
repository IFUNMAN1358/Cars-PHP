<?php

namespace src\exception;

use Exception;

class InvalidRentDataException extends Exception {

    public function __construct()
    {
        parent::__construct("Invalid input rent data", 400);
    }

}