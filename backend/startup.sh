#!/usr/bin/env bash

bash "${PWD}/setup_db/setup.php" && php -S localhost:8000 "${PWD}/index.php"