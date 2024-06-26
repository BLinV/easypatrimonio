<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\Origen;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IngresoController extends Controller
{
    public function index()
    {
        return view('pages.patrimonio.ingreso.list', []);
    }

    public function create()
    {
        return view('pages.patrimonio.ingreso.create', []);
    }

    public function informacionIngresoReporte()
    {
        try {
            $ingreso = Ingreso::select(
                'NumeroPecosa',
                'Fecha',
                DB::raw("`origen`.`Descripcion` AS Origen"),
                'Observacion',
                DB::raw("CONCAT(`personal`.`Nombres`, ' ', `personal`.`Apellidos`) AS Personal"))
                -> join('origen', 'ingreso.IdOrigen', '=', 'origen.IdOrigen')
                -> join('personal', 'ingreso.IdPersonal', '=', 'personal.IdPersonal')
                -> get();
            return response()->json([
                'exito' => true,
                'mensajeError' => '',
                'mensaje' => '',
                '_ingreso' => $ingreso,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensajeError' => $ex->getMessage(),
                'mensaje' => ''
            ]);
        }
    }
    public function informacionIngresoOrigen(){
        try {
            $origen = Origen::select('IdOrigen', 'Descripcion')->orderBy('Descripcion','asc')->get();
            return response()->json([
                'exito' => true,
                'mensajeError' => '',
                'mensaje' => '',
                '_origen' => $origen,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensajeError' => $ex->getMessage(),
                'mensaje' => ''
            ]);
        }
    }
}
