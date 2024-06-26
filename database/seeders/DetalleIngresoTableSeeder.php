<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetalleIngresoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('detalleingreso')->insert([
            ['IdIngreso' => 1, 'IdDetallePatrimonio' => 1, 'Estado' => 'Ok'],
            ['IdIngreso' => 1, 'IdDetallePatrimonio' => 7, 'Estado' => 'Ok'],
            ['IdIngreso' => 1, 'IdDetallePatrimonio' => 4, 'Estado' => 'Ok'],
            ['IdIngreso' => 2, 'IdDetallePatrimonio' => 3, 'Estado' => 'Ok'],
            ['IdIngreso' => 2, 'IdDetallePatrimonio' => 2, 'Estado' => 'Ok'],
            ['IdIngreso' => 2, 'IdDetallePatrimonio' => 5, 'Estado' => 'Ok'],
            ['IdIngreso' => 3, 'IdDetallePatrimonio' => 6, 'Estado' => 'Ok']
        ]);
    }
}
