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
Route::get('/informacion_categoriaBuscar', [BusquedaController::class, 'autocompletarCategoria'])->name('informacion_categoriaBuscar');
Route::get('/informacion_personalBuscar/{id}', [BusquedaController::class, 'informacionPersonal'])->name('informacion_personalBuscar');

//Patrimonio
Route::get('/informacion_patrimonioreporte', [PatrimonioController::class,'informacionPatrimonioReporte'])->name('informacion_patrimonioreporte');
Route::get('/informacion_detallepatrimonioreporte/{id}', [PatrimonioController::class,'informacionDetallePatrimonio'])->name('informacion_detallepatrimonioreporte');
Route::post('/registrar_patrimonio',[PatrimonioController::class,'registrarPatrimonio'])->name('registrar_patrimonio');
Route::put('/operatividad_patrimonio/{id}',[PatrimonioController::class,'estadoOperativoPatrimonio'])->name('operatividad_patrimonio');
//Movimientos
Route::get('/informacion_movimientopatrimonio/{id}', [MovimientoController::class, 'informacionMovimientoPatrimonio'])->name('informacion_movimientopatrimonio');
Route::post('/registrar_movimiento', [MovimientoController::class, 'registrarMovimiento'])->name('registrar_movimiento');

// Personal
Route::get('/informacion_personal', [PersonalController::class,'informacionPersonal'])->name('informacion_personal');
Route::post('/registrar_personal',[PersonalController::class,'registrarPersonal'])->name('registrar_personal');
Route::get('/buscar_personal/{id}',[PersonalController::class,'verPersonal'])->name('verPersonal');
Route::put('/actualizar_personal/{id}',[PersonalController::class,'actualizarPersonal'])->name('actualizarPersonal');
Route::delete('/eliminar_personal/{id}',[PersonalController::class,'eliminarPersonal'])->name('eliminarPersonal');

//Ingreso
Route::get('/informacion_ingresoreporte', [IngresoController::class, 'informacionIngresoReporte'])->name('informacion_ingresoreporte');
Route::get('/informacion_ingresodetalle/{id}', [IngresoController::class, 'obtenerIngresoDetalle'])->name('informacion_ingresodetalle');
Route::get('/informacion_ingreso/{id}', [IngresoController::class, 'obtenerIngreso'])->name('informacion_ingreso');
Route::get('/generar_codigoingreso', [IngresoController::class, 'generarCodigoInterno'])->name('generar_codigoingreso');
Route::post('/registrar_ingreso', [IngresoController::class, 'registrarIngreso'])->name('registrar_ingreso');
Route::put('/actualizar_patrimonio/{id}', [IngresoController::class, 'actualizarPatrimonio'])->name('actualizar_patrimonio');
Route::get('/informacion_ingresopatrimonio/{id}', [IngresoController::class, 'obtenerPatrimonio'])->name('informacion_ingresopatrimonio');

//Baja
Route::get('/informacion_bajareporte', [BajaController::class, 'informacionBajaReporte'])->name('informacion_bajareporte');
Route::get('/informacion_bajadetalle/{id}', [BajaController::class, 'obtenerBajaDetalle'])->name('informacion_bajadetalle');
Route::get('/informacion_baja/{id}', [BajaController::class, 'obtenerBaja'])->name('informacion_baja');
Route::get('/generar_codigobaja', [BajaController::class, 'generarCodigoInterno'])->name('generar_codigobaja');
Route::get('/informacion_encontrarpatrimonio/{id}', [BajaController::class, 'encontrarPatrimonio'])->name('informacion_encontrarpatrimonio');
Route::post('/registrar_baja', [BajaController::class, 'registrarBaja'])->name('registrar_baja');
Route::delete('/remover_bajapatrimonio/{id}', [BajaController::class, 'removerBaja'])->name('remover_bajapatrimonio');





/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/