<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngresoRequest;
use App\Models\DetalleIngreso;
use App\Models\DetallePatrimonio;
use App\Models\Ingreso;
use App\Models\Marca;
use App\Models\Origen;
use App\Models\Patrimonio;
use App\Models\Tipo;
use App\Models\UbicacionPatrimonio;
use Carbon\Carbon;
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

    public function informacionIngresoOrigen()
    {
        try {
            $origen = Origen::select('IdOrigen', 'Descripcion')->orderBy('Descripcion', 'asc')->get();
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

    public function informacionIngresoReporte()
    {
        try {
            $ingreso = Ingreso::select(
                'NumeroInterno',
                'NumeroPecosa',
                'Fecha',
                DB::raw("`origen`.`Descripcion` AS Origen"),
                'OtroOrigen',
                'Observacion',
                DB::raw("CONCAT(`personal`.`Nombres`, ' ', `personal`.`Apellidos`) AS Personal")
            )
                ->join('origen', 'ingreso.IdOrigen', '=', 'origen.IdOrigen')
                ->join('personal', 'ingreso.IdPersonal', '=', 'personal.IdPersonal')
                ->get();
            return response()->json([
                'exito' => true,
                'mensaje' => '',
                '_ingreso' => $ingreso,
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
            $codigo = Ingreso::generarCodigo();
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

    public function registrarIngreso(IngresoRequest $request)
    {
        try {
            $ingreso = Ingreso::where('NumeroInterno', $request->NumeroInterno)->first();
            $Fecha = Carbon::now();
            $Fecha->setTimezone('America/Lima');

            if (!$ingreso) { //Existe el registro?
                // Si no existe, crear un nuevo ingreso
                $ingreso = new Ingreso();
                $ingreso->NumeroInterno = $request->NumeroInterno;
                $ingreso->NumeroPecosa  = $request->NumeroPecosa;
                $ingreso->Fecha         = $Fecha;
                $ingreso->IdOrigen      = $request->IdOrigen;
                $ingreso->OtroOrigen    = $request->OtroOrigen;
                $ingreso->Observacion   = $request->Observacion;
                $ingreso->IdPersonal    = $request->IdPersonal; // Aplica solo a helen
                $ingreso->save(); //Guarda y captura los datos registrados en la BD
            }
            // Crear Patrimonio
            $patrimonio = new Patrimonio();
            $tipoDescripcion    = $request->tipo_descripcion;
            $tipo = Tipo::firstOrCreate(
                ['Descripcion' => $tipoDescripcion],
                ['Descripcion' => $tipoDescripcion]
            );
            $patrimonio->IdTipo = $tipo->IdTipo;
            $marcaDescripcion   = $request->marca_descripcion;
            $marca = Marca::firstOrCreate(
                ['Descripcion' => $marcaDescripcion],
                ['Descripcion' => $marcaDescripcion]
            );
            $patrimonio->IdMarca        = $marca->IdMarca;
            $patrimonio->Modelo         = $request->Modelo;
            $patrimonio->IdCategoria    = $request->IdCategoria;
            $patrimonio->save();
            // Crear Detalle Patrimonio (uniendo a Patrimonio)
            $detallePatrimonio = new DetallePatrimonio();
            $detallePatrimonio->IdPatrimonio    = $patrimonio->IdPatrimonio;
            $detallePatrimonio->CodInterno      = $request->CodInterno;
            $detallePatrimonio->CodUTES         = $request->CodUTES;
            $detallePatrimonio->CodServicio     = $request->CodServicio;
            $detallePatrimonio->Descripcion     = $request->Descripcion;
            $detallePatrimonio->IdServicio      = $request->IdServicio;
            $detallePatrimonio->save();
            // Crear Detalle Ingreso
            $detalleIngreso = new DetalleIngreso();
            $detalleIngreso->IdIngreso           = $ingreso->IdIngreso;
            $detalleIngreso->IdDetallePatrimonio = $detallePatrimonio->IdDetallePatrimonio;
            $detalleIngreso->Estado              = $request->Estado;
            $detalleIngreso->save();
            // Crear UbicacionPatrimonio
            $ubicacionPatrimonio = new UbicacionPatrimonio();
            $ubicacionPatrimonio->IdDetallePatrimonio = $detallePatrimonio->IdDetallePatrimonio;
            $ubicacionPatrimonio->IdPersonal          = $request->IdEncargado;
            $ubicacionPatrimonio->IdServicio          = $request->IdServicio;
            $ubicacionPatrimonio->Motivo              = $request->Motivo;
            $ubicacionPatrimonio->Fecha               = $Fecha;
            $ubicacionPatrimonio->save();

            return response()->json([
                'exito' => true,
                'mensaje' => 'Ingreso y patrimonio registrados correctamente.'
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Error al registrar el patrimonio.',
                'mensajeError' => $ex->getMessage()
            ]);
        }
    }

    public function obtenerIngresoDetalle(string $numeroInterno)
    {
        try {
            $ingreso = Ingreso::select('NumeroInterno', 'NumeroPecosa', 'Fecha', 'IdOrigen', 'OtroOrigen', 'Observacion', 'IdPersonal')
                ->where('ingreso.NumeroInterno', $numeroInterno)
                ->first();
            if ($ingreso) {
                $detalleIngreso = Ingreso::select(
                    'detallepatrimonio.CodInterno',
                    'detallepatrimonio.CodUTES',
                    'detallepatrimonio.CodServicio',
                    DB::raw("CONCAT(`tipo`.`Descripcion`, ' ', `marca`.`Descripcion`, ' ', `patrimonio`.`Modelo`) AS Articulo"),
                    'detallepatrimonio.Descripcion',
                    DB::raw("`detalleingreso`.`Estado` AS Estado"),
                    DB::raw("servicio.Descripcion AS Servicio"),
                    DB::raw("`categoria`.`Descripcion` AS Categoria")
                )
                    ->join('detalleingreso', 'detalleingreso.IdIngreso', '=', 'ingreso.IdIngreso')
                    ->join('detallepatrimonio', 'detallepatrimonio.IdDetallePatrimonio', '=', 'detalleingreso.IdDetallePatrimonio')
                    ->join('servicio', 'detallepatrimonio.IdServicio', '=', 'servicio.IdServicio')
                    ->join('patrimonio', 'detallepatrimonio.IdPatrimonio', '=', 'patrimonio.IdPatrimonio')
                    ->join('tipo', 'patrimonio.IdTipo', '=', 'tipo.IdTipo')
                    ->join('marca', 'patrimonio.IdMarca', '=', 'marca.IdMarca')
                    ->join('categoria', 'patrimonio.IdCategoria', '=', 'categoria.IdCategoria')
                    ->where('ingreso.NumeroInterno', $numeroInterno)
                    ->get();
                return response()->json([
                    'exito' => true,
                    '_ingreso' => $ingreso,
                    '_detalleingreso' => $detalleIngreso
                ]);
            } else {
                return response()->json([
                    'exito' => false,
                    'mensaje' => 'Registro no encontrado',
                ]);
            }
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensaje' => $ex->getMessage(),
            ]);
        }
    }

    public function obtenerIngreso(string $NumeroPecosa)
    {
        try {
            $ingreso = Ingreso::select('NumeroPecosa', 'Fecha', 'IdOrigen', 'OtroOrigen', 'Observacion')
                ->where('ingreso.NumeroInterno', $NumeroPecosa)
                ->orwhere('ingreso.NumeroPecosa', $NumeroPecosa)
                ->first();
            return response()->json([
                'exito' => true,
                '_ingreso' => $ingreso
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensaje' => $ex->getMessage(),
            ]);
        }
    }

    public function actualizarPatrimonio(Request $request, $CodInterno)
    {
        try {
            $CodUTES            = $request->CodUTES;
            $CodServicio        = $request->CodServicio;
            $Descripcion        = $request->Descripcion;
            $IdServicio         = $request->IdServicio;
            $tipoDescripcion    = $request->tipo_descripcion;
            $marcaDescripcion   = $request->marca_descripcion;
            $Modelo             = $request->Modelo;
            $IdCategoria        = $request->IdCategoria;
            $Estado             = $request->Estado;

            $patrimonioDB = DetallePatrimonio::select('IdDetallePatrimonio', 'IdPatrimonio')->where('CodInterno', '=', $CodInterno)->first();

            if (isset($patrimonioDB)) { //Verificar que sea inicializada y no sea null
                $detallePatrimonio = new DetallePatrimonio();
                $detallePatrimonio->CodUTES         = $CodUTES;
                $detallePatrimonio->CodServicio     = $CodServicio;
                $detallePatrimonio->Descripcion     = $Descripcion;
                $detallePatrimonio->IdServicio      = $IdServicio;

                // Crear Patrimonio
                $patrimonio = new Patrimonio();

                $tipo = Tipo::firstOrCreate(
                    ['Descripcion' => $tipoDescripcion],
                    ['Descripcion' => $tipoDescripcion]
                );
                $marca = Marca::firstOrCreate(
                    ['Descripcion' => $marcaDescripcion],
                    ['Descripcion' => $marcaDescripcion]
                );

                $patrimonio->IdPatrimonio           = $patrimonioDB->IdPatrimonio;
                $patrimonio->IdTipo                 = $tipo->IdTipo;
                $patrimonio->IdMarca                = $marca->IdMarca;
                $patrimonio->Modelo                 = $Modelo;
                $patrimonio->IdCategoria            = $IdCategoria;

                $detalleIngreso = new DetalleIngreso();
                $detalleIngreso->IdDetallePatrimonio = $patrimonioDB->IdDetallePatrimonio;
                $detalleIngreso->Estado              = $Estado;

                DetallePatrimonio::where('CodInterno', '=', $CodInterno)->update([
                    'CodUTES'       => $detallePatrimonio->CodUTES,
                    'CodServicio'   => $detallePatrimonio->CodServicio,
                    'Descripcion'   => $detallePatrimonio->Descripcion,
                    'IdServicio'    => $detallePatrimonio->IdServicio,
                ]);
                Patrimonio::where('IdPatrimonio', '=', $patrimonio->IdPatrimonio)->update([
                    'IdTipo'        => $patrimonio->IdTipo,
                    'IdMarca'       => $patrimonio->IdMarca,
                    'Modelo'        => $patrimonio->Modelo,
                    'IdCategoria'   => $patrimonio->IdCategoria,
                ]);
                DetalleIngreso::where('IdDetallePatrimonio', '=', $detalleIngreso->IdDetallePatrimonio)->update([
                    'Estado'        => $detalleIngreso->Estado,
                ]);
                return response()->json([
                    'exito' => true,
                    'mensajeError' => '',
                    'mensaje' => 'Registrado Correctamente.'
                ]);
            } else {
                return response()->json([
                    'exito' => false,
                    'mensajeError' => 'El patrimonio no existe en el sistema',
                    'mensaje' => ''
                ]);
            }
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensajeError' => $ex->getMessage(),
                'mensaje' => $patrimonioDB,
            ]);
        }
    }

    public function obtenerPatrimonio(string $CodInterno)
    {
        $detallePatrimonio = DetallePatrimonio::select(
            'detallepatrimonio.CodInterno',
            'detallepatrimonio.CodUTES',
            'detallepatrimonio.CodServicio',
            'detallepatrimonio.IdServicio',
            DB::raw("`tipo`.`Descripcion` AS Tipo"),
            DB::raw("`marca`.`Descripcion` AS Marca"),
            DB::raw("`patrimonio`.`Modelo` AS Modelo"),
            DB::raw("CONCAT(`tipo`.`Descripcion`, ' ', `marca`.`Descripcion`, ' ', `patrimonio`.`Modelo`) AS Articulo"),
            'patrimonio.IdCategoria',
            'detallepatrimonio.Descripcion',
            'detalleingreso.estado'
        )
            ->join('patrimonio', 'detallepatrimonio.IdPatrimonio', '=', 'patrimonio.IdPatrimonio')
            ->join('tipo', 'patrimonio.IdTipo', '=', 'tipo.IdTipo')
            ->join('marca', 'patrimonio.IdMarca', '=', 'marca.IdMarca')
            ->join('detalleingreso', 'detallepatrimonio.IdDetallePatrimonio', '=', 'detalleingreso.IdDetallePatrimonio')
            ->where('detallepatrimonio.CodInterno', $CodInterno)
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

    public function obtenerDetalleIngresoOld(string $NumeroPecosa)
    {
        try {
            $detalleIngreso = Ingreso::select(
                DB::raw("`detalleingreso`.`Estado` AS Estado"),
                'detallepatrimonio.CodUTES',
                'detallepatrimonio.CodInterno',
                'detallepatrimonio.Descripcion',
                'detallepatrimonio.Operativo',
                'detallepatrimonio.Baja',
                DB::raw("servicio.Descripcion AS Servicio"),
                DB::raw("CONCAT(`tipo`.`Descripcion`, ' ', `marca`.`Descripcion`, ' ', `patrimonio`.`Modelo`) AS Articulo"),
                DB::raw("`categoria`.`Descripcion` AS Categoria"),
            )
                ->join('detalleingreso', 'detalleingreso.IdIngreso', '=', 'ingreso.IdIngreso')
                ->join('detallepatrimonio', 'detallepatrimonio.IdDetallePatrimonio', '=', 'detalleingreso.IdDetallePatrimonio')
                ->join('servicio', 'detallepatrimonio.IdServicio', '=', 'servicio.IdServicio')
                ->join('patrimonio', 'detallepatrimonio.IdPatrimonio', '=', 'patrimonio.IdPatrimonio')
                ->join('tipo', 'patrimonio.IdTipo', '=', 'tipo.IdTipo')
                ->join('marca', 'patrimonio.IdMarca', '=', 'marca.IdMarca')
                ->join('categoria', 'patrimonio.IdCategoria', '=', 'categoria.IdCategoria')
                ->where('ingreso.NumeroPecosa', $NumeroPecosa)
                ->get();
            return response()->json([
                'exito' => true,
                '_detalleingreso' => $detalleIngreso
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensaje' => $ex->getMessage(),
            ]);
        }
    }
}
