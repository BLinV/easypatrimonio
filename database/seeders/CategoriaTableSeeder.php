<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaTableSeeder extends Seeder
{
    public function run()
    {
        $fecha = Carbon::now();
        $fecha->setTimezone('America/Lima');
        DB::Table('categoria')->insert([
            ['Descripcion'=>'Computadoras', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Refrigeración', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Mobiliario', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Instrumentos Médicos', 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
    }
}
