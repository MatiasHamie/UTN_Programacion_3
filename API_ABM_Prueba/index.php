<?php

/** 
 * Este ejercicio se basa en hacer una API
 * con un ABM de 3 clases distintas.
 * 
 * Notas:
 * Cuando envíe una respuesta al frontend, 
 * voy a usar una generadad por una stdClass
 */

require_once __DIR__ . "./clases/persona.php";
require_once __DIR__ . "./clases/auto.php";
require_once __DIR__ . "./clases/empresa.php";
require_once __DIR__ . "./archivos/leer.php";

echo "-- TP API ABM -- <br><br>";

//Variables
//Verifico el tipo de request
$requestType = $_SERVER['REQUEST_METHOD'];
$pathInfo = $_SERVER['PATH_INFO'];
$request = $_REQUEST;

//Variables objeto
$persona;
$auto;
$empresa;

//Variables de respuesta al frontend
$respuesta = new stdClass();

//Verifico el id del request
switch ($pathInfo) {
    case '/persona':
        if($requestType == 'POST'){
            if (isset($request['nombre']) && isset($request['edad'])) {
                echo "Seteando persona<br>";
                $persona = new Persona($request['nombre'],$request['edad']);
                $persona->EscribirArchivo();
                echo "Persona generada: <br>" . json_encode($persona->getInfo());
            }
        }
        elseif ($requestType == 'GET') {
            // if (isset($request['nombre']) && isset($request['edad'])) {
                $persona = new Persona();
                echo "Personas leidas del archivo de texto: <br>" . json_encode($persona->LeerArchivo());
            // }
        }
        else {
            # code...
        }
        break;
    case '/auto':
        # code...
        break;
    case '/empresa':
        # code...
        break;
    default:
        # code...
        break;
}
