<?php
// No olvidar el namespace
namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class JsonConvertResponseMiddleware
{
    /**
     * Example middleware invokable class
     *
     * @param  ServerRequest  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        // Con esto hago que todas las rutas devuelvan json
        $response = $handler->handle($request);
        $response = $response->withHeader('Content-type','application/json');
        // $response->getBody()->write('AFTER');

        return $response;
    }
}