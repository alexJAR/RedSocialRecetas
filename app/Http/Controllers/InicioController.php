<?php

namespace App\Http\Controllers;

use App\Receta;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index()
    {
        //Obtener las ultimas recetas
        $nuevas = Receta::latest()->take(6)->get();

        return view('inicio.index', compact('nuevas'));
    }
}
