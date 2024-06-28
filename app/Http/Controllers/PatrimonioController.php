<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatrimonioRequest;
use App\Models\DetallePatrimonio;
use App\Models\Marca;
use App\Models\Patrimonio;
use App\Models\Tipo;
use Exception;
use Illuminate\Support\Facades\DB;

class PatrimonioController extends Controller
{

    # Vistas

    public function index(){
        return view('pages.patrimonio.articulo.index', []);
    }

    public function update(){
        return view('pages.patrimonio.articulo.actualizar', []);
    }

    # Metodos (Eloquent) “where()”, “first()”, “find()”, “pluck()”, “join()”
    public function informacionPatrimonioReporte(){
        try {
            $patrimonio = DetallePatrimonio::select('CodUTES',
                                            'CodInterno',
                                            DB::raw("CONCAT(`tipo`.`Descripcion`, ' ', `marca`.`Descripcion`, ' ', `patrimonio`.`Modelo`) AS Articulo"),
                                            DB::raw("servicio.Descripcion AS Servicio"))
                                                -> join('patrimonio', 'detallepatrimonio.IdPatrimonio', '=', 'patrimonio.IdPatrimonio')
                                                -> join('tipo', 'patrimonio.IdTipo', '=', 'tipo.IdTipo')
                                                -> join('marca', 'patrimonio.IdMarca', '=', 'marca.IdMarca')
                                                -> join('servicio', 'detallepatrimonio.IdServicio', '=', 'servicio.IdServicio')
                                                -> get();
            return response()->json([
                'exito' => true,
                'mensajeError' => '',
                'mensaje' => '',
                '_patrimonio' => $patrimonio
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensajeError' => $ex->getMessage(),
                'mensaje' => ''
            ]);
        }
    }
    
    public function obtenerDetallePatrimonio(string $CodUTES)
    {
        $detallePatrimonio = DetallePatrimonio::select('detallepatrimonio.Descripcion',
                                                        DB::raw("`categoria`.`Descripcion` AS Categoria"),
                                                        'Operativo',
                                                        'Baja',
                                                        DB::raw("servicio.Descripcion AS Ubicacion")) //Modificar con la ubicación actual del patrimonio
                                                            -> join('patrimonio', 'detallepatrimonio.IdPatrimonio', '=', 'patrimonio.IdPatrimonio')
                                                            -> join('categoria', 'patrimonio.IdCategoria', '=', 'categoria.IdCategoria')
                                                            -> join('servicio', 'detallepatrimonio.IdServicio', '=', 'servicio.IdServicio')
                                                            -> where('detallepatrimonio.CodUTES', $CodUTES)
                                                            -> get();
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

    public function registrarPatrimonio(PatrimonioRequest $request)
    {
        // Transacción: Iniciar
        DB::beginTransaction();

        try {
            // Descripción del tipo y marca desde el request
            $tipoDescripcion = $request->tipo_descripcion;
            $marcaDescripcion = $request->marca_descripcion;

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

            // Crear el registro en patrimonio
            $patrimonio = new Patrimonio();
            $patrimonio->IdTipo = $tipo->IdTipo;
            $patrimonio->IdMarca = $marca->IdMarca;
            $patrimonio->Modelo = $request->modelo;
            $patrimonio->IdCategoria = $request->IdCategoria; // Asegúrate de pasar este valor desde el request
            $patrimonio->save();

            // Crear detalle patrimonio
            $detallePatrimonio = new DetallePatrimonio();
            $detallePatrimonio->IdPatrimonio = $patrimonio->IdPatrimonio;
            $detallePatrimonio->CodUTES = $request->detalle['CodUTES'];
            $detallePatrimonio->CodInterno = $request->detalle['CodInterno'];
            $detallePatrimonio->Descripcion = $request->detalle['Descripcion'];
            $detallePatrimonio->Operativo = $request->detalle['Operativo'];
            $detallePatrimonio->Baja = $request->detalle['Baja'];
            $detallePatrimonio->IdServicio = $request->detalle['IdServicio'];
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

    public function registrarIngreso()
    {
        
    }
    /*
    SELECT p.IdPatrimonio, dp.IdDetallePatrimonio, CONCAT(t.Descripcion, " ", m.Descripcion, " ", p.Modelo) AS Articulo, dp.CodUTES, dp.CodInterno, dp.Descripcion AS Comentario, c.Descripcion AS Categoria,
    IF(dp.Operativo, "Si", "No") AS Operativo, IF(dp.Baja, "Si", "No") AS De_Baja,
    s.Descripcion AS Servicio, UbicacionFisica.UbicacionFisica, UbicacionFisica.FechaTraslado
    FROM DetallePatrimonio dp
    INNER JOIN Servicio s ON s.IdServicio = dp.IdServicio
    INNER JOIN Patrimonio p ON p.IdPatrimonio = dp.IdPatrimonio
    INNER JOIN Tipo t ON t.IdTipo = p.IdTipo
    INNER JOIN Marca m ON m.IdMarca = p.IdMarca
    INNER JOIN Categoria c ON c.IdCategoria = p.IdCategoria
    LEFT JOIN (SELECT up.IdDetallePatrimonio, s.Descripcion AS UbicacionFisica, up.Fecha AS FechaTraslado FROM UbicacionPatrimonio up
               JOIN (
                   SELECT IdDetallePatrimonio, MAX(idUbicacionPatrimonio) as UltimoMovimiento
                   FROM UbicacionPatrimonio
                   GROUP BY IdDetallePatrimonio
               ) PatrimonioIdMovim ON up.IdDetallePatrimonio = PatrimonioFecha.IdDetallePatrimonio
                JOIN Servicio s ON s.IdServicio = up.IdServicio) UbicacionFisica ON UbicacionFisica.IdDetallePatrimonio = dp.IdDetallePatrimonio
    ORDER BY p.IdPatrimonio, dp.IdDetallePatrimonio;
    */
}
