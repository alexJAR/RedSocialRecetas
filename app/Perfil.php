<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    // relacion 1:1 Perfil con usuario
    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
