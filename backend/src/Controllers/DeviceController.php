<?php

namespace App\Controllers;

require __DIR__ . '/../Domain/DTOs/DeviceDTO.php';

use App\Domain\Entities\Device;
use App\Services\DeviceService;
use App\Domain\DTOs\DeviceDTO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DeviceController
{
    private DeviceService $deviceService;
    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    public function index(Request $request, Response $response)
    {
        $devices = $this->deviceService->getDevices();
        $formattedList = [];
        foreach ($devices as $device)
        {
            $formattedList[] = new DeviceDTO(
                $device->getId(),
                $device->getModel(),
                $device->getOs(),
                $device->getBrand(),
                $device->getReleaseDate(),
                $device->getReceivedDatatime(),
                $device->getIsNew(),
                $device->getCreatedDatetime(),
                $device->getUpdateDatetime()
            );
        }

        $response->getBody()->write(json_encode($formattedList));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function create(Request $request, Response $response): Response
    {
        $requestBody = json_decode($request->getBody()->getContents(), true);
        $brand = $requestBody['brand'];
        $model = $requestBody['model'];
        $os = $requestBody['os'];
        $release_date = $requestBody['release_date'];
        $is_new = $requestBody['is_new'];

        $editedDevice = $this->deviceService->createDevice($brand, $model, $os, $release_date, $is_new);
        $response->getBody()->write(json_encode($editedDevice));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function edit(Request $request, Response $response): Response
    {
        $requestBody = json_decode($request->getBody()->getContents(), true);
        $id = $requestBody['id'];
        $model = $response['model'];
        $editedDevice = $this->deviceService->editModelName($id, $model);
        $response->getBody()->write(json_encode($editedDevice));
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function delete(Request $request, Response $response, $args): Response
    {
       $requestBody = json_decode($request->getBody()->getContents(), true);
       $id = $requestBody['id'];
       $this->deviceService->deleteDevice($id);
       $response->withStatus(200);
       return $response;
    }


}