<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetallePatrimonioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('detallepatrimonio')->insert([
            ['IdPatrimonio'=> 1, 'CodUTES' => '123456789ABC', 'CodInterno' => 'CAR123456789', 'Descripcion' => 'Parpadea', 'IdServicio' => 1]
        ]);
        DB::Table('detallepatrimonio')->insert([
            ['IdPatrimonio'=> 3, 'CodUTES' => '223456789ABC', 'CodInterno' => 'CAR223456789', 'Descripcion' => 'rojo', 'Operativo' => 1, 'Baja' => 0, 'IdServicio' => 1],
            ['IdPatrimonio'=> 5, 'CodUTES' => '323456789ABC', 'CodInterno' => 'CAR323456789', 'Descripcion' => 'de aluminio', 'Operativo' => 1, 'Baja' => 0, 'IdServicio' => 7],
            ['IdPatrimonio'=> 4, 'CodUTES' => '423456789ABC', 'CodInterno' => 'CAR423456789', 'Descripcion' => 'membrana quebrada', 'Operativo' => 0, 'Baja' => 0, 'IdServicio' => 7],
            ['IdPatrimonio'=> 4, 'CodUTES' => '523456789ABC', 'CodInterno' => 'CAR523456789', 'Descripcion' => 'membrana quebrada', 'Operativo' => 0, 'Baja' => 1, 'IdServicio' => 7],
            ['IdPatrimonio'=> 1, 'CodUTES' => '623456789ABC', 'CodInterno' => 'CAR623456789', 'Descripcion' => 'membrana perforada', 'Operativo' => 0, 'Baja' => 1, 'IdServicio' => 7],
            ['IdPatrimonio'=> 2, 'CodUTES' => '723456789ABC', 'CodInterno' => 'CAR723456789', 'Descripcion' => 'parpadea', 'Operativo' => 1, 'Baja' => 0, 'IdServicio' => 1]
        ]);
    }
}
