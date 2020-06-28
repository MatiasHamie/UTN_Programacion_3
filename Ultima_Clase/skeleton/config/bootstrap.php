<?php
// Aca solamente esta la configuracion de las rutas
require_once __DIR__ . '/../vendor/autoload.php';
use Slim\Factory\AppFactory;
use Config\Database;
use Psr\Http\Message\ServerRequestInterface;

// Instanciamos illuminate
new Database();

$app = AppFactory::create();
// Ponemos public porque ahi esta el index.php
$app->setBasePath('/UTN_Programacion_3/Ultima_Clase/skeleton/public');
$app->addRoutingMiddleware();

$customErrorHandler = function (
    ServerRequestInterface $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails
) use ($app) {
    // $logger->error($exception->getMessage());

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
// Registrar Rutas
// (require __DIR__ . './routes.php') es una funcion, y 
// los ($app) es lo q le pasamos a esa ruta directamente
// Es como una autoinvocacion
(require __DIR__ . '/routes.php')($app);
(require __DIR__ . '/middlewares.php')($app);
return $app;