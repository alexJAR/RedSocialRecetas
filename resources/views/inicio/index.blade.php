@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" 
    integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection


@section('content')
    
    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Ultimas recetas</h2>
        
        <div class="owl-carousel owl-theme">
            @foreach ($nuevas as $nueva)
                <div class="card">
                    <img class="card-img-top" src="/storage/{{$nueva->imagen}}" alt="Imagen receta">
    
                    <div class="card-body">
                        <h3>{{Str::title($nueva->titulo)}}</h3>

                        <p> {{ Str::words(strip_tags($nueva->preparacion), 10, '...') }} </p>

                        <a href="{{ route('recetas.show', ['receta' => $nueva->id]) }}" class="btn btn-primary d-block font-weight-bold text-uppercase">
                            ver receta
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection