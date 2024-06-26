<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngresoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('ingreso')->insert([
            ['NumeroPecosa' => '123456789ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'IdOrigen' => 2, 'IdPersonal' => 1],
            ['NumeroPecosa' => '223456789ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'IdOrigen' => 3, 'IdPersonal' => 1]
        ]);
        DB::Table('ingreso')->insert([
            ['NumeroPecosa' => '323456789ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'IdOrigen' => 1, 'Observacion' => 'Palet completo', 'IdPersonal' => 1],
            ['NumeroPecosa' => '423456789ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'IdOrigen' => 3, 'Observacion' => 'Palet dañado', 'IdPersonal' => 1],
            ['NumeroPecosa' => '523456789ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'IdOrigen' => 2, 'Observacion' => 'Palet incompleto', 'IdPersonal' => 1]
        ]);
    }
}
