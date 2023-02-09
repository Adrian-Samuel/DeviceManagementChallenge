<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/seed.sql';

use Dotenv\Dotenv;

const APP_ROOT = __DIR__;
$dotenv = Dotenv::createImmutable(APP_ROOT . '/..');
$dotenv->load();

$env = array_filter($_ENV, function ($value) {
    return !empty($value);
});

$dbHost = $env['DATABASE_HOST'];
$dbName = $env['DATABASE_NAME'];
$dbUser = $env['DATABASE_USER'];
$dbPass = $env['DATABASE_PASSWORD'];

try {
    $conn = new PDO("pgsql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = file_get_contents(__DIR__ . '/seed.sql');
    $conn->exec($sql);

    echo "Database seeded successfully.\n";
} catch (PDOException $e) {
    echo $e->getMessage();
}