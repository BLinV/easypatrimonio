<?php

namespace App\Http\Controllers;

use App\Http\Requests\BajaRequest;
use App\Models\Baja;
use App\Models\DetalleBaja;
use App\Models\DetallePatrimonio;
use Carbon\Carbon;
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
            $baja = Baja::select(
                'CodigoBaja',
                'Fecha',
                'Observacion',
                DB::raw("CONCAT(`personal`.`Nombres`, ' ', `personal`.`Apellidos`) AS Personal")
            )
                ->join('personal', 'baja.IdPersonal', '=', 'personal.IdPersonal')
                ->get();
            return response()->json([
                'exito' => true,
                'mensaje' => '',
                '_baja' => $baja,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensajeError' => $ex->getMessage(),
            ]);
        }
    }

    public function generarCodigoInterno()
    {
        try {
            $codigo = Baja::generarCodigo();
            return response()->json([
                'exito' => true,
                '_codigo' => $codigo,
                'mensaje' => 'Ingreso encontrado',
                'mensajeError' => ''
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensaje' => '',
                'mensajeError' => $ex->getMessage()
            ]);
        }
    }

    public function obtenerBajaDetalle(string $CodigoBaja)
    {
        try {
            $baja = Baja::select('CodigoBaja', 'Fecha', 'Observacion', 'IdPersonal')
                ->where('baja.CodigoBaja', $CodigoBaja)
                ->first();
            if ($baja) {
                $detalleBaja = Baja::select(
                    'detallepatrimonio.CodInterno',
                    'detallepatrimonio.CodUTES',
                    'detallepatrimonio.CodServicio',
                    'detallepatrimonio.Descripcion',
                    DB::raw("`detallebaja`.`Estado` AS Estado"),
                    DB::raw("servicio.Descripcion AS Servicio"),
                    DB::raw("CONCAT(`tipo`.`Descripcion`, ' ', `marca`.`Descripcion`, ' ', `patrimonio`.`Modelo`) AS Articulo"),
                    DB::raw("`categoria`.`Descripcion` AS Categoria"),
                )
                    ->join('detallebaja', 'detallebaja.IdBaja', '=', 'baja.IdBaja')
                    ->join('detallepatrimonio', 'detallepatrimonio.IdDetallePatrimonio', '=', 'detallebaja.IdDetallePatrimonio')
                    ->join('servicio', 'detallepatrimonio.IdServicio', '=', 'servicio.IdServicio')
                    ->join('patrimonio', 'detallepatrimonio.IdPatrimonio', '=', 'patrimonio.IdPatrimonio')
                    ->join('tipo', 'patrimonio.IdTipo', '=', 'tipo.IdTipo')
                    ->join('marca', 'patrimonio.IdMarca', '=', 'marca.IdMarca')
                    ->join('categoria', 'patrimonio.IdCategoria', '=', 'categoria.IdCategoria')
                    ->where('baja.CodigoBaja', $CodigoBaja)
                    ->get();
                return response()->json([
                    'exito' => true,
                    'mensaje' => 'Registro encontrado',
                    '_baja' => $baja,
                    '_detallebaja' => $detalleBaja
                ]);
            } else {
                return response()->json([
                    'exito' => false,
                    'mensaje' => '',
                    'mensajeError' => 'Registro no encontrado'
                ]);
            }
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensaje' => '',
                'mensajeError' => $ex->getMessage()
            ]);
        }
    }

    public function obtenerBaja(string $CodigoBaja)
    {
        try {
            $baja = Baja::select('CodigoBaja', 'Fecha', 'Observacion')
                ->where('baja.CodigoBaja', $CodigoBaja)
                ->first();
            return response()->json([
                'exito' => true,
                'mensaje' => 'Consulta de Patrimonio exitosa.',
                'mensajeError' => '',
                '_baja' => $baja
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensaje' => '',
                'mensajeError' => $ex->getMessage()
            ]);
        }
    }

    public function encontrarPatrimonio(string $codigo)
    {
        try {
            $detallePatrimonio = DetallePatrimonio::select(
                'detallepatrimonio.CodInterno',
                'detallepatrimonio.CodUTES',
                'detallepatrimonio.CodServicio',
                DB::raw("`servicio`.`Descripcion` AS Servicio"),
                DB::raw("CONCAT(`tipo`.`Descripcion`, ' ', `marca`.`Descripcion`, ' ', `patrimonio`.`Modelo`) AS Articulo"),
                DB::raw("`categoria`.`Descripcion` AS Categoria"),
                'detallepatrimonio.Descripcion'
            )
                ->join('patrimonio', 'detallepatrimonio.IdPatrimonio', '=', 'patrimonio.IdPatrimonio')
                ->join('servicio', 'detallepatrimonio.IdServicio', '=', 'servicio.IdServicio')
                ->join('categoria', 'patrimonio.IdCategoria', '=', 'categoria.IdCategoria')

                ->join('tipo', 'patrimonio.IdTipo', '=', 'tipo.IdTipo')
                ->join('marca', 'patrimonio.IdMarca', '=', 'marca.IdMarca')
                ->where('detallepatrimonio.CodInterno', '=', $codigo)
                ->orWhere('detallepatrimonio.CodUTES', '=', $codigo)
                ->orWhere('detallepatrimonio.CodServicio', '=', $codigo)
                ->where('detallepatrimonio.Baja', 0)
                ->first();

            if ($detallePatrimonio) {
                return response()->json([
                    'exito' => true,
                    'mensaje' => 'Consulta de Patrimonio exitosa.',
                    'mensajeError' => '',
                    '_detallepatrimonio' => $detallePatrimonio
                ]);
            } else {
                return response()->json([
                    'exito' => false,
                    'mensaje' => '',
                    'mensajeError' => 'Detalle no encontrado.'
                ], 404);
            }
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensaje' => '',
                'mensajeError' => $ex->getMessage()
            ]);
        }
    }

    public function obtenerListaPatrimonio(string $codigo)
    {
        $detallePatrimonio = DetallePatrimonio::select(
            'detallepatrimonio.CodUTES',
            'detallepatrimonio.CodInterno',
            DB::raw("`servicio`.`Descripcion` AS Servicio"),
            DB::raw("CONCAT(`tipo`.`Descripcion`, ' ', `marca`.`Descripcion`, ' ', `patrimonio`.`Modelo`) AS Articulo"),
            DB::raw("`categoria`.`Descripcion` AS Categoria"),
            'detallepatrimonio.Descripcion',
            'detallebaja.estado'
        )
            ->join('patrimonio', 'detallepatrimonio.IdPatrimonio', '=', 'patrimonio.IdPatrimonio')
            ->join('servicio', 'detallepatrimonio.IdServicio', '=', 'servicio.IdServicio')
            ->join('categoria', 'patrimonio.IdCategoria', '=', 'categoria.IdCategoria')

            ->join('tipo', 'patrimonio.IdTipo', '=', 'tipo.IdTipo')
            ->join('marca', 'patrimonio.IdMarca', '=', 'marca.IdMarca')
            ->join('detallebaja', 'detallepatrimonio.IdDetallePatrimonio', '=', 'detallebaja.IdDetallePatrimonio')
            ->where('detallepatrimonio.CodUTES', $codigo)
            ->first();

        if ($detallePatrimonio) {
            return response()->json([
                'exito' => true,
                '_detallepatrimonio' => $detallePatrimonio
            ]);
        } else {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Detalle no encontrado.'
            ], 404);
        }
    }

    public function registrarBaja(BajaRequest $request)
    {
        try {
            $baja = Baja::where('CodigoBaja', $request->CodigoBaja)->first();
            $Fecha = Carbon::now();
            if (!$baja) {
                // Si no existe, crear un nuevo ingreso
                $baja = new Baja();
                $baja->CodigoBaja   = $request->CodigoBaja;
                $baja->Fecha        = $Fecha;
                $baja->Observacion  = $request->Observacion;
                $baja->IdPersonal   = $request->IdPersonal; // Aplica solo a helen
                $baja->save();
            }

            $detalle = DetallePatrimonio::select('IdDetallePatrimonio', 'Baja')
                ->where('CodInterno', '=', $request->CodInterno)
                ->first();
            if ($detalle->Baja == 0) {
                // Encontrar el Detalle Patrimonio
                DetallePatrimonio::where('CodInterno', '=', $request->CodInterno)
                    ->update(['Baja' => 1]);
                // Consultar información de patrimonio
                $detalleBaja = new DetalleBaja();
                $detalleBaja->IdBaja                = $baja->IdBaja;
                $detalleBaja->IdDetallePatrimonio   = $detalle->IdDetallePatrimonio;
                $detalleBaja->Estado                = $request->Estado;
                $detalleBaja->save();

                return response()->json([
                    'exito' => true,
                    'mensaje' => 'La baja ha sido registrada correctamente.',
                    'mensajeError' => ''
                ]);
            } else {
                return response()->json([
                    'exito' => false,
                    'mensaje' => '',
                    'mensajeError' => 'El patrimonio ya se dio de baja.'
                ]);
            }
        } catch (Exception $ex) {
            // Transacción: Revertir en caso de error
            DB::rollBack();
            return response()->json([
                'exito' => false,
                'mensaje' => '',
                'mensajeError' => $ex->getMessage()
            ]);
        }
    }

    public function removerBaja(string $CodInterno)
    {
        // Transacción: Iniciar
        DB::beginTransaction();
        try {
            $detallePatrimonio = DetallePatrimonio::where('CodInterno', $CodInterno)->first();
            $IdDetallePatrimonio = $detallePatrimonio->IdDetallePatrimonio;
            $detalleBaja = DetalleBaja::where('IdDetallePatrimonio', $IdDetallePatrimonio)->first();
            if ($detalleBaja) {
                DetalleBaja::where('IdDetallePatrimonio', '=', $IdDetallePatrimonio)->delete();
                DetallePatrimonio::where('IdDetallePatrimonio', '=', $IdDetallePatrimonio)->update(['Baja' => 0]);
                DB::commit();
                return response()->json([
                    'exito' => true,
                    'mensaje' => 'La baja ha sido removida correctamente.'
                ]);
            } else {
                return response()->json([
                    'exito' => false,
                    'mensaje' => 'El patrimonio no fue dado de baja.'
                ]);
            }
        } catch (Exception $ex) {
            // Transacción: Revertir en caso de error
            DB::rollBack();
            return response()->json([
                'exito' => false,
                'mensaje' => $ex->getMessage(),
            ]);
        }
    }
}
