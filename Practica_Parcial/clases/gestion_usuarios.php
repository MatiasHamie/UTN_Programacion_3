<?php

require_once __DIR__ . "./response.php";
require_once __DIR__ . "./persona.php";
require_once __DIR__ . "./gestion_archivos.php";

//JWT
use \Firebase\JWT\JWT;

class Gestion_Usuarios
{
    public static function RegistrarUsuario($directorio_usuarios, $post_request = null)
    {
        if (isset($post_request)) {
            if (
                isset($post_request['nombre']) && isset($post_request['dni']) && isset($post_request['obra_social']) &&
                isset($post_request['clave']) && isset($post_request['tipo'])
            ) {

                $usuario = new Persona($post_request['nombre'], $post_request['dni'], $post_request['obra_social'], $post_request['clave'], $post_request['tipo']);

                return Gestion_Archivos::Guardar_Usuario($usuario, $directorio_usuarios);
            }
        } else {
            return Response::JsendResponse("Fail", "Usuario recibido nulo");
        }
    }

    public static function LoginUsuario($directorio_usuarios, $nombre_recibido, $clave_recibida)
    {
        if (isset($nombre_recibido) && isset($clave_recibida) && isset($directorio_usuarios)) {
            $usuarios_registrados = Gestion_Archivos::Leer_Usuarios($directorio_usuarios);
            if ($usuarios_registrados != '') {
                foreach ($usuarios_registrados as $indice => $persona) {
                    if ($persona->nombre == $nombre_recibido) {
                        if ($persona->clave == $clave_recibida) {
                            //Devuelvo jwt
                            $key = "Practica_Primer_Parcial_Programacion3_MNH";
                            $payload = array(
                                'id' => $persona->id,
                                'nombre' => $persona->nombre,
                                'dni' => $persona->dni,
                                'obra_social' => $persona->obra_social,
                                'tipo' => $persona->tipo,
                                // 'clave' => $persona->clave,
                            );

                            $jwt = JWT::encode($payload, $key);
                            return Response::JsendResponse("success", array("token" => $jwt));
                        }
                    }
                }
            } else {
                echo Response::JsendResponse("Error", "No hay usuarios registrados al momento");
            }
        }
    }

    public static function EsAdmin($usuario)
    {
        if ($usuario == null) return false;
        
        return ($usuario->tipo == 'admin') ? true : false;
    }

    public static function getUser($headers = null, $key)
    {
        if (isset($headers)) {
            try {
                $token = $headers['token'];
                $usuario_decodificado = JWT::decode($token, $key, array('HS256'));
                return $usuario_decodificado;
            } catch (\Throwable $th) {
                return Response::JsendResponse("Error", $th->getMessage());
            }
        }
    }
}
