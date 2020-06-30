<?php
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class BeforeMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);
        $existingContent = (string) $response->getBody();

        $response = new Response();

        /**
         * VALIDAR JWT
         * getHeader('mi_token)
         */
        if (!true) {
            $response->getBody()->write($existingContent);    
        } else {
            $response->getBody()->write('NO autorizado ');
        }
        
        // $response->getBody()->write('BEFORE ' . $existingContent);

        return $response;
    }
}
