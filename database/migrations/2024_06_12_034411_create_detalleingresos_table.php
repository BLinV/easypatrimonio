<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleingresosTable extends Migration
{
    public function up()
    {
        Schema::create('detalleingreso', function (Blueprint $table) {
            $table->Increments("IdDetalleIngreso");
            $table->unsignedInteger('IdIngreso')->nullable(false);
            $table->unsignedInteger('IdDetallePatrimonio')->nullable(false);
            $table->string('Estado', 50)->nullable();
            $table->foreign('IdIngreso')->references('IdIngreso')->on('ingreso');
            $table->foreign('IdDetallePatrimonio')->references('IdDetallePatrimonio')->on('detallepatrimonio');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detalleingreso');
    }
}
