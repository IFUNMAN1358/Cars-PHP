<?php

namespace src\core;

use Exception;
use PDO;

class SeedManager {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function run() {
        $seedFiles = glob(__DIR__ . '/../database/seeds/*.php');
        foreach ($seedFiles as $seedFile) {
            $seedClass = 'src\\database\\seeds\\' . basename($seedFile, '.php');
            require_once $seedFile;

            if (class_exists($seedClass)) {
                try {
                    $seedClass::up($this->pdo);
                    echo "Applied seed: $seedClass\n";
                } catch (Exception $e) {
                    echo "Error applying seed $seedClass: " . $e->getMessage() . "\n";
                }
            }
        }
    }
}