<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbicacionpatrimoniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubicacionpatrimonio', function (Blueprint $table) {
            $table->Increments("idUbicacionPatrimonio");
            $table->unsignedInteger('IdDetallePatrimonio')->nullable(false);
            $table->unsignedInteger('IdServicio')->nullable(false);
            $table->dateTime("Fecha")->useCurrent();
            $table->foreign('IdDetallePatrimonio')->references('IdDetallePatrimonio')->on('detallepatrimonio');
            $table->foreign('IdServicio')->references('IdServicio')->on('servicio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ubicacionpatrimonio');
    }
}
