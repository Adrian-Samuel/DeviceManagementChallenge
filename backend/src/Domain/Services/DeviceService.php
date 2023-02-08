<?php

namespace App\Services;

use App\Domain\Repositories\DeviceRepository;

class DeviceService
{
    private DeviceRepository $deviceRepository;

    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function createDevice(string $brand, $model, $os, $release_date, bool $is_new)
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

    public function getDeviceById(string $id){
        return $this->deviceRepository->findById($id);
    }


}