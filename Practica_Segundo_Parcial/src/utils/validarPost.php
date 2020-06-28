<?php

namespace App\Utils;
use \Firebase\JWT\JWT;
use App\Utils\GeneradorToken;

class ValidarPost{
    
    static public function RegistroUsuario($usuario, $datosPostSinValidar){
        $usuario->email = $datosPostSinValidar['email'] ?? '';
        // Verifico tipo ingresado en string y lo paso a un tipo_id
        // 1: veterinario
        // 2: cliente
        $auxTipo = $datosPostSinValidar['tipo'] ?? '';
        if(($auxTipo != '') && (($auxTipo == 'veterinario') || ($auxTipo == 'cliente'))){
            $usuario->tipo_id = ($auxTipo == 'veterinario') ? 1 : 2;
        } 
    
        $usuario->password = GeneradorToken::GenerarTokenJWTPassword($datosPostSinValidar['password']);
        return $usuario;
    }
    static public function LoginUsuario($usuario_leidoSQL, $password_recibido){
        try {
            $password_decodificado = JWT::decode($usuario_leidoSQL->password, 'Password', array('HS256'))[0];
            if($password_decodificado == $password_recibido){
                $rta = GeneradorToken::GenerarTokenJWTHeader($usuario_leidoSQL, $password_decodificado);
            } else {
                $rta = RtaJsend::JsendResponse('error','Password incorrecto');
            }
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }

        return $rta;
    }
}