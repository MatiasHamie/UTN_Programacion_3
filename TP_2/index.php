<?php
/*-------------------------
          UTN 
    Trabajo Práctico N°2 
    Materia: Programación 3
    Alumno: Hamie Matias Nahuel
    Autenticación por JWT
 -------------------------*/

//Directorios
require_once __DIR__ . "/clases/persona.php";
require_once __DIR__ . "/archivos.php";
require_once __DIR__ . "/response.php";
require_once __DIR__ . "/vendor/autoload.php";

//JWT
use \Firebase\JWT\JWT;
$key = "tp2_programacion3_MNH";

//Inicio de declaracion/Inicializacion de variables-------
//Variables globales de sesion
$requestPath = $_SERVER['PATH_INFO'] ?? '';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? '';

//Variables comunes
$persona;

/*
    Verifico que el cliente interroge por una clase,
    Los unicos tipos de solicitud soportados son GET y 
    POST, cualquier otro tipo sera devuelto un mensaje 
    de error 404
*/
if ($requestPath != '') {
    if ($requestMethod == 'POST') {
        switch ($requestPath) {
            case '/signin':     
                //Guardo en variables todo lo ingresado por el cliente
                $email = $_POST['email'] ?? '';
                $clave = $_POST['clave'] ?? '';
                $nombre = $_POST['nombre'] ?? '';
                $apellido = $_POST['apellido'] ?? '';
                $telefono = $_POST['telefono'] ?? '';
                $tipo = $_POST['tipo'] ?? '';

                if(($email != '') && ($clave != '') && ($nombre != '') && ($apellido != '') && ($telefono != '') && ($tipo != '')){
                    //Creo persona
                    $persona = new Persona($email, $clave, $nombre, $apellido, $telefono, $tipo);
                    //Instancio archivos para guardar la persona
                    $archivos = new Archivos("usuarios.dat");
                    //Doy feedback al respecto
                    if ($archivos->Guardar_Persona($persona)) {
                        echo Response::JsonResponse("success","Se ha registrado correctamente al usuario ingresado");
                    } else {
                        echo Response::JsonResponse("fail","Ha ocurrido un error al registrar al usuario ingresado");
                    }
                } else {
                    echo Response::JsonResponse("fail","Datos faltantes, revise e intente nuevamente");
                }
                break;
            case '/login':
                $archivos = new Archivos("usuarios.dat");
                $persona = $archivos->VerUsuarioCreado($_POST['email'],$_POST['clave']);

                if (isset($persona)) {
                    $key = "tp2_programacion3_MNH";
                    $payload = array(
                        'email' => $persona->email,
                        'clave' => $persona->clave,
                        'nombre' => $persona->nombre,
                        'apellido' => $persona->apellido,
                        'telefono' => $persona->telefono,
                        'tipo' => $persona->tipo
                    );

                    $jwt = JWT::encode($payload, $key);

                    echo Response::JsonResponse("success", array(
                        "token" => $jwt
                    ));
                } else {
                    echo Response::JsonResponse("fail", "Email o Contrasena incorrectos");
                }
                break;
            default:
                echo Response::JsonResponse("error", "Endpoint invalido, intente login o signin");
                break;
        }
    }elseif ($requestMethod == 'GET') {
        $headers = getallheaders();
        $token = $headers['token'] ?? '';
        if (isset($token)) {
            try {
                $decoded = JWT::decode($token, $key, array('HS256'));
                switch ($requestPath) {
                    case '/detalle':     
                        echo Response::JsonResponse("success", array("post" => $decoded));
                        break;
                    case '/lista':
                        $archivos = new Archivos("usuarios.dat");
                        $listaDePersonas = $archivos->MostrarUsuarios($decoded);
                        echo Response::JsonResponse("success", array("posts" => $listaDePersonas));
                        break;
                    default:
                        echo Response::JsonResponse("error","Tipo de solicitud errónea, pruebe /detalle o /lista");
                        break;
                }
            } catch (\Throwable $th) {
                echo Response::JsonResponse("error", $th->getMessage());
            }
        }
    }else{
        echo Response::JsonResponse("error","Método no soportado (solo GET o POST)");
    }
} else {
    echo Response::JsonResponse("error","No se encontro Endpoint");
}
