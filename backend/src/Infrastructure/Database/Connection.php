<?php

namespace ORM\Configure;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Slim\Logger;
use Psr\Container\ContainerInterface;
use Psr\Container;

const PATHS = [__DIR__ . '/src/Domain'];

class dbSetup
{
    protected ContainerInterface $container;
    protected Logger $log;
    public function __construct(ContainerInterface $container, Logger $logger){
        $this->container = $container;
        $this->log = $logger;
    }

    private function getDatabaseConfig(array $list): array
    {
        return collect($list)->filter(function($value, $key){
           if($key != 'charset') return;
        })->toArray();
    }

    public function getEntityManager(bool $isProduction): EntityManager
    {
        $connectParams = [];
        try {
            $connectParams = $this->getDatabaseConfig($this->container->get('settings')->connection);
        } catch (Container\ContainerExceptionInterface $e) {
            $this->log->error($e);
            dd($e);
        }

        $config =  ORMSetup::createAttributeMetadataConfiguration(PATHS, $isProduction);
        return DriverManager::getConnection($connectParams, $config);
    }
}
