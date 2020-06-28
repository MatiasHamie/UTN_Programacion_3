<?php
use Slim\App;
use App\Middleware\BeforeMiddleware;
use App\Middleware\AfterMiddleware;

return function(App $app){
    // configuracion del middleware 
    $app->addBodyParsingMiddleware();
    // $app->add(new BeforeMiddleware());
    $app->add(new AfterMiddleware());
    // $app->add(BeforeMiddleware::class);
};