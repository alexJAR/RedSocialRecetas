<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaReceta extends Model
{
    //Campos que se agregaran
    protected $fillable = [
        'nombre',
    ];
}
