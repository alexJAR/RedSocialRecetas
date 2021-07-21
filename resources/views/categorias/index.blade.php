@extends('layouts.app')

@section('content')
    <h2 class="text-center mb-5">Todas las Categorias</h2>
    <div class="col-md-10 mx-auto bg-white p-2">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Categoría</th>
                    <th scole="col"></th>
                </tr>
            </thead>

            <tbody>
                @foreach($categorias as $categoria)
                <tr>
                    <td> {{$categoria->nombre}}</td>
                    <td>
                        <a href="{{ action('CategoriasController@show', ['categoriaReceta' => $categoria->id]) }}" class="btn btn-success d-block">Ver</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>


@endsection