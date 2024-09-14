<?php

namespace src\database\migrations;

class M003CreateUserRoleTable
{
    public static function up($pdo) {
        $pdo->exec("
                    CREATE TABLE IF NOT EXISTS role_user (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        user_id INT NOT NULL,
                        role_id INT NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                        FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
                    ) ENGINE=INNODB;
                ");
    }
}