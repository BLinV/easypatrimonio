<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            //Obligatoria
            OrigenTableSeeder::class,
            ServicioTableSeeder::class,
            CondicionTableSeeder::class,
            
            CategoriaTableSeeder::class,

            PersonalTableSeeder::class,
            //Prueba
            /*TipoTableSeeder::class,
            MarcaTableSeeder::class,
            PatrimonioTableSeeder::class,
            DetallePatrimonioTableSeeder::class,
            UbicacionPatrimonioTableSeeder::class,
            BajaTableSeeder::class,
            DetalleBajaTableSeeder::class,
            IngresoTableSeeder::class,
            DetalleIngresoTableSeeder::class,*/
        ]);
    }
}
