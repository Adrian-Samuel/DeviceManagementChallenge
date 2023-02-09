<?php


namespace App\src\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response as HttpResponse;

class EditDeviceValidationMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $json = json_decode($request->getBody(), true);
        $errorResponse = new HttpResponse();

        $error = $this->checkMandatoryFields($json, $errorResponse);
        if ($error) {
            return $error;
        }
        return $handler->handle($request);
    }

    public function checkMandatoryFields(mixed $jsonBody, HttpResponse $response)
    {
        if ($jsonBody['model'] == "") {
            $error = [
                'error' => 'Invalid request format. Field "model" not defined.'
            ];
            $response->getBody()->write(json_encode($error));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(422);
        }
    }
}
