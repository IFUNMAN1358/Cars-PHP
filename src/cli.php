<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/config/Env.php';
require_once __DIR__ . '/config/db.php';

use src\core\MigrationManager;
use src\config\Env;

Env::init();

function runMigrations() {
    try {
        $pdo = connect_db();
        $migrationManager = new MigrationManager($pdo);
        $migrationManager->run();
        echo "Migrations applied successfully.\n";
    } catch (Exception $e) {
        echo "Error applying migrations: " . $e->getMessage() . "\n";
    }
}

$command = isset($argv[1]) ? $argv[1] : null;

if ($command === 'migrate') {
    runMigrations();
} else {
    echo "Unknown command. Available commands: migrate\n";
}