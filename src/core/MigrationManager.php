<?php

namespace src\core;

use Exception;
use PDO;

class MigrationManager {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function run() {
        $appliedMigrations = $this->getAppliedMigrations();

        $migrationFiles = glob(__DIR__ . '/../database/migrations/*.php');
        foreach ($migrationFiles as $migrationFile) {
            $migrationClass = 'src\\database\\migrations\\' . basename($migrationFile, '.php');
            if (!in_array($migrationClass, $appliedMigrations)) {
                require_once $migrationFile;
                if (class_exists($migrationClass)) {
                    try {
                        $migrationClass::up($this->pdo);
                        echo "Applied migration: $migrationClass\n";
                        $this->logMigration($migrationClass);
                    } catch (Exception $e) {
                        echo "Migration error $migrationClass: " . $e->getMessage();
                    }
                }
            }
        }
    }

    private function getAppliedMigrations() {
        $stmt = $this->pdo->query("SHOW TABLES LIKE 'migrations'");
        if ($stmt->rowCount() === 0) {
            $this->pdo->exec("CREATE TABLE migrations (migration VARCHAR(255), applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
        }
        $stmt = $this->pdo->query("SELECT migration FROM migrations");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    private function logMigration($migration) {
        $this->pdo->prepare("INSERT INTO migrations (migration) VALUES (?)")->execute([$migration]);
    }
}