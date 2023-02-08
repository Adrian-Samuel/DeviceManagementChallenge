<?php

namespace App\Domain\Repositories;

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
       return  $this->db->createQuery('SELECT * FROM Device devices')->getResult();
    }

    public function add(string $brand, $model, $os, $release_date, bool $is_new): Device
    {
        $device = new Device( $brand, $model, $os, $release_date, $is_new);
        $this->db->persist($device);
        return $this->db->find(Device::class, $device->getId());
    }

    public function edit(string $id, $model): Device
    {
        $device = $this->db->find(Device::class, $id);
        $device->setModelName($model);
        $this->db->flush();
        return $this->db->find(Device::class, $device->getId());

    }

    public function delete(string $id): void
    {
        $device = $this->db->find(Device::class, $id);
        $this->db->remove($device);
    }
}
