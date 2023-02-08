<?php

namespace App\Controllers;

use App\Services\DeviceService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;



class DeviceController
{
    private DeviceService $deviceService;
    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    public function index(Request $request, Response $response, $args)
    {
        $devices = $this->deviceService->getDevices();
        $response->getBody()->write(json_encode($devices));
        $response->withHeader('Content-Type', 'application/json');
        $response->withStatus(200);
        return $response;
    }

    public function create(Request $request, Response $response, $args)
    {
        $requestBody = json_decode($request->getBody()->getContents(), true);
        $brand = $requestBody['brand'];
        $model = $requestBody['model'];
        $os = $requestBody['os'];
        $release_date = $requestBody['release_date'];
        $is_new = $requestBody['is_new'];

        $editedDevice = $this->deviceService->createDevice($brand, $model, $os, $release_date, $is_new);
        $response->getBody()->write(json_encode($editedDevice));
        $response->withHeader('Content-Type', 'application/json');
        $response->withStatus(200);
        return $response;
    }

    public function edit(Request $request, Response $response, $args)
    {
        $requestBody = json_decode($request->getBody()->getContents(), true);
        $id = $requestBody['id'];
        $model = $response['model'];
        $editedDevice = $this->deviceService->editModelName($id, $model);
        $response->getBody()->write(json_encode($editedDevice));
        $response->withHeader('Content-Type', 'application/json');
        $response->withStatus(200);
        return $response;
    }
    public function delete(Request $request, Response $response, $args)
    {
       $requestBody = json_decode($request->getBody()->getContents(), true);
       $id = $requestBody['id'];
       $this->deviceService->deleteDevice($id);
       $response->withStatus(200);
       return $response;
    }


}