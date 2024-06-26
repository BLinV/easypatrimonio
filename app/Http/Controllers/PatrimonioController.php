<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\DetallePatrimonio;
use App\Models\Origen;
use App\Models\Servicio;
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

    public function informacionOrSerCat(){
        try {
            $origen = Origen::select('IdOrigen', 'Descripcion')->orderBy('Descripcion','asc')->get();
            $categoria = Categoria::select('IdCategoria', 'Descripcion')->orderBy('Descripcion','asc')->get();
            $servicio = Servicio::select('IdServicio', 'Descripcion')->orderBy('Descripcion','asc')->get();
            return response()->json([
                'exito' => true,
                'mensajeError' => '',
                'mensaje' => '',
                '_origen' => $origen,
                '_categoria' => $categoria,
                '_servicio' => $servicio,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensajeError' => $ex->getMessage(),
                'mensaje' => ''
            ]);
        }
    }
    public function informacionPatrimonioReporte(){
        try {
            $detallePatrimonio = DetallePatrimonio::select('CodUTES',
                                            'CodInterno',
                                            DB::raw("CONCAT(`tipo`.`Descripcion`, ' ', `marca`.`Descripcion`, ' ', `patrimonio`.`Modelo`) AS Articulo"),
                                            'detallepatrimonio.Descripcion',
                                            DB::raw("`categoria`.`Descripcion` AS Categoria"),
                                            'Operativo',
                                            'Baja')
                                                -> join('patrimonio', 'detallepatrimonio.IdPatrimonio', '=', 'patrimonio.IdPatrimonio')
                                                -> join('tipo', 'patrimonio.IdTipo', '=', 'tipo.IdTipo')
                                                -> join('marca', 'patrimonio.IdMarca', '=', 'marca.IdMarca')
                                                -> join('categoria', 'patrimonio.IdCategoria', '=', 'categoria.IdCategoria')
                                                -> get();
            return response()->json([
                'exito' => true,
                'mensajeError' => '',
                'mensaje' => '',
                '_detallePatrimonio' => $detallePatrimonio
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensajeError' => $ex->getMessage(),
                'mensaje' => ''
            ]);
        }
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
