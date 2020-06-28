<?php
// Configuraciones de rutas
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Controllers\AlumnoController;

/*
    Aca no tenemos el $app creado, lo usamos solamente
    entonces para poder accederlo hacemos una funcion
*/
return function($app){
    $app->group('/alumnos', function (RouteCollectorProxy $group) {
        $group->get('[/]', AlumnosController::class . ':getAll');
        $group->get('/:id', AlumnosController::class . ':getAll');
        $group->post('[/]', AlumnosController::class . ':add')->add(AlumnoValidateMiddleware::class);
        $group->put('/:id', AlumnosController::class . ':getAll')->add(AlumnoValidateMiddleware::class);
        $group->delete('/:id', AlumnosController::class . ':getAll');
    })->add(new BeforeMiddleware());

    // $app->group('/materias', function (RouteCollectorProxy $group) {
    //     $group->get('[/]', AlumnosController::class . ':getAll');
    //     $group->get('/:id', AlumnosController::class . ':getAll');
    //     $group->post('[/]', AlumnosController::class . ':getAll');
    //     $group->put('/:id', AlumnosController::class . ':getAll');
    //     $group->delete('/:id', AlumnosController::class . ':getAll');
    // });     
};