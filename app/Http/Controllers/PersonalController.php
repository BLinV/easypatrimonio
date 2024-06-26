<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalRequest;
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
                ->orderBy('Persona', 'asc')
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

    public function registrarPersonal(PersonalRequest $request)
    {
        try {
            $dni = $request->dni;
            $nombre = $request->nombre;
            $apellido = $request->apellido;
            $celular = $request->celular;
            $condicion = $request->condicion;
            $servicio = $request->servicio;

            $personal = new Personal();
            $personal->Dni = $dni;
            $personal->Nombres = $nombre;
            $personal->Apellidos = $apellido;
            $personal->Celular = $celular;
            $personal->Estado = 1;
            $personal->IdCondicion = $condicion;
            $personal->IdServicio = $servicio;

            $personal->save();

            $last_id = Personal::select('IdPersonal')->where('Dni', '=', $dni)->get();

            if ($last_id) {
                return response()->json([
                    'exito' => true,
                    'mensajeError' => '',
                    'mensaje' => 'Registrado Correctamente.'
                ]);
            } else {
                return response()->json([
                    'exito' => false,
                    'mensajeError' => 'Error al Registrar.',
                    'mensaje' => ''
                ]);
            }
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensajeError' => $ex->getMessage(),
                'mensaje' => ''
            ]);
        }
    }

    public function actualizarPersonal(Request $request, $dni)
    {
        try {
            //$dni = $request->dni;
            $nombre = $request->nombre;
            $apellido = $request->apellido;
            $celular = $request->celular;
            $condicion = $request->condicion;
            $servicio = $request->servicio;

            $persona = Personal::select('IdPersonal')->where('Dni', '=', $dni)->get();

            if ($persona) {
            } else {
                return response()->json([
                    'exito' => false,
                    'mensajeError' => 'El personal no existe en el sistema',
                    'mensaje' => ''
                ]);
            }

            $personal = new Personal();
            $personal->Dni = $dni;
            $personal->Nombres = $nombre;
            $personal->Apellidos = $apellido;
            $personal->Celular = $celular;
            $personal->Estado = 1;
            $personal->IdCondicion = $condicion;
            $personal->IdServicio = $servicio;

            Personal::where('Dni', '=', $dni)->update([
                'Nombres' => $nombre,
                'Apellidos' => $apellido,
                'Celular' => $celular,
                'IdCondicion' => $condicion,
                'IdServicio' => $servicio
            ]);
            return response()->json([
                'exito' => true,
                'mensajeError' => '',
                'mensaje' => 'Actualizado Correctamente.'
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensajeError' => $ex->getMessage(),
                'mensaje' => ''
            ]);
        }
    }

    public function verPersonal($dni)
    {
        try {
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
                ->where('Dni', '=', $dni)
                ->get();

            if ($personal) {

                $persona = Personal::select('*')->where('Dni', '=', $dni)->get();

                return response()->json([
                    'exito' => true,
                    'mensajeError' => '',
                    'mensaje' => '',
                    '_personal' => $personal,
                    '_persona' => $persona
                ]);
            } else {
                return response()->json([
                    'exito' => false,
                    'mensajeError' => 'El personal no exite en el sistema',
                    'mensaje' => ''
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'exito' => false,
                'mensajeError' => $e->getMessage(),
                'mensaje' => ''
            ]);
        }
    }

    public function eliminarPersonal($dni)
    {
        try {
            $persona = Personal::select('*')->where('Dni', '=', $dni)->get();

            if ($persona) {

                Personal::where('Dni', '=', $dni)->delete();

                return response()->json([
                    'exito' => true,
                    'mensajeError' => '',
                    'mensaje' => 'Eliminado Correctamente'
                ]);
            } else {
                return response()->json([
                    'exito' => false,
                    'mensajeError' => 'El personal no exite en el sistema',
                    'mensaje' => ''
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'exito' => false,
                'mensajeError' => $e->getMessage(),
                'mensaje' => ''
            ]);
        }
    }
}
