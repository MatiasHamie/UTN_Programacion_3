<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Alumno;
use App\Utils\RtaJsend;
use Config\Database;

class AlumnosController {
    
    public function getAll(Request $request, Response $response){
        // clase::all() traigo todos
        $rta = json_encode(Alumno::all());
        $response->getBody()->write($rta);
        return $response;
    }

    public function getOne(Request $request, Response $response, array $args){
        // $queryString_ID = $request->getQueryParams();
        // $rta = array('success' => true, 'data' => $args);
        $rta = RtaJsend::JsendResponse('success',array("Alumno con id ".$args['id'] => Alumno::find($args['id'])));
        $response->getBody()->write($rta);
        return $response;
    }

    public function add(Request $request, Response $response){
        $alumno = new Alumno();
        $alumno->alumno = $_POST['alumno'] ?? '';
        $alumno->legajo = $_POST['legajo'] ?? '';
        $alumno->localidad = $_POST['localidad'] ?? '';
        $alumno->cuatrimestre = $_POST['cuatrimestre'] ?? '';

        $rta = RtaJsend::JsendResponse('add',array("se grabo nuevo alumno" => $alumno->save()));
        $response->getBody()->write($rta);
        return $response;
    }

    public function updateOne(Request $request, Response $response, array $args){

        // $affected = Alumno::where('id',$args['id']);
        $queryString = $request->getQueryParams();
        $rta = json_encode($queryString['alumno']);
        var_dump($queryString);
        // ->update(['alumno' => $args['alumno']]);
        // $rta = json_encode($affected);
        // $rta = RtaJsend::JsendResponse('update',array("filas modificadas" => $alumno->update(['alumno' => $args['alumno']])));
        $response->getBody()->write($rta);
        return $response;
    }
}