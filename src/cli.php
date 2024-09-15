<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/config/Env.php';
require_once __DIR__ . '/database/Database.php';

use src\config\Env;
use src\core\MigrationManager;
use src\core\SeedManager;
use src\database\Database;

Env::init();

function runMigrations() {
    try {
        $pdo = Database::getConnection();
        $migrationManager = new MigrationManager($pdo);
        $migrationManager->run();
        echo "Migrations applied successfully.\n";
    } catch (Exception $e) {
        echo "Error applying migrations: " . $e->getMessage() . "\n";
    }
}

function runSeeds() {
    try {
        $pdo = Database::getConnection();
        $seedManager = new SeedManager($pdo);
        $seedManager->run();
        echo "Seeds applied successfully.\n";
    } catch (Exception $e) {
        echo "Error applying seeds: " . $e->getMessage() . "\n";
    }
}

$command = isset($argv[1]) ? $argv[1] : null;

if ($command === 'migrate') {
    runMigrations();
} else if ($command === 'seed') {
    runSeeds();
} else {
    echo "Unknown command. Available commands: migrate, seed\n";
}