<?php

namespace App\src\Controllers;

require __DIR__ . '/../Domain/DTOs/DeviceDTO.php';

use App\src\Domain\Entities\Device;
use App\src\Domain\Services\DeviceService;
use App\Domain\DTOs\DeviceDTO;
use App\src\Exceptions\ResourceNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DeviceController
{
    private DeviceService $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    private function deviceToJson(Device $device): DeviceDTO
    {
        return new DeviceDTO(
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

    // middleware?
    public function index(Request $request, Response $response): Response
    {
        $devices = $this->deviceService->getDevices();
        $dtoDevices = [];
        foreach ($devices as $device) {
            $dtoDevices[] = $this->deviceToJson($device);
        }
        $response->getBody()->write(json_encode($dtoDevices));
        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function get(Request $request, Response $response, $args): Response
    {
        $device = $this->deviceService->getDeviceById($args['id']);
        if (!($device instanceof Device)) {
            $response->getBody()->write(json_encode(["error" => $device->getMessage() . ' not found']));
        } else {
            $response->getBody()->write(json_encode($this->deviceToJson($device)));
        }
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

        $newDevice = $this->deviceService->createDevice($brand, $model, $os, $release_date, $is_new);
        $response->getBody()->write(json_encode($this->deviceToJson($newDevice)));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function edit(Request $request, Response $response, $args): Response
    {
        $requestBody = json_decode($request->getBody()->getContents(), true);
        $device = $this->deviceService->editModelName($args['id'], $requestBody['model']);
        $response->getBody()->write(json_encode($this->deviceToJson($device)));
        return $response->withHeader('Content-Type', 'application/json');

    }

    public function delete(Request $request, Response $response, $args): Response
    {
        $this->deviceService->deleteDevice($args['id']);
        $response->withStatus(200);
        return $response;
    }


}