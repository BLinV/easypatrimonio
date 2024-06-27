<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallebajasTable extends Migration
{
    public function up()
    {
        Schema::create('detallebaja', function (Blueprint $table) {
            $table->Increments("IdDetalleBaja");
            $table->unsignedInteger('IdBaja')->nullable(false);
            $table->unsignedInteger('IdDetallePatrimonio')->nullable(false);
            $table->string('Estado', 50)->nullable();
            $table->foreign('IdBaja')->references('IdBaja')->on('Baja');
            $table->foreign('IdDetallePatrimonio')->references('IdDetallePatrimonio')->on('detallepatrimonio');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detallebaja');
    }
}
