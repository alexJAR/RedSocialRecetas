<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{

    //Campos que se agregaran
    protected $fillable = [
        'titulo', 'preparacion', 'ingredientes', 'imagen','categoria_id',
    ];
    // Obtiene la categoria de la receta via llave foranea (FK)
    public function categoria()
    {
        return $this->belongsTo(CategoriaReceta::class);
    }

    //obtiene la informacion del usuario via FK
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id'); // FK de esta tabla
    }

}
