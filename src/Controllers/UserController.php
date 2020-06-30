<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;

class UserController
{
    public function getAll(Request $request, Response $response, $args)
    {
        $rta = json_encode(User::all());

        $response->getBody()->write($rta);
        return $response;
    }

    public function add(Request $request, Response $response, $args)
    {
        //TOMO DATOS DEL BODY
        $user = new User;
        $user->email = "test1@test.com";
        $user->clave = "1234";
        $user->tipo = "test";
        $user->foto = "miRuta/foto.png";

        $rta = json_encode(array("Estado" => $user->save()));

        $response->getBody()->write($rta);
        return $response;
    }
}