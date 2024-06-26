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
            ['IdDetallePatrimonio' => 1, 'IdServicio' => 2, 'IdPersonal' => 2, 'Motivo' => 'Falta'],
            ['IdDetallePatrimonio' => 3, 'IdServicio' => 7, 'IdPersonal' => 4, 'Motivo' => 'Falta'],
            ['IdDetallePatrimonio' => 2, 'IdServicio' => 8, 'IdPersonal' => 2, 'Motivo' => 'Falta'],
            ['IdDetallePatrimonio' => 1, 'IdServicio' => 8, 'IdPersonal' => 3, 'Motivo' => 'Falta'],
            ['IdDetallePatrimonio' => 5, 'IdServicio' => 6, 'IdPersonal' => 1, 'Motivo' => 'Falta'],
            ['IdDetallePatrimonio' => 2, 'IdServicio' => 4, 'IdPersonal' => 5, 'Motivo' => 'Falta'],
            ['IdDetallePatrimonio' => 4, 'IdServicio' => 6, 'IdPersonal' => 2, 'Motivo' => 'Falta'],
            ['IdDetallePatrimonio' => 1, 'IdServicio' => 4, 'IdPersonal' => 4, 'Motivo' => 'Falta'],
            ['IdDetallePatrimonio' => 5, 'IdServicio' => 3, 'IdPersonal' => 3, 'Motivo' => 'Falta'],
            ['IdDetallePatrimonio' => 4, 'IdServicio' => 4, 'IdPersonal' => 2, 'Motivo' => 'Falta'],
            ['IdDetallePatrimonio' => 2, 'IdServicio' => 4, 'IdPersonal' => 1, 'Motivo' => 'Falta'],
            ['IdDetallePatrimonio' => 4, 'IdServicio' => 2, 'IdPersonal' => 4, 'Motivo' => 'Falta'],
            ['IdDetallePatrimonio' => 1, 'IdServicio' => 9, 'IdPersonal' => 4, 'Motivo' => 'Falta'],
            ['IdDetallePatrimonio' => 3, 'IdServicio' => 11, 'IdPersonal' => 3, 'Motivo' => 'Falta'],
            ['IdDetallePatrimonio' => 5, 'IdServicio' => 13, 'IdPersonal' => 4, 'Motivo' => 'Falta']
        ]);
    }
}
