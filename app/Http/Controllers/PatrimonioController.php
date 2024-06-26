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
}
