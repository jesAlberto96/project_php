<?php

require 'config/database.php';
require 'migrations/Migration.php';

$migrations = [
    '20240812_create_users_table',
    '20240812_add_email_to_users_table'
];

foreach ($migrations as $migration) {
    $migrationInstance = require_once "migrations/$migration.php";

    // $className = str_replace(['_', '.php'], ['', ''], ucwords($migration, '_'));
    // $migrationInstance = new $className();

    echo "Applying migration: $migration...\n";
    $migrationInstance->up($pdo);
}