<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngresoTableSeeder extends Seeder
{
    public function run()
    {
        $fecha = Carbon::now();
        $fecha->setTimezone('America/Lima');
        DB::Table('ingreso')->insert([
            ['NumeroInterno' => 'INT1234567', 'NumeroPecosa' => '1234567890ABCDEFGHIJ', 'Fecha' => $fecha, 'IdOrigen' => 2, 'IdPersonal' => 1, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['NumeroInterno' => 'INT1234568', 'NumeroPecosa' => '2234567890ABCDEFGHIJ', 'Fecha' => $fecha, 'IdOrigen' => 3, 'IdPersonal' => 1, 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
        DB::Table('ingreso')->insert([
            ['NumeroInterno' => 'INT1234569', 'NumeroPecosa' => '3234567890ABCDEFGHIJ', 'Fecha' => $fecha, 'IdOrigen' => 1, 'Observacion' => 'Palet completo', 'IdPersonal' => 1, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['NumeroInterno' => 'INT1234570', 'NumeroPecosa' => '4234567890ABCDEFGHIJ', 'Fecha' => $fecha, 'IdOrigen' => 3, 'Observacion' => 'Palet dañado', 'IdPersonal' => 1, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['NumeroInterno' => 'INT1234571', 'NumeroPecosa' => '5234567890ABCDEFGHIJ', 'Fecha' => $fecha, 'IdOrigen' => 2, 'Observacion' => 'Palet incompleto', 'IdPersonal' => 1, 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);

        DB::Table('tipo')->insert([
            ['Descripcion'=>'Monitor', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'All in One', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Esfigmomanómetro aneroide', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Estetoscopio', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Sensor de dedo', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Proscopio', 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
        DB::Table('marca')->insert([
            ['Descripcion'=>'HP', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'ACER', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'ADC American Diagnostic Corporation', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Adesco', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Lenovo', 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
        DB::Table('patrimonio')->insert([
            ['IdTipo'=> 1, 'Modelo' => '1800px', 'IdMarca' => 1, 'IdCategoria' => 1, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdTipo'=> 2, 'Modelo' => 'Intel Core TM i5 8Gb 512Gb SSD Ideacentre AIO 3 12° Gen 23.8', 'IdMarca' => 5, 'IdCategoria' => 1, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdTipo'=> 3, 'Modelo' => 'Prosphyg 760', 'IdMarca' => 3, 'IdCategoria' => 4, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdTipo'=> 4, 'Modelo' => 'Adscope', 'IdMarca' => 3, 'IdCategoria' => 4, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdTipo'=> 5, 'Modelo' => 'SPO2 de 8 pies para adultos de 8 pies', 'IdMarca' => 3, 'IdCategoria' => 4, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdTipo'=> 6, 'Modelo' => 'HR digital', 'IdMarca' => 4, 'IdCategoria' => 4, 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
        DB::Table('detallepatrimonio')->insert([
            ['IdPatrimonio'=> 1, 'CodInterno' => 'INT1234567', 'CodUTES' => '123456789ABC', 'CodInterno' => 'CAR123456789', 'Descripcion' => 'Parpadea', 'IdServicio' => 1, 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
        DB::Table('detallepatrimonio')->insert([
            ['IdPatrimonio'=> 3, 'CodInterno' => 'INT1234568', 'CodUTES' => '223456789ABC', 'CodInterno' => 'CAR223456789', 'Descripcion' => 'rojo', 'Operativo' => 1, 'Baja' => 0, 'IdServicio' => 1, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdPatrimonio'=> 5, 'CodInterno' => 'INT1234569', 'CodUTES' => '323456789ABC', 'CodInterno' => 'CAR323456789', 'Descripcion' => 'de aluminio', 'Operativo' => 1, 'Baja' => 0, 'IdServicio' => 7, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdPatrimonio'=> 4, 'CodInterno' => 'INT1234570', 'CodUTES' => '423456789ABC', 'CodInterno' => 'CAR423456789', 'Descripcion' => 'membrana quebrada', 'Operativo' => 0, 'Baja' => 0, 'IdServicio' => 7, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdPatrimonio'=> 4, 'CodInterno' => 'INT1234571', 'CodUTES' => '523456789ABC', 'CodInterno' => 'CAR523456789', 'Descripcion' => 'membrana quebrada', 'Operativo' => 0, 'Baja' => 1, 'IdServicio' => 7, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdPatrimonio'=> 1, 'CodInterno' => 'INT1234572', 'CodUTES' => '623456789ABC', 'CodInterno' => 'CAR623456789', 'Descripcion' => 'membrana perforada', 'Operativo' => 0, 'Baja' => 1, 'IdServicio' => 7, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdPatrimonio'=> 2, 'CodInterno' => 'INT1234573', 'CodUTES' => '723456789ABC', 'CodInterno' => 'CAR723456789', 'Descripcion' => 'parpadea', 'Operativo' => 1, 'Baja' => 0, 'IdServicio' => 1, 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);

        DB::Table('detalleingreso')->insert([
            ['IdIngreso' => 1, 'IdDetallePatrimonio' => 1, 'Estado' => 'Ok', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdIngreso' => 1, 'IdDetallePatrimonio' => 7, 'Estado' => 'Ok', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdIngreso' => 1, 'IdDetallePatrimonio' => 4, 'Estado' => 'Ok', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdIngreso' => 2, 'IdDetallePatrimonio' => 3, 'Estado' => 'Ok', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdIngreso' => 2, 'IdDetallePatrimonio' => 2, 'Estado' => 'Ok', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdIngreso' => 2, 'IdDetallePatrimonio' => 5, 'Estado' => 'Ok', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['IdIngreso' => 3, 'IdDetallePatrimonio' => 6, 'Estado' => 'Ok', 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
    }
}
