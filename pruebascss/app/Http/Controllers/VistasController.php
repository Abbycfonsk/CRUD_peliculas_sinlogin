<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Pelicula;
use Illuminate\Http\Request;

class VistasController extends Controller
{
    public function inicio(){
    $datos['pagina']='Películas';
    return view('inicio')->with($datos);
    }
    public function alta(){
    $datos['categorias']=Categoria::consulta();
    $datos['pagina']='Alta de película';
    return view('pelicula-alta')->with($datos);
    }
    public function peliculas(){
    $datos=request()->all();
    $datos['peliculas']=Pelicula::consulta($datos['filtro'] ?? null, $datos['idcategoria'] ?? null);
    $datos['categorias']=Categoria::consulta();
    $datos['pagina']='Lista de películas';
    return view('peliculas')->with($datos);
    }
    public function pelicula($id){
    $datos['pelicula']=Pelicula::find($id);
    $datos['categoria'] = Categoria::find($datos['pelicula']->idcategoria)->nombre;
    $datos['pagina']='Detalle de película';
    $datos['pelicula']=Pelicula::find($id);
    return view('pelicula')->with($datos);
    }
    public function mantenimiento(Pelicula $pelicula){
        $datos['categorias']=Categoria::consulta();
        $datos['pagina']='Modificación y baja de película';
        $datos['pelicula']=$pelicula;
        return view('pelicula-mto')->with($datos);
    }

}
