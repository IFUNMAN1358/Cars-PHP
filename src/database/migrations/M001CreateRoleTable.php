<?php

namespace src\database\migrations;

class M001CreateRoleTable
{
    public static function up($pdo) {
        $pdo->exec("
                    CREATE TABLE IF NOT EXISTS roles (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(255) UNIQUE NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                    ) ENGINE=INNODB;
                ");
    }
}