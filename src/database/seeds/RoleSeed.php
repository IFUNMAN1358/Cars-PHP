<?php

namespace src\database\seeds;

use Exception;
use src\repository\RoleRepository;

class RoleSeed {

    /**
     * @throws Exception
     */
    public static function up(): void
    {
        $role_names = ["ROLE_USER", "ROLE_MANAGER"];

        foreach ($role_names as $name) {
            $role = RoleRepository::getRoleByName($name);
            if (!$role) {
                RoleRepository::saveRole($name);
            }
        }
    }
}