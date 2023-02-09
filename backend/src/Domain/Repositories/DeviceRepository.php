<?php

namespace App\Domain\Repositories;

require_once __DIR__ . '/../Entities/Device.php';

use App\Domain\Entities\Device;
use Doctrine\ORM\EntityManager;

class DeviceRepository
{
    private EntityManager $db;

    public function __construct(EntityManager $db)
    {
        $this->db = $db;
    }
    public function findAll()
    {
       return $this->db
           ->createQueryBuilder()
           ->select('d')
           ->from(Device::class, 'd')->getQuery()->getResult();
    }

    public function findById(string $id): Device
    {
        return $this->db->find(Device::class, $id);
    }

    public function add(string $brand, $model, $os, $release_date, bool $is_new): Device
    {
        $device = new Device($brand, $model, $os, $release_date, $is_new);
        $this->db->persist($device);
        $this->db->flush();
        return $this->findById($device->getId());
    }

    public function edit(string $id, $model): Device
    {

        $device = $this->db->find(Device::class, $id);
        $device->setModelName($model);
        $device->setUpdateDatetime();

        $query = $this->db->createQueryBuilder();
        $query->update(Device::class, 'd')
            ->set('d.model', ':model')
            ->set('d.update_datetime', ':update_datetime')
            ->where('d.id = :id')
            ->setParameter(':model', $device->getModel())
            ->setParameter(':update_datetime', $device->getUpdateDatetime() )
            ->setParameter(':id', $id)
            ->getQuery()
            ->execute();
        return $this->db->find(Device::class, $device->getId());

    }

    public function delete(string $id): void
    {
        $this->db->createQueryBuilder()
            ->delete(Device::class, 'd')
            ->where('d.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->execute();
    }
}
