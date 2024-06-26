<?php

use App\Http\Controllers\BajaController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\PatrimonioController;
use App\Http\Controllers\PersonalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//php artisan route:list

/*
> api.php
manejo de las urls que enviara la informacion en tipo json
*/

Route::get('/informacion_origenserviciocategoria', [PatrimonioController::class, 'informacionOrSerCat'])->name('informacion_origenserviciocategoria');
Route::get('/informacion_patrimoniotipobusqueda', [BusquedaController::class, 'autocompletarTipo'])->name('informacion_patrimoniotipobusqueda');
Route::get('/informacion_patrimoniomarcabusqueda', [BusquedaController::class, 'autocompletarMarca'])->name('informacion_patrimoniomarcabusqueda');


Route::get('/informacion_personal', [PersonalController::class,'informacionPersonal'])->name('informacion_personal');
Route::get('/informacion_personalcondicion', [PersonalController::class,'informacionCondicion'])->name('informacion_personalcondicion');

Route::get('/informacion_patrimonioreporte', [PatrimonioController::class,'informacionPatrimonioReporte'])->name('informacion_patrimonioreporte');
Route::get('/informacion_ingresoreporte', [IngresoController::class, 'informacionIngresoReporte'])->name('informacion_ingresoreporte');
Route::get('/informacion_bajareporte', [BajaController::class, 'informacionBajaReporte'])->name('informacion_bajareporte');
Route::get('/informacion_movimientoreporte', [PatrimonioController::class, 'informacionMovimientoReporte'])->name('informacion_movimientoreporte');


//Personal
Route::post('/registrar_personal',[PersonalController::class,'registrarPersonal'])->name('registrarPersonal');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
