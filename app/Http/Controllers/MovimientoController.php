<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovimientoRequest;
use App\Models\DetallePatrimonio;
use App\Models\UbicacionPatrimonio;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimientoController extends Controller
{
    # Metodos

    public function informacionMovimientoPatrimonio($Codigo)
    {
        try {
            $idDetallePatrimonio = DetallePatrimonio::select('IdDetallePatrimonio')->where('CodUTES', '=', $Codigo)
                ->orwhere('CodInterno', '=', $Codigo)
                ->orwhere('CodServicio', '=', $Codigo)
                ->first()
                ->IdDetallePatrimonio;
            $ubicacion = UbicacionPatrimonio::select(
                DB::raw("CONCAT(`personal`.`Nombres`, ' ', `personal`.`Apellidos`) AS Persona"),
                DB::raw("`servicio`.`Descripcion` AS Servicio"),
                'Fecha',
                'Motivo'
            )
                ->join('personal', 'ubicacionpatrimonio.IdPersonal', '=', 'personal.IdPersonal')
                ->join('servicio', 'ubicacionpatrimonio.IdServicio', '=', 'servicio.IdServicio')
                ->where('idDetallePatrimonio', '=', $idDetallePatrimonio)
                ->get();
            return response()->json([
                'exito' => true,
                'mensaje' => '',
                '_ubicacion' => $ubicacion
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensaje' => $ex->getMessage()
            ]);
        }
    }
    public function registrarMovimiento(MovimientoRequest $request)
    {
        // Transacción: Iniciar
        DB::beginTransaction();
        try {
            $Fecha = Carbon::now();
            $idDetallePatrimonio = DetallePatrimonio::select('IdDetallePatrimonio')
                ->where('CodInterno', '=', $request->CodInterno)
                ->first()->IdDetallePatrimonio;
            if ($idDetallePatrimonio) {
                $movimiento = new UbicacionPatrimonio();
                $movimiento->IdDetallePatrimonio = $idDetallePatrimonio;
                $movimiento->IdServicio = $request->IdServicio;
                $movimiento->IdPersonal = $request->IdPersonal;
                $movimiento->Fecha = $Fecha;
                $movimiento->Motivo = $request->Motivo;
                $movimiento->save();
                DB::commit();
                return response()->json([
                    'exito' => true,
                    'mensaje' => 'Movimiento registrado correctamente.',
                    'mensajeError' => ''
                ]);
            } else {
                return response()->json([
                    'exito' => false,
                    'mensaje' => '',
                    'mensajeError' => 'No se encuentra el movimiento.'
                ]);
            }
        } catch (Exception $ex) {
            // Transacción: Revertir en caso de error
            DB::rollBack();
            return response()->json([
                'exito' => false,
                'mensaje' => 'Error al registrar el movimiento.',
                'mensajeError' => $ex->getMessage()
            ]);
        }
    }
}
