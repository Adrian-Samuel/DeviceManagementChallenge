<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\src\Middlewares\CreateDeviceValidator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use  Slim\Psr7\Uri;
use Slim\Psr7\Stream;
use Slim\Psr7\Headers;

require __DIR__ . '/../src/Middlewares/CreateDeviceValidator.php';

class CreateDeviceValidationMiddlewareTest extends TestCase
{

    public function testProcessWithInvalidReleaseDate()
    {
        $uri = new Uri('http', '', '8000', '/devices');
        $body = json_encode(['model' => 'iPhone X', 'brand' => 'Apple', 'release_date' => '2022/01']);
        $stream = new Stream(fopen('php://temp', 'r+'));
        $stream->write($body);
        $headers = new Headers(['Content-Type' => 'application/json']);


        $request = new Request('POST', $uri, $headers, [], [], $stream);
        $handler = $this->createMock(RequestHandlerInterface::class);
        $handler->expects($this->never())
            ->method('handle');

        $middleware = new CreateDeviceValidator();
        $response = $middleware->process($request, $handler);

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertEquals('{"error":"Invalid request format. \"release_date\" should be in the form of \"YYYY-MM\""}', (string)$response->getBody());
    }

    public function testProcessWithMissingModel()
    {
        $uri = new Uri('http', '', '8000', '/devices');
        $body = json_encode(['brand' => 'Apple', 'release_date' => '2022-01']);
        $stream = new Stream(fopen('php://temp', 'r+'));
        $stream->write($body);
        $headers = new Headers(['Content-Type' => 'application/json']);

        $request = new Request('POST', $uri, $headers, [], [], $stream);
        $handler = $this->createMock(RequestHandlerInterface::class);
        $handler->expects($this->never())
            ->method('handle');

        $middleware = new CreateDeviceValidator();
        $response = $middleware->process($request, $handler);

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertEquals('{"error":"Invalid request format. Field \"model\" not defined."}', (string)$response->getBody());
    }

    public function testProcessWithMissingBrand()
    {

        $uri = new Uri('http', '', '8000', '/devices');
        $body = json_encode(['model' => 'iPhone X', 'release_date' => '2022-01']);
        $stream = new Stream(fopen('php://temp', 'r+'));
        $stream->write($body);
        $headers = new Headers(['Content-Type' => 'application/json']);

        $request = new Request('POST', $uri, $headers, [], [], $stream);
        $handler = $this->createMock(RequestHandlerInterface::class);
        $handler->expects($this->never())
            ->method('handle');

        $middleware = new CreateDeviceValidator();
        $response = $middleware->process($request, $handler);

        $this->assertEquals(422, $response->getStatusCode());
        $this->assertEquals('application/json', $response->getHeaderLine('Content-Type'));
        $this->assertEquals('{"error":"Invalid request format. Field \"brand\" not defined."}', (string)$response->getBody());
    }

    public function testProcessWithValidRequest()
    {
        $uri = new Uri('http', '', '8000', '/devices');
        $body = json_encode(['model' => 'iPhone X', 'release_date' => '2022-01']);
        $stream = new Stream(fopen('php://temp', 'r+'));
        $stream->write($body);
        $headers = new Headers(['Content-Type' => 'application/json']);

        $request = new Request('POST', $uri, $headers, [], [], $stream);
        $handler = $this->createMock(RequestHandlerInterface::class);
        $handler->expects($this->never())
            ->method('handle')
            ->willReturn(new Response());

        $middleware = new CreateDeviceValidator();
        $response = $middleware->process($request, $handler);

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }
}