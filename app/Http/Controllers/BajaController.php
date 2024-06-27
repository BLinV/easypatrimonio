<?php

namespace App\Http\Controllers;

use App\Http\Requests\BajaRequest;
use App\Models\Baja;
use Exception;
use Illuminate\Support\Facades\DB;

class BajaController extends Controller
{
    public function index()
    {
        return view('pages.patrimonio.baja.list', []);
    }

    public function create()
    {
        return view('pages.patrimonio.baja.create', []);
    }
    
    public function informacionBajaReporte()
    {
        try {
            $baja = Baja::select('CodigoBaja',
                                 'Fecha',
                                 'Observacion',
                                 DB::raw("CONCAT(`personal`.`Nombres`, ' ', `personal`.`Apellidos`) AS Personal"))
                                 -> join('personal', 'baja.IdPersonal', '=', 'personal.IdPersonal')
                                 -> get();
            return response()->json([
                'exito' => true,
                'mensajeError' => '',
                'mensaje' => '',
                '_baja' => $baja,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensajeError' => $ex->getMessage(),
                'mensaje' => ''
            ]);
        }
    }

    public function registrarBaja(BajaRequest $request){
        try {
            $codigo = $request->codigobaja;
            $obervacion = $request->observacion;
            $personal = $request->personal;
            
            $baja = new Baja();
            $baja->codigobaja = $codigo;
            $baja->codigobaja = $obervacion;
            $baja->codigobaja = $personal;

            $baja->save();

            
        } catch(Exception $ex){

        }
    }
}
