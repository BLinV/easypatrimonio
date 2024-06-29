<?php

use App\Http\Controllers\BajaController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\PatrimonioController;
use App\Http\Controllers\PersonalController;
use Illuminate\Support\Facades\Route;

/*php artisan route:list            manejo de las urls que enviara la informacion en tipo json*/
//Display
Route::get('/informacion_origenserviciocategoria', [BusquedaController::class, 'informacionOrSerCat'])->name('informacion_origenserviciocategoria');
Route::get('/informacion_tipoBuscar', [BusquedaController::class, 'autocompletarTipo'])->name('informacion_tipoBuscar');
Route::get('/informacion_marcaBuscar', [BusquedaController::class, 'autocompletarMarca'])->name('informacion_marcaBuscar');


//Reportes
Route::get('/informacion_patrimonioreporte', [PatrimonioController::class,'informacionPatrimonioReporte'])->name('informacion_patrimonioreporte');
Route::get('/informacion_ingresoreporte', [IngresoController::class, 'informacionIngresoReporte'])->name('informacion_ingresoreporte');
Route::get('/informacion_bajareporte', [BajaController::class, 'informacionBajaReporte'])->name('informacion_bajareporte');
Route::get('/informacion_movimientoreporte', [PatrimonioController::class, 'informacionMovimientoReporte'])->name('informacion_movimientoreporte');


//Registros
Route::post('/registrar_patrimonio',[PatrimonioController::class,'registrarPatrimonio'])->name('registrar_patrimonio');

Route::post('/registrar_ingreso', [PatrimonioController::class, 'registrarIngreso'])->name('registrar_ingreso');
Route::get('/verificar_patrimonio', [PatrimonioController::class, 'verificarPatrimonio'])->name('verificar_patrimonio');

//Buscar Informacion
Route::get('/buscar_personal/{id}',[PersonalController::class,'verPersonal'])->name('verPersonal');
Route::get('/detalle_patrimonio/{id}', [PatrimonioController::class, 'obtenerDetallePatrimonio']);
Route::get('/informacion_movimientopatrimonio/{id}', [MovimientoController::class, 'informacionMovimientoReporte']);

// Personal
Route::get('/informacion_personal', [PersonalController::class,'informacionPersonal'])->name('informacion_personal');
Route::post('/registrar_personal',[PersonalController::class,'registrarPersonal'])->name('registrar_personal');
Route::get('/buscar_personal/{id}',[PersonalController::class,'verPersonal'])->name('verPersonal');
Route::put('/actualizar_personal/{id}',[PersonalController::class,'actualizarPersonal'])->name('actualizarPersonal');
Route::delete('eliminar_personal/{id}',[PersonalController::class,'eliminarPersonal'])->name('eliminarPersonal');



/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/