<?php

namespace src\database\migrations;

class M006CreateRentalTable {

    public static function up($pdo): void
    {
        $pdo->exec("
        CREATE TABLE IF NOT EXISTS rentals (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            car_id INT NOT NULL,
            address VARCHAR(255) NOT NULL,
            days_rent INT NOT NULL,
            total_amount INT NOT NULL, 
            start_date TIMESTAMP NULL,
            end_date TIMESTAMP NULL,
            status VARCHAR(30) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX (user_id, car_id),
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (car_id) REFERENCES cars(id)
        ) ENGINE=INNODB;
    ");
    }

}