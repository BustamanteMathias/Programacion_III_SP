<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Materia;
use App\Utils\Token;

class MateriaController 
{
    public function add(Request $request, Response $response, $args)
    {
        $body = $request->getParsedBody();
        $headers = getallheaders();
        $token = $headers['token'] ?? '';
        $tokenDecode = Token::Decode($token);

        echo(json_encode($tokenDecode));
        if($tokenDecode->tipo['tipo_id'] == 3) //ADMIN
        {
            $materia = new Materia();
            $materia->materia       = $body["materia"];
            $materia->cuatrimestre  = $body["cuatrimestre"];
            $materia->vacantes      = $body["vacantes"];
            $materia->profesor      = $body["profesor"];

            $rta = json_encode(array("Estado" => $materia->save(), "Data" => $materia));
            $response->getBody()->write($rta);
        }
        else
        {
            $rta = json_encode(array("Error" => "No es ADMIN"));
            $response->getBody()->write($rta);
        }

        return $response;
    }
}