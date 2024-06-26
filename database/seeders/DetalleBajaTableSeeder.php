<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetalleBajaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('detallebaja')->insert([
            ['IdBaja' => 1, 'IdDetallePatrimonio' => 5, 'Estado' => 'Membrana quebrada'],
            ['IdBaja' => 1, 'IdDetallePatrimonio' => 7, 'Estado' => 'Membrana quebrada']
        ]);
    }
}
