<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Origen;
use App\Models\Servicio;
use App\Models\Tipo;
use Exception;
use Illuminate\Http\Request;

class BusquedaController extends Controller
{
    public function autocompletarTipo(Request $request){
        $term = $request->get('term');
        $querys = Tipo::where('Descripcion', 'LIKE','%'.$term.'%')->get();
        $data = [];
        foreach ($querys as $query){
            $data[] = [
                'label' => $query->Descripcion // Label es usado por el propio autocomplete del js
            ];
        }
        return $data;
    }

    public function autocompletarMarca(Request $request){
        $term = $request->get('term');
        $querys = Marca::where('Descripcion', 'LIKE','%'.$term.'%')->get();
        $data = [];
        foreach ($querys as $query){
            $data[] = [
                'label' => $query->Descripcion
            ];
        }
        return $data;
    }

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
}
