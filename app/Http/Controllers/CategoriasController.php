<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'index']]);
    }
    public function index(){
        $categorias = CategoriaReceta::all();
        return view('categorias.index', compact('categorias'));
    }
    public function show(CategoriaReceta $categoriaReceta)
    {
        
        $recetas = Receta::where('categoria_id', $categoriaReceta->id)->paginate(3);
        //return "desde show". $categoriaReceta->id;
        return view('categorias.show', compact('recetas', 'categoriaReceta'));
    }
    public function create()
    {
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        //return "desde categorias create";
        return view('categorias.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        //Validacion
        $data = request()->validate([
            'categoria' => 'required|min:6',
        ]);

        CategoriaReceta::create([
            'nombre' => $data['categoria'],
        ]);
        return redirect()->action('RecetaController@create');
    }
}
