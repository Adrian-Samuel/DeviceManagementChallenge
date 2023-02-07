<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use DI\Container;
use Slim\Logger;
use ORM\Configure\dbSetup;

 require __DIR__ . '/../vendor/autoload.php';
 require __DIR__ . '/../Connection.php';

 $settings = require __DIR__ . '/index.php';
 $logger = new Logger();

 $container = new Container();
 $entityManager = new dbSetup($container, $logger);

 // supply the db to the Repository
 $db = $entityManager->getEntityManager(false)->getConnection();


// // Repository uses sql queries under the hood


$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->run();