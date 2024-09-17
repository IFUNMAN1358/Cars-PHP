<?php

namespace src\core;

use src\exception\HttpException;
use Throwable;

class ErrorHandler
{
    public static function handleException(Throwable $exception): void {
        if ($exception instanceof HttpException) {
            Response::json(["error" => $exception->getMessage()], $exception->getStatusCode());
        } else {
            error_log($exception->getMessage());
            Response::json(["error" => "An unexpected error occurred"], 500);
        }
    }
}