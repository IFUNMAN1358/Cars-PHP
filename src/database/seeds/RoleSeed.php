<?php

namespace src\database\seeds;

use Exception;
use src\service\RoleService;

class RoleSeed {

    /**
     * @throws Exception
     */
    public static function up() {

        $role_names = ["ROLE_USER", "ROLE_MANAGER"];

        foreach ($role_names as $name) {
            RoleService::createRoleIfNotExists($name);
        }
    }
}