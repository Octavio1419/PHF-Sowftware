<?php

use App\Http\Controllers\EjemploGraficasController;
use App\Http\Controllers\TablaController;
use App\Http\Controllers\Uno20200424CipController;
use App\Http\Controllers\UnoCipController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\SecuenciaController;
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



// Route::get('/', [EjemploGraficasController::class, 'index']);
Route::get('graficacion', [UnoCipController::class, 'index']);
Route::get('old_graficacion', [Uno20200424CipController::class, 'index'])->name('home');
//Route::get('graficas', [TablaController::class, 'index']);
Route::get('/buscar/{dbtabla}', [TablaController::class, 'buscar']);
//Route::get('/graficas/show/{dato}', [TablaController::class, 'graficar']);


Route::get('graficas', [TablaController::class, 'index'])->name('cliente')->middleware('auth');
Route::get('admin', [SecuenciaController::class, 'index'])->name('admin')->middleware('auth');

//RUTAS PARA LOGIN
Route::get('/salir', [EntradaController::class, 'salir'])->name('salir');
Route::get('/',[EntradaController::class, 'login'])->name('entrada');

Route::post('/validar', [EntradaController::class, 'validar'])->name('validar');

Route::get('/login', [EntradaController::class, 'login'])->name('login');


//PROBANDO RUTAS PARA EL CRUD CON CARD NOTA: DESPUES CORRERIR RUTAS DEFINIDAS DEL CRUD CON RESOURCE

Route::get('editar/{secuencia}', [SecuenciaController::class, 'edit'])->name('secuencias.edit');
Route::put('actualizar/{secuencia}', [SecuenciaController::class, 'update'])->name('secuencias.update');
Route::get('mostrar/{secuencia}', [SecuenciaController::class, 'show'])->name('secuencias.show');

