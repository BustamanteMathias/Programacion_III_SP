<?php 

use Slim\Routing\RouteCollectorProxy;
use App\Controllers\UserController;
use App\Middleware\BeforeMiddleware;
use App\Middleware\ValidarToken;
use App\Middleware\GenerarToken;


return function($app){
    $app->group('/users', function(RouteCollectorProxy $group){
        $group->post('[/]', UserController::class . ':getAll')->add(ValidarToken::class);
        $group->post('/add[/]', UserController::class . ':add')->add(GenerarToken::class);
    });
};