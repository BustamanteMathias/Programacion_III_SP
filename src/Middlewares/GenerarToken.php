<?php
namespace App\Middleware;

use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use App\Utils\Token;

class GenerarToken{

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = new Response();
        $email = "asdasdsad";
        $pass = "asdasdasd";

        $token = Token::NewTokenUser($email, $pass);
        
        $response->getBody()->write(json_encode(array("Estado" => "Correcto", "Token" => $token)));
        $existingContent = (string) $response->getBody();
        $response = $handler->handle($request);
        $response->getBody()->write($existingContent);

        return $response;
    }
}