<?php

namespace src\service;

use src\repository\RoleRepository;
use Exception;

class RoleService {

    /**
     * @throws Exception
     */
    public static function createRoleIfNotExists($name) {
        $role = RoleRepository::getRoleByName($name);
        if (!$role) {
            RoleRepository::saveRole($name);
        }
    }

}