@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha512-494Ejp/5WyoRNfh+nPLhSCQPHhcsbA5PoIGv2/FuEo+QLfW+L7JQGPdh8Qy2ZOmkF27pyYlALrxteMiKau1tyw==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2"> Volver</a>
@endsection

@section('content')
    <h2 class="text-center mb-5">Crear nueva Receta</h2>
    
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('recetas.store') }}" novalidate>
                @csrf
                <div class="form-group">
                    <label for="titulo"> Titulo Receta</label>

                    <input type="text"
                            name="titulo"
                            class="form-control @error('titulo') is-invalid @enderror "
                            id="titulo"
                            placeholder="Titulo Receta"
                            value="{{ old('titulo')}}" 
                    /> 
                    <!--Lo de class marca la casilla si hay un error en titulo y old mantiene en la caja el valor enviado-->

                    <!-- Valida si hay un error en titulo -->
                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="categoria">Categoria</label>

                    <select 
                        name="categoria" 
                        class="form-control @error('categoria') is-invalid @enderror" 
                        id="categoria"
                    >
                        <option value="">-- Seleccione--</option>
                        @foreach ($categorias as $id => $categoria )
                        <option 
                            value="{{ $id }}" 
                            {{old ('categoria') == $id ? 'selected' : ''}}
                            >
                            {{ $categoria }}
                        </option>
                        @endforeach
                    </select>

                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="preparacion"> Preparacion</label>

                    <input id="preparacion" 
                        type="hidden" 
                        name="preparacion"
                        value="{{ old('preparacion') }}">
                    <trix-editor 
                        class="form-control @error('preparacion') is-invalid @enderror" 
                        input="preparacion"
                    ></trix-editor>

                    @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                

                <div class="form-group">
                    <label for="ingredientes"> Ingredientes</label>

                    <input id="ingredientes" 
                        type="hidden" 
                        name="ingredientes"
                        value="{{ old('ingredientes') }}">
                    <trix-editor 
                        class="form-control @error('ingredientes') is-invalid @enderror" 
                        input="ingredientes"
                    ></trix-editor>
                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="imagen"> Agregar Imagen</label>
                    
                    <input 
                        type="file" 
                        id="imagen"
                        class="form-control @error('imagen') is-invalid @enderror"
                        name="imagen"
                    >
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Agregar Receta">
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha512-wEfICgx3CX6pCmTy6go+PmYVKDdi4KHhKKz5Xx/boKOZOtG7+rrm2fP7RUR2o4m/EbPdwbKWnP05dvj4uzoclA==" crossorigin="anonymous"></script>
@endsection