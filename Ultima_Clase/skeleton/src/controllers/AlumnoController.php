<?php
namespace App\Controllers;
// Configuraciones de rutas
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Alumno;

class AlumnoController {
    public function getAll(Request $request, Response $response){
        $rta = Alumno::get();
        $response->getBody()->write('Get desde src/controllers/AlumnoController.php');
        // $response->getBody()->write('Get desde src/controllers/AlumnoController.php');
        return $response;
    }

    public function getOne(Request $request, Response $response){
        $response->getBody()->write('getOne desde src/controllers/AlumnoController.php');
        return $response;
    }

    public function add(Request $request, Response $response){
        $alumno = new Alumno;
        $alumno->alumno = "Juan";
        $alumno->legajo = 6578;
        $rta = $alumno->save();
        $response->getBody()->write('add desde src/controllers/AlumnoController.php');
        return $response;
    }

    public function update(Request $request, Response $response){
        
        $response->getBody()->write('update desde src/controllers/AlumnoController.php');
        return $response;
    }

    public function delete(Request $request, Response $response){
        $response->getBody()->write('delete desde src/controllers/AlumnoController.php');
        return $response;
    }
}