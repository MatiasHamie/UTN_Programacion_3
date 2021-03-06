<?php
namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AlumnoValidateMiddleware
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
        $response = $handler->handle($request);
        $existingContent = (string) $response->getBody();

        $response = new Response();

        /**
         * VALIDAR JWT
         * getHeader('mi_token)
         */
        if (true) {
            $response->getBody()->write($existingContent);
        } else {
            $response->getBody()->write('NO autorizado ');
        }

        // $response->getBody()->write('BEFORE ' . $existingContent);

        return $response;
    }
}
