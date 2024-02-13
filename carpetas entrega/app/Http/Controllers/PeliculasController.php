<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Pelicula;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PeliculasController extends Controller
{
    public function alta (Request $request){
        $datos=request()->all();
        $imagen=$request->file('portada');
        
        $rules=array(
            'titulo'=>'required|unique:peliculas,titulo',
            'direccion'=>'required',
            'anio'=>'required|numeric|min:1900|max:2100',
            'sinopsis'=>'required',
            'portada'=>'image|mimes:jpg,jpeg,png|max:300',
            'idcategoria'=>'required'
        );
      
        $validator=Validator::make($datos,$rules,[
            'anio.required'=>'Año es obligatorio',
            'idcategoria'=>'Categoría es obligatoria'
        ]);
        if ($validator->fails()){
            return redirect()->route('vista.alta')->withErrors($validator)->withInput();
           
        }
        if($imagen){
          $nombreArchivo=$imagen->getClientOriginalName();
          Storage::putFileAs("",$imagen,$nombreArchivo);
          $datos['portada']=$nombreArchivo;
        }else{
            $datos['portada']='sinportada.jpg';
        }
       
        $datos['pelicula']=Pelicula::alta($datos);
        $datos['categorias']=Categoria::consulta();
        $datos['mensaje']='Alta de película efectuada';
        return view('pelicula-alta')->with($datos);
    }
    public function consultaPeliculas(){
        $datos['peliculas']=Pelicula::consulta();
        $datos['pagina']='Lista de películas';
        return view('peliculas')->with($datos);
    }
   
    public function modificacion(Request $request, Pelicula $pelicula){
        $datos=request()->all();
        $archivo=$request->file('portada');
     
            $request->validate([
                'titulo'=>['required', Rule::unique('peliculas')->ignore($pelicula->id,'id')],
                'direccion'=>['required'],
                'anio'=>['required', 'numeric', 'max:2100', 'min:1900'],
                'sinopsis'=>['required'],
                'portada'=>['image', 'mimes:jpg,jpeg,png', 'max:300'],
                'idcategoria'=>['required']
            ]);
            if($archivo){
                $nombreArchivo=$archivo->getClientOriginalName();
                Storage::putFileAs("",$archivo,$nombreArchivo);
                $datos['portada']=$nombreArchivo;
                $pelicula['img']=$datos['portada'];
                
            }else{
                  $datos['portada']='sinportada.jpg';
            }
            $pelicula['idcategoria']=$datos['idcategoria'];
           //dd($pelicula['idcategoria']);
            $pelicula->update($datos); 
            //dd($pelicula);
        try{  
            if (!$pelicula->getChanges()){
                throw new Exception('No se han modificado datos de la película');
            }
            if ($pelicula->getChanges()|| $pelicula['img']=$nombreArchivo){
                throw new Exception('Modificación efectuada');
            }
       
        }catch (Exception $e){
            $datos['mensajes']=$e->getMessage();
        }
            $datos['categorias']=Categoria::consulta();
            $datos['pelicula']=$pelicula;
            $datos['pagina']='Modificación y baja de película';
            return view('pelicula-mto')->with ($datos);
       
    }
    public function baja(Pelicula $pelicula){
       
        $deleted=$pelicula->delete();
        if($deleted && $pelicula->img != 'sinportada.jpg'){
            unlink(public_path("img/$pelicula->img"));
        }
        return redirect()->route("vista.peliculas");
    }
}
