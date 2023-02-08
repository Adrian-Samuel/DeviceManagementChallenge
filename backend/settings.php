<?php

use Dotenv\Dotenv;

const APP_ROOT = __DIR__;
$dotenv = Dotenv::createImmutable(APP_ROOT);
$dotenv->load();

$env = array_filter($_ENV, function ($value) {
    return !empty($value);
});

return [
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => false,

        'doctrine' => [
            // Enables or disables Doctrine metadata caching
            // for either performance or convenience during development.
            'dev_mode' => true,

            // Path where Doctrine will cache the processed metadata
            // when 'dev_mode' is false.
            'cache_dir' => APP_ROOT . '/var/doctrine',

            // List of paths where Doctrine will search for metadata.
            // Metadata can be either YML/XML files or PHP classes annotated
            // with comments or PHP8 attributes.
            'metadata_dirs' => [APP_ROOT . '/src/Domain'],

            // The parameters Doctrine needs to connect to your database.
            // These parameters depend on the driver (for instance the 'pdo_sqlite' driver
            // needs a 'path' parameter and doesn't use most of the ones shown in this example).
            // Refer to the Doctrine documentation to see the full list
            // of valid parameters: https://www.doctrine-project.org/projects/doctrine-dbal/en/current/reference/configuration.html
            'connection' => [
                'driver' => 'pdo_pgsql',
                'host' => 'localhost',
                'port' => 3306,
                'dbname' => $env['DATABASE_NAME'],
                'user' => $env['DATABASE_USER'],
                'password' => $env['DATABASE_PASSWORD'],
                'charset' => 'utf-8'
            ]
        ]
    ]
];