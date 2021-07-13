<a href="{{ route('recetas.create') }}" class="btn btn-primary mr-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 icono" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
      </svg>
    Crear Receta</a>
{{-- Es lo mismo q lo de abajo solo que aqui ocupo desde el controler obtener el acceso a los datos de usuario por medio de una variable
    <a href="{{ route('perfiles.edit', ['perfil' => $usuario->id]) }}" class="btn btn-success mr-2"> Editar Perfil</a>
--}}
<a href="{{ route('perfiles.edit', ['perfil' => Auth::user()->id]) }}" class="btn btn-success mr-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="icono" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
      </svg>
    Editar Perfil</a>
<a href="{{ route('perfiles.show', ['perfil' => Auth::user()->id]) }}" class="btn btn-info mr-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="icono" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
      </svg>
    Ver Perfil
</a>