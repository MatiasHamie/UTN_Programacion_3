<?php
// No olvidar el namespace

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use App\Utils\RtaJsend;
use \Firebase\JWT\JWT;

class EsAdminMiddleware
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
        try{
            $tokenExiste = false;
            $headers = $request->getHeaders();
            foreach ($headers as $key => $value) {
                if($key == 'token'){
                    $tokenExiste = true;
                    break;
                }
            }
            if($tokenExiste){
                $token_recibido = $request->getHeaders()['token'][0];
                if($token_recibido != ''){
                    $usuario_decodificado = JWT::decode($token_recibido, "Practica_Segundo_Parcial_Programacion3_MNH", array('HS256'));
                    // var_dump($usuario_decodificado);
                    if($usuario_decodificado->tipo == 3){
                        $response->getBody()->write($existingContent);
                    } else {
                        $response->getBody()->write(RtaJsend::JsendResponse('error','El usuario no es admin para registrar tipo de mascota'));
                    }
                } else {
                    $response->getBody()->write(RtaJsend::JsendResponse('error','No se recibió ningun token'));
                }
            } else {
                $response->getBody()->write(RtaJsend::JsendResponse('error','No existe ningun header que se llame token'));
            }
        } catch (\Throwable $th) {
            $response = new Response();
            $response->getBody()->write(RtaJsend::JsendResponse('error','Token JWT erroneo '));
            return $response;
        }
    
        return $response;
    }
}