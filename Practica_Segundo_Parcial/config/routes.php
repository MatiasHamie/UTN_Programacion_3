<?php
// Aca incluyo mis controladores
use Slim\Routing\RouteCollectorProxy;
use App\Controllers\UsuariosController;
use App\Controllers\MascotasController;
use App\Controllers\TurnosController;
use App\Middleware\TokenValidateMiddleware;
use App\Middleware\PasarTodoAMayuscula;

return function($app){

    $app->post('/registro', UsuariosController::class.':registro');
    $app->post('/login', UsuariosController::class.':login');

    $app->group('/mascota', function(RouteCollectorProxy $group){
        $group->get('/{id_mascota}', MascotasController::class.':verHistorialMascota');
        $group->post('[/]', MascotasController::class.':registrarMascota');
    })->add(new TokenValidateMiddleware());

    $app->group('/turnos', function(RouteCollectorProxy $group){
        $group->post('/mascota', TurnosController::class.':registrarTurno');
        $group->get('/{id_usuario}', TurnosController::class.':mostrarTurnos')->add(new PasarTodoAMayuscula);
    })->add(new TokenValidateMiddleware());
};