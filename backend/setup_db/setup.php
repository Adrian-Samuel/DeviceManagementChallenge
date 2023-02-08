<?php

try {
    $conn = new PDO("pgsql:host=$_GET('DATABASE_HOST');dbname=$_GET('DATABASE_NAME')", $_GET('DATABASE_USER'), $_GET('DATABASE_PASSWORD'));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = file_get_contents("seed.sql");
    $conn->exec($sql);

    echo "Database seeded successfully.";
} catch (PDOException $e) {
    echo $e->getMessage();
}