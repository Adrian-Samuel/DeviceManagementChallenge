<?php

use Slim\Factory\AppFactory;
use App\Domain\Repositories\DeviceRepository;
use App\Services\DeviceService;
use App\Controllers\DeviceController;
use Slim\Logger;
use ORM\Configure\dbSetup;

 require __DIR__ . '/vendor/autoload.php';
 require 'src/Infrastructure/Database/Connection.php';

 $config = require './settings.php';
 $logger = new Logger();

 $entityManager = new dbSetup($config->settings->connection, $logger);
 $db = $entityManager->getEntityManager(false);
 $deviceRepository = new DeviceRepository($db);
 $deviceService = new DeviceService($deviceRepository);
 $deviceController = new DeviceController($deviceService);

 $app = AppFactory::create();

 $app->get('/', [$deviceController::class, 'index']);
 $app->post('/', [$deviceController::class, 'create']);
 $app->put('/', [$deviceController::class, 'edit']);
 $app->delete('/', [$deviceController::class, 'delete']);

 $app->run();