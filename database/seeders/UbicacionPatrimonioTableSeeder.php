<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionPatrimonioTableSeeder extends Seeder
{
    public function run()
    {
        $fecha = Carbon::now();
        $fecha->setTimezone('America/Lima');
        DB::Table('ubicacionpatrimonio')->insert([
            //['IdDetallePatrimonio' => 1, 'Fecha' => $fecha, 'IdServicio' => 2],
            ['IdDetallePatrimonio' => 1, 'IdPersonal' => 2, 'IdServicio' => 2, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdDetallePatrimonio' => 3, 'IdPersonal' => 4, 'IdServicio' => 3, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdDetallePatrimonio' => 2, 'IdPersonal' => 2, 'IdServicio' => 2, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdDetallePatrimonio' => 1, 'IdPersonal' => 3, 'IdServicio' => 2, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdDetallePatrimonio' => 5, 'IdPersonal' => 1, 'IdServicio' => 2, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdDetallePatrimonio' => 2, 'IdPersonal' => 5, 'IdServicio' => 2, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdDetallePatrimonio' => 4, 'IdPersonal' => 2, 'IdServicio' => 2, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdDetallePatrimonio' => 1, 'IdPersonal' => 4, 'IdServicio' => 3, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdDetallePatrimonio' => 5, 'IdPersonal' => 3, 'IdServicio' => 2, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdDetallePatrimonio' => 4, 'IdPersonal' => 2, 'IdServicio' => 2, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdDetallePatrimonio' => 2, 'IdPersonal' => 1, 'IdServicio' => 2, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdDetallePatrimonio' => 4, 'IdPersonal' => 4, 'IdServicio' => 3, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdDetallePatrimonio' => 1, 'IdPersonal' => 4, 'IdServicio' => 3, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdDetallePatrimonio' => 3, 'IdPersonal' => 3, 'IdServicio' => 2, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdDetallePatrimonio' => 5, 'IdPersonal' => 4, 'IdServicio' => 3, 'Fecha' => $fecha, 'Motivo' => 'Falta', 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
    }
}
