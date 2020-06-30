<?php
// Aca incluyo mis middlewares
use Slim\App;
use App\Middleware\JsonConvertResponseMiddleware;

return function(App $app){
    // Esto es para decirle que vamos a trabajar con middlewares
    $app->addBodyParsingMiddleware();

    // Agregamos los middlewares
    $app->add(new JsonConvertResponseMiddleware());
};