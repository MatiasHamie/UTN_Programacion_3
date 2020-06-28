<?php
// Aca incluyo mis middlewares
use Slim\App;
// use App\Middleware\BeforeMiddleware;
use App\Middleware\AfterMiddleware;
// use App\Middleware\jwt_Validation;

return function(App $app){
    // Esto es para decirle que vamos a trabajar con middlewares
    $app->addBodyParsingMiddleware();

    // Agregamos los middlewares
    // o $app->add(BeforeMiddleware::class);
    // $app->add(new BeforeMiddleware());
    $app->add(new AfterMiddleware());
    // $app->add(new jwt_Validation());
};