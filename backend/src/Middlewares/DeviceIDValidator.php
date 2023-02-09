<?php

namespace App\src\Middlewares;

use App\src\Domain\Entities\Device;
use App\src\Domain\Services\DeviceService;
use App\src\Exceptions\ResourceNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response as HttpResponse;

class DeviceIDValidator implements MiddlewareInterface
{
    private DeviceService $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $deviceId = explode("/", $request->getUri()->getPath())[2];

        $response = $this->deviceService->getDeviceById($deviceId);
        if (!$this->isDevice($response)) {
            $errorResponse = new HttpResponse();
            $errorResponse->getBody()->write(json_encode(['error' => 'record with id: ' . $deviceId . ' not found']));
            return $errorResponse->withStatus(404);
        }
        return $handler->handle($request);
    }

    private function isDevice($response): bool
    {
        return $response instanceof Device;
    }

}
