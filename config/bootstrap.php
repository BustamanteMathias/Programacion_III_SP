<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Slim\Factory\AppFactory;
use Config\Database;
use Psr\Http\Message\ServerRequestInterface;

//INSTANCIAR ILLUMINATE
new Database();

//APLICACION
$app = AppFactory::create();
$app->setBasePath("/Programacion_III_SP/public");
$app->addRoutingMiddleware();

$customErrorHandler = function (
    ServerRequestInterface $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails
) use ($app) {

    $payload = ['ERROR' => $exception->getMessage()];

    $response = $app->getResponseFactory()->createResponse();
    $response->getBody()->write(
        json_encode($payload, JSON_UNESCAPED_UNICODE)
    );

    return $response;
};

//MANEJADOR DE ERRORES
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);

//REGISTRAR RUTAS
(require_once __DIR__ . '/routes.php')($app);

//REGISTRAR MIDDLEWARES
(require_once __DIR__ . '/middlewares.php')($app);

return $app;