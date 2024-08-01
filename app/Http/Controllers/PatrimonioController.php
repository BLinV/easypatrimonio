<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatrimonioRequest;
use App\Models\Baja;
use App\Models\DetallePatrimonio;
use App\Models\Ingreso;
use App\Models\Marca;
use App\Models\Patrimonio;
use App\Models\Tipo;
use App\Models\UbicacionPatrimonio;
use Exception;
use Illuminate\Support\Facades\DB;

class PatrimonioController extends Controller
{

    # Vistas

    public function index()
    {
        return view('pages.patrimonio.articulo.list', []);
    }

    public function update()
    {
        return view('pages.patrimonio.articulo.actualizar', []);
    }

    # Metodos (Eloquent) “pluck()”
    public function informacionPatrimonioReporte()
    {
        try {
            $patrimonio = DetallePatrimonio::select(
                'CodInterno',
                'CodUTES',
                'CodServicio',
                DB::raw("CONCAT(`tipo`.`Descripcion`, ' ', `marca`.`Descripcion`, ' ', `patrimonio`.`Modelo`) AS Articulo"),
                'detallepatrimonio.Descripcion',
                DB::raw("`categoria`.`Descripcion` AS Categoria"),
                'Operativo',
                'Baja'
            )
                ->join('patrimonio', 'detallepatrimonio.IdPatrimonio', '=', 'patrimonio.IdPatrimonio')
                ->join('categoria', 'patrimonio.IdCategoria', '=', 'categoria.IdCategoria')
                ->join('tipo', 'patrimonio.IdTipo', '=', 'tipo.IdTipo')
                ->join('marca', 'patrimonio.IdMarca', '=', 'marca.IdMarca')
                ->get();
            return response()->json([
                'exito' => true,
                'mensaje' => '',
                '_patrimonio' => $patrimonio
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensaje' => $ex->getMessage()
            ]);
        }
    }

    public function informacionDetallePatrimonio(string $Codigo)
    {
        try {
            $idDetallePatrimonio = DetallePatrimonio::select(
                'IdDetallePatrimonio',
                DB::raw("servicio.Descripcion AS Servicio"),
            )
                ->join('servicio', 'detallepatrimonio.IdServicio', '=', 'servicio.IdServicio')
                ->where('CodInterno', '=', $Codigo)
                ->orwhere('CodUTES', '=', $Codigo)
                ->orwhere('CodServicio', '=', $Codigo)
                ->first();
            $ingreso = Ingreso::select(
                'NumeroInterno',
                'NumeroPecosa',
                'Fecha',
                'detalleingreso.Estado',
                DB::raw("`origen`.`Descripcion` AS Origen"),
            )
                ->join('detalleingreso', 'detalleingreso.IdIngreso', '=', 'ingreso.IdIngreso')
                ->join('detallepatrimonio', 'detallepatrimonio.IdDetallePatrimonio', '=', 'detalleingreso.IdDetallePatrimonio')
                ->join('origen', 'ingreso.IdOrigen', '=', 'origen.IdOrigen')
                ->where('detalleingreso.idDetallePatrimonio', '=', $idDetallePatrimonio->IdDetallePatrimonio)
                ->first();
            $baja = Baja::select(
                'CodigoBaja',
                'Fecha',
                'detallebaja.Estado'
            )
                ->join('detallebaja', 'detallebaja.IdBaja', '=', 'baja.IdBaja')
                ->where('detallebaja.idDetallePatrimonio', '=', $idDetallePatrimonio->IdDetallePatrimonio)
                ->first();
            $ubicacion = UbicacionPatrimonio::select(
                DB::raw("`servicio`.`Descripcion` AS Servicio")
            )
                ->join('servicio', 'ubicacionpatrimonio.IdServicio', '=', 'servicio.IdServicio')
                ->where('idDetallePatrimonio', '=', $idDetallePatrimonio->IdDetallePatrimonio)
                ->orderBy('Fecha', 'desc')->first()->Servicio;
            return response()->json([
                'exito' => true,
                'mensaje' => '',
                '_origen' => $ingreso,
                '_baja' => $baja,
                '_servicio' => $idDetallePatrimonio->Servicio,
                '_ubicacion' => $ubicacion
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensaje' => $ex->getMessage()
            ]);
        }
    }

    public function estadoOperativoPatrimonio(string $CodInterno)
    {
        DB::beginTransaction();
        try {
            $detallePatrimonio = DetallePatrimonio::where('CodInterno', $CodInterno)->first();
            DetallePatrimonio::where('IdDetallePatrimonio', '=', $detallePatrimonio->IdDetallePatrimonio)
                ->update(['Operativo' => !$detallePatrimonio->Operativo]);
            DB::commit();
            return response()->json([
                'exito' => true,
                'mensaje' => 'La operatividad del patrimonio fue modificada.',
                'mensajeError' => ''
            ]);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'exito' => false,
                'mensaje' => '',
                'mensajeError' => $ex->getMessage()
            ]);
        }
    }

    public function registrarPatrimonio(PatrimonioRequest $request)
    {
        // Transacción: Iniciar
        DB::beginTransaction();

        try {
            // Descripción del tipo y marca desde el request
            $tipoDescripcion    = $request->tipo_descripcion;
            $marcaDescripcion   = $request->marca_descripcion;

            // Verificar o crear tipo
            $tipo = Tipo::firstOrCreate(
                ['Descripcion' => $tipoDescripcion], //Busqueda del resgitro
                ['Descripcion' => $tipoDescripcion]  //Crear el registro si no se encuentra
            );

            // Verificar o crear marca
            $marca = Marca::firstOrCreate(
                ['Descripcion' => $marcaDescripcion],
                ['Descripcion' => $marcaDescripcion]
            );

            // Crear el registro en Patrimonio
            $patrimonio = new Patrimonio();
            $patrimonio->IdTipo         = $tipo->IdTipo;
            $patrimonio->IdMarca        = $marca->IdMarca;
            $patrimonio->Modelo         = $request->modelo;
            $patrimonio->IdCategoria    = $request->IdCategoria;
            $patrimonio->save();

            // Crear Detalle Patrimonio (uniendo a Patrimonio)
            $detallePatrimonio = new DetallePatrimonio();
            $detallePatrimonio->IdPatrimonio    = $patrimonio->IdPatrimonio;
            $detallePatrimonio->CodUTES         = $request->CodUTES;
            $detallePatrimonio->CodInterno      = $request->CodInterno;
            $detallePatrimonio->Descripcion     = $request->Descripcion;
            $detallePatrimonio->Operativo       = $request->Operativo;
            $detallePatrimonio->Baja            = $request->Baja;
            $detallePatrimonio->IdServicio      = $request->IdServicio;
            $detallePatrimonio->save();

            // Transacción: Confirmar
            DB::commit();

            return response()->json([
                'exito' => true,
                'mensaje' => 'Patrimonio y detalle registrado correctamente.'
            ]);
        } catch (Exception $ex) {
            // Transacción: Revertir en caso de error
            DB::rollBack();
            return response()->json([
                'exito' => false,
                'mensajeError' => $ex->getMessage(),
                'mensaje' => 'Error al registrar el patrimonio.'
            ]);
        }
    }
}
