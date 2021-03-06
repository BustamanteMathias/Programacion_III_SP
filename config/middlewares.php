<?php
use Slim\App;
use App\Middleware\BeforeMiddleware;
use App\Middleware\AfterMiddleware;


return function (App $app) {
    $app->addBodyParsingMiddleware();

    $app->add(new AfterMiddleware());
    
};