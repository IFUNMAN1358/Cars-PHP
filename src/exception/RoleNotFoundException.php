<?php

namespace src\exception;

class RoleNotFoundException extends HttpException {

    public function __construct()
    {
        parent::__construct("Role not found", 500);
    }

}