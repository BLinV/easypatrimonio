<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BajaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('baja')->insert([
            ['CodigoBaja' => '123456789ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'Observacion' => 'Bloque revisado', 'IdPersonal' => 1],
            ['CodigoBaja' => '223456789ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'Observacion' => 'Ninguno', 'IdPersonal' => 1]
        ]);
        DB::Table('baja')->insert([
            ['CodigoBaja' => '323456789ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'IdPersonal' => 1],
            ['CodigoBaja' => '423456789ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'IdPersonal' => 3],
            ['CodigoBaja' => '523456789ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'IdPersonal' => 1]
        ]);
    }
}
