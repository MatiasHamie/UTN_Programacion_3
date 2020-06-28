<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Usuario;
use App\Utils\RtaJsend;
use App\Utils\ValidarPost;
use Config\Database;
use \Firebase\JWT\JWT;

class UsuariosController {

    public function registro(Request $request, Response $response, $args){
        $usuario = new Usuario();
        $usuario = ValidarPost::RegistroUsuario($usuario, $_POST);
        $rta = RtaJsend::JsendResponse('Registro Usuario',(($usuario->save()) ? 'ok' : 'error'));
        $response->getBody()->write($rta);
        return $response;
    }

    public function login(Request $request, Response $response, $args){
        $email_recibido = $_POST['email'] ?? '';
        $password_recibido = $_POST['password'] ?? '';

        if(($email_recibido != '') && $password_recibido != '') {
            $usuario_leidoSQL = Usuario::all()->where('email',$email_recibido)->first();
            $rta = ValidarPost::LoginUsuario($usuario_leidoSQL, $password_recibido);
        }
        

        $response->getBody()->write($rta);
        return $response;
    }
}