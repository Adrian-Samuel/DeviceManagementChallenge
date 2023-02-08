#!/usr/bin/env bash

php "${PWD}/setup_db/setup.php" &&
echo "Server starting..." &&
php -S localhost:8000 "${PWD}/index.php"