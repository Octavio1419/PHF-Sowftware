<?php

use App\Http\Controllers\EjemploGraficasController;
use App\Http\Controllers\TablaController;
use App\Http\Controllers\Uno20200424CipController;
use App\Http\Controllers\UnoCipController;
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

Route::get('/', function () {
    return redirect('/graficas');
});

// Route::get('/', [EjemploGraficasController::class, 'index']);
Route::get('graficacion', [UnoCipController::class, 'index']);
Route::get('old_graficacion', [Uno20200424CipController::class, 'index'])->name('home');
//Route::get('graficas', [TablaController::class, 'index']);
Route::get('/buscar/{dbtabla}', [TablaController::class, 'buscar']);
//Route::get('/graficas/show/{dato}', [TablaController::class, 'graficar']);
Route::resource('graficas', TablaController::class);
