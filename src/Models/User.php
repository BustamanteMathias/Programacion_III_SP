<?php
namespace App\Models;

class User extends \Illuminate\Database\Eloquent\Model
{
    //SETEA EN FALSE LA NECESIDAD DE LAS DOS COLUMNAS PARA EL ADD
    protected $table = "users";
    public $timestamps = false;
}