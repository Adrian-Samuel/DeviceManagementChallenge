<?php

namespace ORM\Configure;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Slim\Logger;
use Exception;

const PATHS = [__DIR__ . '/src/Domain/Entities'];

class dbSetup
{
    protected Logger $log;
    protected array $settings;
    public function __construct(array $settings, Logger $logger){
        $this->settings = $settings;
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
            $connectParams = $this->getDatabaseConfig($this->settings->connection);
        } catch (Exception $e) {
            $this->log->error($e);
            dd($e);
        }

        $config =  ORMSetup::createAttributeMetadataConfiguration(PATHS, $isProduction);
        $connection =  DriverManager::getConnection($connectParams, $config);
        return new EntityManager($connection, $config);
    }
}
