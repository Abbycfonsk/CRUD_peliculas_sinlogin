@extends('layout')
    @section('contenido')
            <div class='row animated fadeIn slow'>
                <form action="{{route('vista.peliculas')}}" method="GET" class="d-flex justify-content-center">
                    <div class="m-3">
                        <label class="form-label">Buscar por título:</label>
                        <input autofocus type="search" class="form-control" id="filtro"  name="filtro" value="{{$filtro ?? null}}" onkeyup="this.form.submit()">
                    </div>
                    <div class="m-3">
                        <label classr="form-label">Categoría</label>
                        <select class="form-select" name="idcategoria" onchange="this.form.submit()">
                            <option value="">Todas las categorias</option>
                            @foreach ($categorias as $categoria)
                                @if(($idcategoria ?? null) == $categoria->id)
                                    <option selected value='{{$categoria->id}}'>{{$categoria->nombre}}</option>
                                @else
                                    <option value='{{$categoria->id}}'>{{$categoria->nombre}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <hr>
            <div class="row row-cols-4 d-flex justify-content-evenly">
                @if (sizeof($peliculas)==0)
                <div class='alert alert-danger' >
                    <p>No hay datos</p>
                </div>
                @else
                    @foreach ($peliculas as $pelicula)
                        <div class="card m-2 mb-5">
                        
                            <img class="card-img-top" src='{{asset("/img/$pelicula[img]")}}'>
                            <div class="card-body">
                            '
                                <h4 class="card-title">{{$pelicula['titulo']}}</h4>
                                <p class="card-text"></p>
                                <p class="card-text">Dirección: {{$pelicula['direccion']}}</p>
                                <p class="card-text">
                                    <small class="text-muted">Año: {{$pelicula['anio']}} </small>
                                </p>
                                <a href="{{route('vista.pelicula',[$pelicula->id])}}" class="btn btn-outline-primary btn-block">Ver más...</a>
                                <a href="{{route('vista.mantenimiento',[$pelicula->id])}}" class="btn btn-outline-primary btn-block">Mantenimiento</a>
                            </div>
                        </div>
                    @endforeach
                @endif    
            </div>
    @endsection


