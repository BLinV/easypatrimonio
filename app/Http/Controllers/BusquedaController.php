<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Tipo;
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
}
