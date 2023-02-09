<?php

namespace App\src\Domain\Services;

use App\src\Domain\Repositories\DeviceRepository;
use App\src\Exceptions\ResourceNotFoundException;

class DeviceService
{
    private DeviceRepository $deviceRepository;

    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function createDevice($brand, $model, $os, $release_date, $is_new)
    {

        return $this->deviceRepository->add($brand, $model, $os, $release_date, $is_new);;
    }

    public function editModelName(string $id, $model)
    {
        return $this->deviceRepository->edit($id, $model);
    }

    public function deleteDevice(string $id)
    {
        return $this->deviceRepository->delete($id);
    }

    public function getDevices()
    {
        return $this->deviceRepository->findAll();
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function getDeviceById(string $id)
    {
        return $this->deviceRepository->findById($id);
    }


}