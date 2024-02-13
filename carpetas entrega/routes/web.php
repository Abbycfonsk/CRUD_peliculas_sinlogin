<?php

use App\Http\Controllers\PeliculasController;
use App\Http\Controllers\VistasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [VistasController::class, 'inicio'])->name('inicio');
Route::get('/pelicula/alta', [VistasController::class, 'alta'])->name('vista.alta');
Route::get('/peliculas', [VistasController::class, 'peliculas'])->name('vista.peliculas');
Route::get('/pelicula/{id}', [VistasController::class, 'pelicula'])->name('vista.pelicula');
Route::get('/pelicula/mantenimiento/{pelicula}', [VistasController::class, 'mantenimiento'])->name('vista.mantenimiento');
Route::post('/pelicula',[PeliculasController::class, 'alta'])->name('pelicula.alta');
Route::put('/pelicula/mantenimiento/{pelicula}',[PeliculasController::class, 'modificacion'])->name('pelicula.mantenimiento');
Route::delete('/pelicula/mantenimiento/{pelicula}',[PeliculasController::class, 'baja'])->name('pelicula.mantenimiento');

