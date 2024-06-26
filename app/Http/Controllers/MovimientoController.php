<?php

namespace App\Http\Controllers;

use App\Models\DetallePatrimonio;
use App\Models\UbicacionPatrimonio;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovimientoController extends Controller
{

    # Vistas

    public function index(){
        return view('pages.patrimonio.movimiento.list', []);
    }

    public function isshow($idDetallePatrimonio){
        try {
            $ubicacionpatrimonio = UbicacionPatrimonio::select('CodUTES', 'CodInterno',
                                            DB::raw("CONCAT(`tipo`.`Descripcion`, ' ', `marca`.`Descripcion`, ' ', `patrimonio`.`Modelo`) AS Articulo"),
                                            'detallepatrimonio.Descripcion',
                                            DB::raw("`categoria`.`Descripcion` AS Categoria"),
                                            'Operativo')
                                                -> join('patrimonio', 'detallepatrimonio.IdPatrimonio', '=', 'patrimonio.IdPatrimonio')
                                                -> join('tipo', 'patrimonio.IdTipo', '=', 'tipo.IdTipo')
                                                -> join('marca', 'patrimonio.IdMarca', '=', 'marca.IdMarca')
                                                -> join('categoria', 'patrimonio.IdCategoria', '=', 'categoria.IdCategoria')
                                                -> where('IdDetallePatrimonio', '=', $idDetallePatrimonio)
                                                -> get();
            return response()->json([
                'exito' => true,
                'mensajeError' => '',
                'mensaje' => '',
                '_ubicacionpatrimonio' => $ubicacionpatrimonio,
            ]);
        } catch (Exception $ex) {
            return response()->json([
                'exito' => false,
                'mensajeError' => $ex->getMessage(),
                'mensaje' => ''
            ]);
        }
    }
    
    # Metodos

    public function informacionMovimientoReporte($idDetallePatrimonio){
        try {
            $detallePatrimonio = DetallePatrimonio::select(
                                            'CodUTES',
                                            'CodInterno',
                                            DB::raw("CONCAT(`tipo`.`Descripcion`, ' ', `marca`.`Descripcion`, ' ', `patrimonio`.`Modelo`) AS Articulo"),
                                            'detallepatrimonio.Descripcion',
                                            DB::raw("`categoria`.`Descripcion` AS Categoria"),
                                            'Operativo',
                                            'Baja',
                                            DB::raw("`servicio`.`Descripcion` AS Servicio"))
                                                -> join('patrimonio', 'detallepatrimonio.IdPatrimonio', '=', 'patrimonio.IdPatrimonio')
                                                -> join('tipo', 'patrimonio.IdTipo', '=', 'tipo.IdTipo')
                                                -> join('marca', 'patrimonio.IdMarca', '=', 'marca.IdMarca')
                                                -> join('categoria', 'patrimonio.IdCategoria', '=', 'categoria.IdCategoria')
                                                -> join('servicio', 'detallepatrimonio.IdServicio', '=', 'servicio.IdServicio')
                                                -> where('detallepatrimonio.IdDetallePatrimonio', '=', $idDetallePatrimonio)
                                                -> get();
            $ubicacionPatrimonio = UbicacionPatrimonio::select(
                                            DB::raw("`servicio`.`Descripcion` AS Servicio"),
                                            DB::raw("CONCAT(`personal`.`Nombres`, ' ', `personal`.`Apellidos`) AS Personal"),
                                            'Fecha')
                                                -> join('servicio', 'ubicacionpatrimonio.IdServicio', '=', 'servicio.IdServicio')
                                                -> join('personal', 'ubicacionpatrimonio.IdPersonal', '=', 'personal.IdPersonal')
                                                -> where('ubicacionpatrimonio.IdDetallePatrimonio', '=', $idDetallePatrimonio)
                                                -> get();
            
            return response()->json([
                'exito' => true,
                'mensajeError' => '',
                'mensaje' => '',
                '_detallePatrimonio' => $detallePatrimonio,
                '_ubicacionPatrimonio' => $ubicacionPatrimonio,
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
