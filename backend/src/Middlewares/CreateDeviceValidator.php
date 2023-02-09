<?php

namespace App\src\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response as HttpResponse;

class CreateDeviceValidationMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $json = json_decode($request->getBody(), true);
        $errorResponse = new HttpResponse();

        $error = $this->validateReleaseDate($json, $errorResponse);
        if($error){
            return $error;
        }
        $error = $this->checkMandatoryFields($json, $errorResponse);
        if($error){
            return $error;
        }
        return $handler->handle($request);
    }

    public function validateReleaseDate(mixed $jsonBody, HttpResponse $response){
        $release_date_pattern  = '/^[1-9]\d{3}\/(0[1-9]|1[0-2])$/';
        if(preg_match($release_date_pattern, $jsonBody['release_date'])){
            $error = [
                'error' => 'Invalid request format. "release_date" should be in the form of "YYYY-MM"'
            ];
            $response->getBody()->write(json_encode($error));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(422);
        }
    }

    public function checkMandatoryFields(mixed $jsonBody, HttpResponse $response) {
        if($jsonBody['model'] == ""){
            $error = [
                'error' => 'Invalid request format. Field "model" not defined.'
            ];
            $response->getBody()->write(json_encode($error));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(422);
        }
        if($jsonBody['brand'] == ""){
            $error = [
                'error' => 'Invalid request format. Field "brand" not defined.'
            ];
            $response->getBody()->write(json_encode($error));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(422);
        }
    }
}
