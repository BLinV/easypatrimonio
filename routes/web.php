<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BajaController;
use App\Http\Controllers\BienvenidoController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\PatrimonioController;
use App\Http\Controllers\PersonalController;

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [BienvenidoController::class, 'index'])->name('home');

/* Módulos */   //php artisan route:list
Route::resource('Personal', PersonalController::class)->names('personal');
Route::resource('Patrimonio', PatrimonioController::class)->names('patrimonio');
Route::resource('Ingresos', IngresoController::class)->names('ingresos');
Route::resource('Bajas', BajaController::class)->names('bajas');
Route::resource('Movimientos', MovimientoController::class)->names('movimientos');