<?php

namespace src\database\migrations;

class M004CreateCarTable
{
    public static function up($pdo): void
    {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS cars (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                description VARCHAR(1000) NOT NULL,
                price INT NOT NULL,
                engine_power INT NOT NULL,
                transmission VARCHAR(50) NOT NULL,
                seats_number INT NOT NULL,
                issue_year INT NOT NULL,
                color VARCHAR(30) NOT NULL,
                steering_wheel VARCHAR(30) NOT NULL,
                status VARCHAR(30) NOT NULL
            ) ENGINE=INNODB;
        ");
    }
}