<?php

namespace App\Http\Controllers;

use App\Models\condicion;
use App\Models\Personal;
use App\Models\Servicio;
use FFI\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalController extends Controller
{

    # Vistas

    public function index()
    {
        return view('pages.personal.list');
    }

    # Metodos

    public function informacionPersonal()
    {
        try {
            $servicio = Servicio::select('IdServicio', 'Descripcion')->orderBy('Descripcion', 'asc')->get();
            $condicion = condicion::select('IdCondicion', 'Descripcion')->orderBy('Descripcion', 'asc')->get();
            $personal = Personal::select(
                'Dni',
                DB::raw("CONCAT(`Nombres`, ' ', `Apellidos`) AS Persona"),
                DB::raw("condicion.Descripcion AS Condicion"),
                'Celular',
                DB::raw("servicio.Descripcion AS Servicio"),
                'Estado'
            )
                ->join('servicio', 'personal.IdServicio', '=', 'servicio.IdServicio')
                ->join('condicion', 'personal.IdCondicion', '=', 'condicion.IdCondicion')
                ->get();
            return response()->json([
                'exito' => true,
                'mensajeError' => '',
                'mensaje' => '',
                '_servicio' => $servicio,
                '_condicion' => $condicion,
                '_personal' => $personal
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensajeError' => $ex->getMessage(),
                'mensaje' => ''
            ]);
        }
    }

    public function registrarPersonal(Request $request)
    {
        try{
            $nombre = $request->nombre;
            $apellido = $request->apellido;
            $dni = $request->dni;
            $celular = $request->celular;
            $condicion = $request->condicion;
            $servicio = $request->servicio;

            $personal = new Personal();
            $personal->Nombres = $nombre;
            $personal->Apellidos = $apellido;
            $personal->Dni = $dni;
            $personal->Celular = $celular;
            $personal->Estado = 1;
            $personal->IdCondicion = $condicion;
            $personal->IdServicio = $servicio;
    
            $personal->save();
    
            $last_id = Personal::select('IdPersonal')->where('Dni','=',$dni)->get();

            if($last_id){
                return response()->json([
                    'exito' => true,
                    'mensajeError' => '',
                    'mensaje' => 'Registrado Correctamente'
                ]);
            }else{
                return response()->json([
                    'exito' => false,
                    'mensajeError' => 'Error al Registrar',
                    'mensaje' => ''
                ]);
            }
        }catch(Exception $ex){
            return response()->json([
                'exito' => false,
                'mensajeError' => $ex->getMessage(),
                'mensaje' => ''
            ]);
        }
    }
}
