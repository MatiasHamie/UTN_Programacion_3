<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Mascota;
use App\Utils\RtaJsend;

class MascotasController {

    public function registrarMascota(Request $request, Response $response, $args){
        $mascota = new Mascota();

        $datos = $request->getParsedBody();
        $mascota->nombre = $datos['nombre'];
        $mascota->fecha_nacimiento = new \DateTime($datos['fecha_nacimiento']);
        $mascota->cliente_id = $datos['cliente_id'];
        $mascota->tipo_mascota_id = $datos['tipo_mascota_id'];

        $rta = RtaJsend::JsendResponse('Registro Mascota',($mascota->save()) ? 'Ok' : 'Fallo');
        $response->getBody()->write($rta);
        return $response;
    }

    public function verHistorialMascota(Request $request, Response $response, $args){
        $mascota = new Mascota();
        $mascota->id = $args;

        // Dia de hoy
        $zone=3600 * -3;
        $fechaActual = gmdate('d/m/Y', time() + $zone);

        $historialTurnosSQL = Mascota::select('mascotas.nombre','mascotas.edad','turnos.fecha')    
        ->join('turnos','turnos.mascota_id','mascotas.id')    
        ->where('mascotas.id',$mascota->id)
        ->where('turnos.fecha','<=',$fechaActual)
        ->get();

        $rta = RtaJsend::JsendResponse('success',array('Historial de turnos previos al dia de hoy'=>$historialTurnosSQL));
        $response->getBody()->write($rta);
        return $response;
    }
}