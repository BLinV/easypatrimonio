<?php

namespace Database\Seeders;

//use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionPatrimonioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('ubicacionpatrimonio')->insert([
            //['IdDetallePatrimonio' => 1, 'Fecha' => Carbon::now(), 'IdServicio' => 2],
            ['IdDetallePatrimonio' => 1, 'IdServicio' => 2],
            ['IdDetallePatrimonio' => 3, 'IdServicio' => 7],
            ['IdDetallePatrimonio' => 2, 'IdServicio' => 8],
            ['IdDetallePatrimonio' => 1, 'IdServicio' => 8],
            ['IdDetallePatrimonio' => 5, 'IdServicio' => 6],
            ['IdDetallePatrimonio' => 2, 'IdServicio' => 4],
            ['IdDetallePatrimonio' => 4, 'IdServicio' => 6],
            ['IdDetallePatrimonio' => 1, 'IdServicio' => 4],
            ['IdDetallePatrimonio' => 5, 'IdServicio' => 3],
            ['IdDetallePatrimonio' => 4, 'IdServicio' => 4],
            ['IdDetallePatrimonio' => 2, 'IdServicio' => 4],
            ['IdDetallePatrimonio' => 4, 'IdServicio' => 2],
            ['IdDetallePatrimonio' => 1, 'IdServicio' => 9],
            ['IdDetallePatrimonio' => 3, 'IdServicio' => 11],
            ['IdDetallePatrimonio' => 5, 'IdServicio' => 13]
        ]);
    }
}
