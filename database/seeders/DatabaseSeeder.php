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
            //Padre
            OrigenTableSeeder::class,
            ServicioTableSeeder::class,
            CondicionTableSeeder::class,

            TipoTableSeeder::class,
            MarcaTableSeeder::class,
            CategoriaTableSeeder::class,

            //Hija
            PersonalTableSeeder::class,

            PatrimonioTableSeeder::class,
            DetallePatrimonioTableSeeder::class,

            UbicacionPatrimonioTableSeeder::class,

            BajaTableSeeder::class,
            DetalleBajaTableSeeder::class,

            IngresoTableSeeder::class,
            DetalleIngresoTableSeeder::class,
        ]);
    }
}
