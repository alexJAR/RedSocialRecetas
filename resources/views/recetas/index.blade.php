@extends('layouts.app')

@section('botones')
    <a href="{{ route('recetas.create') }}" class="btn btn-primary mr-2"> Crear Receta</a>
    {{-- Es lo mismo q lo de abajo solo que aqui ocupo desde el controler obtener el acceso a los datos de usuario por medio de una variable
        <a href="{{ route('perfiles.edit', ['perfil' => $usuario->id]) }}" class="btn btn-success mr-2"> Editar Perfil</a>
    --}}
    <a href="{{ route('perfiles.edit', ['perfil' => Auth::user()->id]) }}" class="btn btn-success mr-2"> Editar Perfil</a>
    <a href="{{ route('perfiles.show', ['perfil' => Auth::user()->id]) }}" class="btn btn-info mr-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="icono" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
        Ver Perfil
    </a>
@endsection

@section('content')
    <h2 class="text-center mb-5">Administrar tus recetas</h2>
    <div class="col-md-10 mx-auto bg-white p-2">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Titulo</th>
                    <th scole="col">Categoría</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($recetas as $receta)
                <tr>
                    <td> {{$receta->titulo}}</td>
                    <td>{{$receta->categoria->nombre}}</td>
                    <td>

                        <eliminar-receta
                        receta-id={{$receta->id}}
                        >
                            
                        </eliminar-receta>
                        
                        <a href="{{ route('recetas.edit', ['receta' => $receta->id])}}" class="btn btn-dark d-block mb-2">Editar</a>
                        <a href="{{ action('RecetaController@show', ['receta' => $receta->id]) }}" class="btn btn-success d-block">Ver</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

@endsection