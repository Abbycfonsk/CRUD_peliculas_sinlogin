@extends('layout')
@section('contenido')
            <div class='row animated fadeIn slow'>
                <div class='column col-8'>
                    <div class="card m-auto">
                    @if ($pelicula!=null)
                        <div class="card-body">
                       
                            <h2 class="card-title">{{$pelicula->titulo??null}}</h2>
                            <hr>
                            <h5 class="card-subtitle mb-2 text-muted">Categoría: {{$categoria ?? null}}</h5>
                            <h5 class="card-subtitle mb-2 text-muted">Dirección: {{$pelicula->direccion ?? null}}</h5>
                            <h5 class="card-subtitle mb-2 text-muted">Año: {{$pelicula->anio ?? null}}</h5>
                            <hr>
                            <p class="card-text">{{$pelicula->sinopsis ?? null}}</p>
                        </div> 
                       
                    @else
                        <h4>Pelicula no existe</h4>
                    @endif    
                    </div>
                    <br>
                    @if ($pelicula)
                        <a href="{{route('vista.mantenimiento',[$pelicula->id])}}" class="btn btn-outline-primary btn-block">Mantenimiento</a>
                        <a href="{{route('vista.peliculas')}}" class="btn btn-outline-primary btn-block">Volver a listado</a>
                    @else
                        <a href="" class="btn btn-outline-primary btn-block">Mantenimiento</a>
                        <a href="{{route('vista.peliculas')}}" class="btn btn-outline-primary btn-block">Volver a listado</a>
                    @endif
                </div>
                <div class='column col-4'>
                    @if ($pelicula)
                    <img src='{{asset("/img/$pelicula->img")}}'>
                    @else
                    <img src='{{asset("/img/sinportada.jpg")}}'>
                    @endif
                </div>
            </div>
@endsection