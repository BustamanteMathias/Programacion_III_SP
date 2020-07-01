<?php 

use Slim\Routing\RouteCollectorProxy;
use App\Controllers\UserController;
use App\Controllers\MateriaController;
use App\Middleware\BeforeMiddleware;
use App\Middleware\ValidarToken;
use App\Middleware\GenerarToken;
use App\Middleware\UsuarioExistente;

return function($app){
    $app->group('/usuario', function(RouteCollectorProxy $group){
        $group->post('[/]', UserController::class . ':post')->add(UsuarioExistente::class);
    });

    $app->group('/login', function(RouteCollectorProxy $group){
        $group->post('[/]', UserController::class . ':login')->add(GenerarToken::class);
    });
    $app->group('/materias', function(RouteCollectorProxy $group){
        $group->post('[/]', MateriaController::class . ':add')->add(ValidarToken::class);
    });
};