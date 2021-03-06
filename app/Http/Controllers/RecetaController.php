<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    /* Con esto no se puede acceder si no estas autenticado */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Mostrar la receta del usuario actual
        //$recetas = auth()->user()->recetas->paginate(5);
        $usuario = auth()->user();
        //Recetas con paginacion
        $recetas = Receta::where('user_id', $usuario->id)->paginate(5);

        //Todas las recetas
        //$recetas = Receta::all();
        return view('recetas.index')
            ->with('recetas', $recetas)//->with('usuario', $usuario);
            ->with('usuario', $usuario);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //DB::table('categoria_receta')->get()->pluck('nombre, id')->dd();
        
        //Obtener las categorias (sin modelo)
        //$categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');


        //Obtener las categorias con modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);

        return view('recetas.create')->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       // dd ( $request['imagen']->store('upload-recetas', 'public') );

       //validacion
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image',
            'categoria' => 'required',
            
        ]);

        //obtener ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        //Resize de la imagen
        $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();


        // insertar en la BD sin modelos
        //  DB::table('recetas')->insert([
        //    'titulo' => $data['titulo'],
        //    'ingredientes' => $data['ingredientes'],
        //    'preparacion' => $data['preparacion'],
        //    'imagen' => $ruta_imagen,
        //    'user_id' => Auth::user()->id,
        //    'categoria_id' => $data['categoria'],
        //  ]);

        //almacenar en la BD con modelo
            //auth toma el usuario actual autenticado
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria'],

        ]);
        
        //Redirecciono
        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //Algunos metodos para obtener una receta
        //$receta = Receta::find($receta);

        //Obtener si el usuario actual le gusta la receta y esta autenticado
        $like = (auth()->user()) ? auth()->user()->meGusta->contains($receta->id) : false;

        //Pasa la cantidad de likes a la vista
        $likes = $receta->likes->count();

        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //Policy para que no vean la vista
        $this->authorize('view', $receta);
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.edit', compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //
      //  return $receta;

      //revisar el policy

        $this->authorize('update', $receta);

        $data = request()->validate([
            'titulo' => 'required|min:6',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'categoria' => 'required', 
        ]);

        //asignar valores:
        $receta->titulo = $data['titulo'];
        $receta->preparacion = $data['preparacion'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->categoria_id = $data['categoria'];

        //Si el usuario cambia la imagen
        if (request('imagen')) {
            //obtener ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

            //Resize de la imagen
            $img = Image::make( public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();

            //Asignar al objeto
            $receta->imagen = $ruta_imagen;
        }

        $receta->save();

        return redirect()->action('RecetaController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        // ejecutar el policy
        $this->authorize('delete', $receta);

        //eliminamos la receta
        $receta->delete();

        return redirect()->action('RecetaController@index');
    }

    public function prueba(){
        return "calis";
    }

    public function search(Request $request)
    {
        $busqueda = $request['buscar']; //el campo es buscar porq en el input el name es buscar
        /*Otra forma de hacerlo
        $busqueda = $request->get('buscar');*/

        //Esta consulta lo que haces es que busca en la tabla recetas en el campo titulo algo q tenga las palabras de la busqueda
        // los simbolos % es para q al buscar puedas buscar cualquier coincidencia que tenga lo de nuestra busqueda en el titulo
        //ejmplo: buscamos tacos, con los % nos puede trarer cualquier receta q en el titulo tenga taco como ricos tacos o receta de tacos dorados

        $recetas = Receta::where('titulo', 'like', '%' . $busqueda . '%')->paginate(3);
        $recetas->appends(['buscar' => $busqueda]);

        return view('busquedas.show', compact('recetas', 'busqueda'));
    }
}
