<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\TipoMascota;
use App\Utils\RtaJsend;

class TipoMascotaController {
    public function registrarTipoMascota(Request $request, Response $response, $args){
        $tipo_mascota = new TipoMascota();

        $datos = $request->getParsedBody();
        $tipo_mascota->tipo = $datos['tipo'];

        $rta = RtaJsend::JsendResponse('Registro Tipo Mascota',($tipo_mascota->save()) ? 'Ok' : 'Fallo');
        $response->getBody()->write($rta);
        return $response;
    }

}