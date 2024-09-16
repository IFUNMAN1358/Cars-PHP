<?php

namespace src\controller;

use Exception;
use src\core\Response;
use src\security\AuthContext;

class TestController
{
    /**
     * @throws Exception
     */
    public function getTest(): void
    {
        $authInfo = AuthContext::getAuthInfo();
        Response::json($authInfo);
    }

}