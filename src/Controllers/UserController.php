<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;

class UserController
{
    public function login(Request $request, Response $response, $args)
    {
        return $response;
    }

    public function post(Request $request, Response $response, $args)
    {
        $body = $request->getParsedBody();

        $user = new User();
        $user->email    = $body["email"];
        $user->nombre   = $body["nombre"];
        $user->clave    = $body["clave"];
        $user->tipo_id  = $body["tipo"];
        $user->legajo   = $body["legajo"];

        if(!empty($body["email"]) && !empty($body["nombre"]) && !empty($body["clave"]))
        {
            if($body["tipo"] > 0 && $body["tipo"] <= 3)
            {
                if($body["legajo"] > 1000 && $body["legajo"] < 2000)
                {
                    $rta = json_encode(array("Correcto" => $user->save(), "Data" => $user));
                    $response->getBody()->write($rta);
                }
                else
                {
                    $rta = json_encode(array("Error" => "Legajo incorrecto"));
                    $response->getBody()->write($rta);
                }
            }
            else
            {
                $rta = json_encode(array("Error" => "Tipo incorrecto"));
                $response->getBody()->write($rta);
            }
        }
        else
        {
            $rta = json_encode(array("Error" => "Campos vacios"));
            $response->getBody()->write($rta);
        }
        
        return $response;
    }
}