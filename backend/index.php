<?php

use Slim\Factory\AppFactory;
use App\src\Domain\Repositories\DeviceRepository;
use App\src\Domain\Services\DeviceService;
use App\src\Controllers\DeviceController;
use App\src\Middlewares\CreateDeviceValidator;
use App\src\Middlewares\EditDeviceValidator;
use App\src\Middlewares\DeviceIDValidator;
use Slim\Logger;
use App\src\Database\Database;

error_reporting(E_ERROR | E_PARSE);

ini_set('display_errors', 0);


require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Database/Database.php';
require_once __DIR__ . '/src/Domain/Repositories/DeviceRepository.php';
require_once __DIR__ . '/src/Domain/Services/DeviceService.php';
require_once __DIR__ . '/src/Controllers/DeviceController.php';
require_once __DIR__ . '/src/Middlewares/CreateDeviceValidator.php';
require_once __DIR__ . '/src/Middlewares/EditDeviceValidator.php';
require_once __DIR__ . '/src/Middlewares/DeviceIDValidator.php';

$config = include './settings.php';

$logger = new Logger();
$entityManager = new Database($config['settings']['doctrine']['connection'], $logger);
$db = $entityManager->getEntityManager(true);
$deviceRepository = new DeviceRepository($db);
$deviceService = new DeviceService($deviceRepository);
$deviceController = new DeviceController($deviceService);

$app = AppFactory::create();

$app->get('/devices', [$deviceController, 'index']);
$app->get('/device/{id}', [$deviceController, 'get'])->add(new DeviceIDValidator($deviceService));
$app->post('/device', [$deviceController, 'create'])->add(new CreateDeviceValidator());
$app->put('/device/{id}', [$deviceController, 'edit'])->add(new DeviceIDValidator($deviceService))->add(new EditDeviceValidator());
$app->delete('/device/{id}', [$deviceController, 'delete'])->add(new DeviceIDValidator($deviceService));

$app->run();