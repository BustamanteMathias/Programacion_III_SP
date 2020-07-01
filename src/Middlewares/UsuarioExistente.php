<?php
namespace App\Middleware;

use App\Models\User;
use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class UsuarioExistente {
    public function __invoke(Request $request, RequestHandler $handler): Response
        {
            $response = new Response();

            $body = $request->getParsedBody();
            $user = new User();
    
            $existe = $user->where('legajo', $body['legajo'])->where('email',  $body['email'])->exists();

            if ($existe) {
    
                $response->getBody()->write('User repetido');
    
            } else {
                $existingContent = (string) $response->getBody();
                $response = $handler->handle($request);
                $response->getBody()->write($existingContent);
            }
    
            return $response;
        }
}