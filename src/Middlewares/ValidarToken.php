<?php
namespace App\Middleware;

use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use App\Utils\Token;

class ValidarToken{

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = new Response();
        $headers = getallheaders();
        $token = $headers['token'] ?? '';

        if(isset($token) && !empty($token))
        {
            $decode = Token::Decode($token);

            if($decode == null)
            {
                $response->getBody()->write(json_encode(array("Estado" => "Incorrecto", "Token" => "No valido")));
            }
            else
            {
                $response->getBody()->write(json_encode(array("Estado Token" => "Correcto", "Token" => $token)));
                $existingContent = (string) $response->getBody();
                $response = $handler->handle($request);
                $response->getBody()->write($existingContent);
            }
        }
        else
        {
            $response->getBody()->write(json_encode(array("Estado" => "Incorrecto", "Token" => "No existe token")));
        }

        return $response;
    }
}