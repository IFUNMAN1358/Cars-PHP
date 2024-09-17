<?php

namespace src\exception;

use Exception;

class HttpException extends Exception {

    protected int $statusCode;

    public function __construct($message, $statusCode)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

}