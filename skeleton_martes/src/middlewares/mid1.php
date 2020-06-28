<?php
// No olvidar el namespace

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class BeforeMiddleware
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
        /*
            Validamos JWT
            getHeader('mi_token');
        */
        $valido = !true;

        if ($valido) {
            $response = new Response();
            throw new \Slim\Exception\HttpForbiddenException($request);
            $response->getBody()->withStatus(403);
        } else {
            $response = $handler->handle($request);
            $existingContent = (string) $response->getBody();
            $response = new Response();
            $response->getBody()->write($existingContent);
        }
    
        return $response;
    }
}