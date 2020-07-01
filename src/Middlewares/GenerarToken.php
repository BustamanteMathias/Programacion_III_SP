<?php
namespace App\Middleware;

use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use App\Utils\Token;
use App\Models\User;

class GenerarToken{

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = new Response();
        $body = $request->getParsedBody();
        $user = new User();
    
        $existe = $user->where('clave', $body['clave'])->where('email', $body['email'])->exists();
        if ($existe)
        {
            $tipo   = $user->where('clave', $body['clave'])->where('email', $body['email'])->get('tipo_id');
            $token = Token::NewTokenUser($body['email'], $body['clave'], $tipo);
            
            $response->getBody()->write(json_encode(array("Estado" => "Correcto", "Token" => $token)));
            $existingContent = (string) $response->getBody();
            $response = $handler->handle($request);
            $response->getBody()->write($existingContent);
        } 
        else 
        {
            $response->getBody()->write('User Inexistente');
        }
        return $response;
    }
}