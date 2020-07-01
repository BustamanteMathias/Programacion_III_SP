<?php
namespace App\Models;

class Materia extends \Illuminate\Database\Eloquent\Model
{
    //SETEA EN FALSE LA NECESIDAD DE LAS DOS COLUMNAS PARA EL ADD
    protected $table = "materias";
    public $timestamps = false;
}