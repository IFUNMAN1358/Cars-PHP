<?php

namespace src\database\migrations;

class M005CreateCarPhotoTable
{
    public static function up($pdo): void
    {
        $pdo->exec("
            CREATE TABLE car_photos (
                id INT AUTO_INCREMENT PRIMARY KEY,
                car_id INT NOT NULL,
                photo_url VARCHAR(255) NOT NULL,
                INDEX (car_id),
                FOREIGN KEY (car_id) REFERENCES cars(id)
                ON DELETE CASCADE
                ON UPDATE CASCADE
            ) ENGINE=INNODB;
        ");
    }
}