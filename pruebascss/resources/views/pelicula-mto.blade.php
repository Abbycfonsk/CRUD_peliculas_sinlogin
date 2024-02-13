@extends('layout')
@section('contenido')

            <div class='row animated fadeIn slow'>
                <div class='column col-8'>
                    <div class="card m-auto">
                        <form id='formulario' action="{{route('pelicula.mantenimiento',[old('id') ?? $pelicula->id ?? null])}}" method="post"  enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            @if ($pelicula)
                                <div class="card-body">
                                    <h2 class="card-title">
                                        <input name='titulo' type='text' value="{{old('titulo') ?? $pelicula->titulo??null}}">
                                    </h2>
                                    <hr>
                                    <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Categoria</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="idcategoria" aria-label="Categorias">
                                    @foreach ($categorias as $categoria)
                                        @if ((old('idcategoria') ?? $pelicula->idcategoria ?? null) == $categoria->id)
                                            <option selected value='{{$categoria->id}}'>{{$categoria->nombre}}</option>
                                        @else
                                            <option value='{{$categoria->id}}'>{{$categoria->nombre}}</option>
                                        @endif
                                    @endforeach
                                </select>  
                            </div>
                        </div>     
                                    <h5 class="card-subtitle mb-2 text-muted">Dirección:
                                        <input name='direccion' value="{{old('direccion') ?? $pelicula->direccion??null}}">
                                    </h5>
                                    <h5 class="card-subtitle mb-2 text-muted">Año:
                                        <input name='anio' type='number' min='1900' max='2100' value="{{old('anio') ?? $pelicula->anio??null}}">
                                    </h5>
                                    <hr>
                                    <textarea rows='8' cols='90' name='sinopsis'>{{old('sinopsis') ?? $pelicula->sinopsis??null}}</textarea>
                                    <hr>
                                    <input type="file" class="form-control" name="portada" id='portada' accept='image/*' onchange='previsualizar()'>
                                    <hr>
                                    <button type="button" class="btn btn-warning" onclick="enviarFormulario('PUT')" >Modificar película</button>
                                    <button type="button" class="btn btn-danger" onclick="enviarFormulario('DELETE')">Baja película</button>
                                    <a href="/peliculas" class="btn btn-outline-primary btn-block" style='float:right'>Volver a listado</a>
                                </div>
                               
                                @error('titulo')
                               
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                @enderror
                                @error('direccion')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                @enderror
                                @error('anio')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                @enderror 
                                @error('sinopsis')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                @enderror
                                @if (isset($mensajes))
                               
                                    <div class="alert alert-warning">
                                        <p>{{$mensajes ?? null}}</p>
                                    </div>
                                @endif
                                

                                


                        </form>
                        <br>
                    </div>
                </div>
                <div class='column col-4'>
                        @if(isset($pelicula))
                            <img src='{{asset("/img/$pelicula->img")}}' alt="previsualizar" id='previsualizar'>
                        @else
                            <img src='{{asset("/img/sinportada.jpg")}}' alt="previsualizar" id='previsualizar'>
                        @endif
                    @else
                   
                        <h4>Película no existe</h4>
                    
                    @endif
                  
                </div>
            </div>

            <script>
                function enviarFormulario(metodo){
                 
                    document.querySelector('[name=_method]').value=metodo;
                    document.querySelector('#formulario').submit();
                }
            </script>
@endsection