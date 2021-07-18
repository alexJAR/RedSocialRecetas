<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index()
    {

        //Mostrar las mas votadas
        //$votadas = Receta::has('likes', '>', 1)->get();

        /*Esto agrega un nuevo campo a la tabla donde cuenta los likes (esto gracias a la relacion, 
        busca en la tabla likes las veces q se repite el id de la receta por los likes q le dan)*/
        //$votadas = Receta::withCount('likes')->get();

        //Ordenandola en base a al nuevo campo creado por withCount
        $votadas = Receta::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();

        //return $votadas;

        //Obtener las ultimas recetas
        $nuevas = Receta::latest()->take(6)->get();

        //Obtener todas las categorias
        $categorias = CategoriaReceta::all();
        
        //Agrupar recetas por categoria
        $recetas = [];

        foreach ($categorias as $categoria ) {
            $recetas[Str::slug($categoria->nombre)] [] = Receta::where('categoria_id', $categoria->id)->take(3)->get();
        }

        return view('inicio.index', compact('nuevas', 'recetas', 'votadas'));
    }
}
