<?php
// Aca incluyo mis controladores
use Slim\Routing\RouteCollectorProxy;
use App\Controllers\AlumnosController;
use App\Middleware\BeforeMiddleware;
use App\Middleware\jwt_Validation;

return function($app){
    $app->group('/alumnos', function(RouteCollectorProxy $group){
        $group->get('[/]', AlumnosController::class.':getAll')->add(new jwt_Validation());
        $group->get('/{id}', AlumnosController::class.':getOne');
        $group->post('/alta', AlumnosController::class.':add');
        $group->put('/{id}', AlumnosController::class.':updateOne');
        $group->delete('/{id}', AlumnosController::class.':getAll');
    });

    $app->group('/materias', function(RouteCollectorProxy $group){
        $group->get('[/]', AlumnosController::class.':getAll');
        $group->get('/:id', AlumnosController::class.':getAll');
        $group->post('[/]', AlumnosController::class.':getAll');
        $group->put('/:id', AlumnosController::class.':getAll');
        $group->delete('/:id', AlumnosController::class.':getAll');
    });
};