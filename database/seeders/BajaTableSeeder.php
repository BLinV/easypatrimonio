<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BajaTableSeeder extends Seeder
{
    public function run()
    {
        $fecha = Carbon::now();
        $fecha->setTimezone('America/Lima');
        DB::Table('baja')->insert([
            ['CodigoBaja' => 'INT1234567', 'Fecha' => $fecha, 'Observacion' => 'Bloque revisado', 'IdPersonal' => 1, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['CodigoBaja' => 'INT1234568', 'Fecha' => $fecha, 'Observacion' => 'Ninguno', 'IdPersonal' => 1, 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
        DB::Table('baja')->insert([
            ['CodigoBaja' => 'INT1234569', 'Fecha' => $fecha, 'IdPersonal' => 1, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['CodigoBaja' => 'INT1234570', 'Fecha' => $fecha, 'IdPersonal' => 3, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['CodigoBaja' => 'INT1234571', 'Fecha' => $fecha, 'IdPersonal' => 1, 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
        DB::Table('detallebaja')->insert([
            ['IdBaja' => 1, 'IdDetallePatrimonio' => 5, 'Estado' => 'Membrana quebrada', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdBaja' => 1, 'IdDetallePatrimonio' => 7, 'Estado' => 'Membrana quebrada', 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
    }
}
