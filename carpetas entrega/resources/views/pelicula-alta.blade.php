@extends ('layout')
@section('contenido')
            <div class='row animated fadeIn slow'>
                <div class='column col-8'>
                    <form id='formulario' action="{{route('pelicula.alta')}}" method='post' enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Título</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="titulo" value = "{{old('titulo')??$pelicula->titulo??null}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Categoria</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="idcategoria" aria-label="Categorias">
                                            <option selected value=''>Seleccione una categoría</option>
                                    @foreach ($categorias as $categoria)
                                        @if ((old('idcategoria') ?? $pelicula->idcategoria ?? 'Seleccione una categoría') == $categoria->id)
                                            <option selected value='{{$categoria->id}}'>{{$categoria->nombre}}</option>
                                        @else
                                            <option value='{{$categoria->id}}'>{{$categoria->nombre}}</option>
                                        @endif
                                    @endforeach
                                </select>  
                            </div>
                        </div>     
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Dirección</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="direccion" value = "{{old('direccion')??$pelicula->direccion??null}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Año</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" name="anio" value = "{{old('anio')??$pelicula->anio??null}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Portada</label>
                            <div class="col-sm-10">
                            <input type="file" class="form-control" name="portada" id='portada' value = "{{old('img')??$pelicula->img??null}}" accept='image/*' onchange='previsualizar()'>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Sinopsis</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" name="sinopsis" rows="5">{{old('sinopsis')??$pelicula->sinopsis??null}}</textarea>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Alta película</button>
                    </form>
                    <h4>
                        @if($errors->any())
                        <div>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @else
                            @if(isset($mensaje))
                            <div class="alert alert-warning">
                                <p>{{$mensaje??null}}</p>
                            </div>
                            @endif
                        @endif    
                    </h4>
                </div>
                <div class='column col-4'>
                @if (isset($pelicula)) 
                    <img src='{{asset("/img/$pelicula->img")}}' alt="previsualizar" id='previsualizar'>
                @else
                    <img src='{{asset("/img/sinportada.jpg")}}' alt="previsualizar" id='previsualizar'>
                @endif
                </div>
            </div>
@endsection        
