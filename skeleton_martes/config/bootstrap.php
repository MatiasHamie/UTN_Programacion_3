<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Instancio la conexion a la base de datos Illuminate
use Config\Database;
new Database();

// Instancio el servidor SLIM
use Slim\Factory\AppFactory;
$app = AppFactory::create();
$app->setBasePath('/UTN_Programacion_3/skeleton_martes/public');

// - Manejo de errores de middleware -
use Psr\Http\Message\ServerRequestInterface;
$app->addRoutingMiddleware();

// Cada vez que agrego una linea aca abajo "registro algo"
// No olvidar del composer dumpautoload -o
// Llamo al intermedio entre controladores y rutas
(require_once __DIR__ . './routes.php')($app);
// Llamo al intermedio entre esto y middlewares
(require_once __DIR__ . './middlewares.php')($app);

// Continua manejo del error
$customErrorHandler = function (
    ServerRequestInterface $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails
) use ($app) {
    $payload = ['error' => $exception->getMessage()];

    $response = $app->getResponseFactory()->createResponse();
    $response->getBody()->write(
        json_encode($payload, JSON_UNESCAPED_UNICODE)
    );

    return $response;
};

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);
// ------------------------------------


return $app;