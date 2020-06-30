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
        if(($auxTipo != '') && (($auxTipo == 'veterinario') || ($auxTipo == 'cliente') || ($auxTipo == 'veterinario'))){
            if($auxTipo == 'veterinario'){
                $tipo = 1;
            } else if($auxTipo == 'cliente'){
                $tipo = 2;
            } else {
                $tipo = 3;
            }
            $usuario->tipo = $tipo;
        } 

        $usuario->usuario = $datosPostSinValidar['usuario'] ?? '';
    
        $usuario->clave = GeneradorToken::GenerarTokenJWTPassword($datosPostSinValidar['clave']);
        return $usuario;
    }
    static public function LoginUsuario($usuario_leidoSQL, $password_recibido){
        try {
            $password_decodificado = JWT::decode($usuario_leidoSQL->clave, 'Password', array('HS256'))[0];
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