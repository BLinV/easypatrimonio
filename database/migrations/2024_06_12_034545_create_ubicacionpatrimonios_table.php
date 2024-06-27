<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbicacionpatrimoniosTable extends Migration
{
    public function up()
    {
        Schema::create('ubicacionpatrimonio', function (Blueprint $table) {
            $table->Increments("idUbicacionPatrimonio");
            $table->unsignedInteger('IdDetallePatrimonio')->nullable(false);
            $table->unsignedInteger('IdPersonal')->nullable(false);
            $table->unsignedInteger('IdServicio')->nullable(false);
            $table->dateTime("Fecha")->useCurrent();
            $table->string('Motivo', 100)->nullable();
            $table->foreign('IdDetallePatrimonio')->references('IdDetallePatrimonio')->on('detallepatrimonio');
            $table->foreign('IdServicio')->references('IdServicio')->on('servicio');
            $table->foreign('IdPersonal')->references('IdPersonal')->on('personal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ubicacionpatrimonio');
    }
}
