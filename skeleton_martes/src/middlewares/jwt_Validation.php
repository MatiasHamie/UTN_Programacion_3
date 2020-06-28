<?php
// No olvidar el namespace

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use App\Utils\RtaJsend;

class jwt_Validation
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
        $token = $request->getHeader('token');

        if ($token[0] == 'practicando') {
            $response = $handler->handle($request);
            $existingContent = (string) $response->getBody();
            $rta = RtaJsend::JsendResponse('success', array('Todos los Alumnos' => json_decode($existingContent)));
            $response = new Response();
            $response->getBody()->write($rta);
        } else {
            $response = new Response();
            // throw new \Slim\Exception\HttpForbiddenException($request);
            $rta = RtaJsend::JsendResponse('error','Token JWT erróneo');
            $response->getBody()->write($rta);
            return $response;
            throw new \Slim\Exception\HttpForbiddenException($request);
        }
    
    }
}