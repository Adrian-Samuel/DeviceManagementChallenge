<?php

namespace App\src\Domain\Repositories;

require_once __DIR__ . '/../Entities/Device.php';
require_once __DIR__ . '/../../Exceptions/Exceptions.php';

use App\src\Domain\Entities\Device;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use App\src\Exceptions\ResourceNotFoundException;

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

    /**
     * @throws ResourceNotFoundException
     */
    public function findById(string $id)
    {
        try {
            $result = $this->db->find(Device::class, $id);
            if($result == null){
                return new ResourceNotFoundException("Resource with id: " . $id . ' not found', 404);
            }
            return $result;
        } catch (ORMException $e) {
            throw new ResourceNotFoundException("Resource with id: " . $id . ' not found', 404);
        }
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function add(string $brand, $model, $os, $release_date, $is_new): Device
    {
        $device = new Device($brand, $model, $os, $release_date, $is_new);
        try {
            $this->db->persist($device);
        } catch (ORMException $e) {
            throw new ResourceNotFoundException("Resource not found", 404, $e);
        }
        $this->db->flush();
        return $this->findById($device->getId());
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function edit(string $id, $model): Device
    {

        $device = $this->findById($id);
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
        return $this->findById($device->getId());

    }

    public function delete(string $id)
    {
        $device = $this->findById($id);
        if($device instanceof Device){
            return $device;
        }

        $this->db->createQueryBuilder()
            ->delete(Device::class, 'd')
            ->where('d.id = :id')
            ->setParameter(':id', $id)
            ->getQuery()
            ->execute();
    }
}
