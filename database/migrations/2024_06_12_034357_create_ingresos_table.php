<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresosTable extends Migration
{
    public function up()
    {
        Schema::create('ingreso', function (Blueprint $table) {
            $table->Increments("IdIngreso");
            $table->char('NumeroInterno', 10)->nullable()->unique();
            $table->varchar('NumeroPecosa', 20)->nullable()->unique();
            $table->dateTime("Fecha")->useCurrent();
            $table->unsignedInteger('IdOrigen')->nullable(false);
            $table->string('OtroOrigen', 100)->nullable(true);
            $table->string('Observacion')->nullable();
            $table->unsignedInteger('IdPersonal')->nullable(false);
            $table->foreign('IdOrigen')->references('IdOrigen')->on('origen');
            $table->foreign('IdPersonal')->references('IdPersonal')->on('personal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ingreso');
    }
}
