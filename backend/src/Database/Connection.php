<?php

namespace App\Database;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Slim\Logger;

const PATHS = [__DIR__ . '/src/Domain/Entities'];

class DBSetup
{
    protected Logger $log;
    protected array $settings;
    public function __construct(array $settings, Logger $logger){
        $this->settings = $settings;
        $this->log = $logger;
    }

    private function getDatabaseConfig(array $list): array
    {
        return array_diff($list, ['charset']);
    }

    public function getEntityManager(bool $isProduction): EntityManager
    {
        $connectParams = [];
        try {
            $connectParams = $this->getDatabaseConfig($this->settings);
        } catch (Exception $e) {
            $this->log->error($e);
        }

        $config = ORMSetup::createAttributeMetadataConfiguration(PATHS, $isProduction);
        $connection =  DriverManager::getConnection($connectParams, $config);
        return new EntityManager($connection, $config);
    }
}
