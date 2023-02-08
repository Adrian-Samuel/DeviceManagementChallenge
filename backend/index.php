<?php

use Slim\Factory\AppFactory;
use App\Domain\Repositories\DeviceRepository;
use App\Services\DeviceService;
use App\Controllers\DeviceController;
use Slim\Logger;
use \App\Database\DBSetup;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Database/Connection.php';
require_once __DIR__ . '/src/Domain/Repositories/DeviceRepository.php';
require_once __DIR__ . '/src/Domain/Services/DeviceService.php';
require_once __DIR__ . '/src/Controllers/DeviceController.php';


 $config = include './settings.php';

 $logger = new Logger();
 $entityManager = new DBSetup($config['settings']['doctrine']['connection'], $logger);
 $db = $entityManager->getEntityManager(false);
 $deviceRepository = new DeviceRepository($db);
 $deviceService = new DeviceService($deviceRepository);
 $deviceController = new DeviceController($deviceService);

 $app = AppFactory::create();

 $app->get('/', [$deviceController, 'index']);
 $app->post('/', [$deviceController, 'create']);
 $app->put('/', [$deviceController, 'edit']);
 $app->delete('/', [$deviceController, 'delete']);

 $app->run();