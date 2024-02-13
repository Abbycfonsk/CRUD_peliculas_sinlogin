<?php

namespace Tests\Feature;

use App\Models\Pelicula;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CargaVistasPeliculasTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_carga_vista_inicio(){
        $response=$this->get('/');
        $response
            ->assertStatus(200)
            ->assertSee('Películas');
    }
    public function test_carga_vista_lista_peliculas(){
        $response=$this->get('/peliculas');
        $response
            ->assertStatus(200)
            ->assertSee('Lista de películas');
    }
    public function test_carga_vista_alta_pelicula(){
        $response=$this->get('/pelicula/alta');
        $response
            ->assertStatus(200)
            ->assertSee('Alta de película');
    }
    public function test_carga_vista_detalle_pelicula(){
        $pelicula=Pelicula::factory()->create();
        $response=$this->get("/pelicula/$pelicula->id");
        $response
            ->assertStatus(200)
            ->assertSee('Detalle de película');
        $pelicula->delete();
    }
    public function test_carga_vista_mantenimiento_pelicula(){
        $pelicula=Pelicula::factory()->create();
        $response=$this->get("/pelicula/mantenimiento/$pelicula->id");
        $response
            ->assertStatus(200)
            ->assertSee('Modificación y baja de película');
        $pelicula->delete();
    }
   
}
