<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso', function (Blueprint $table) {
            $table->Increments("IdIngreso");
            $table->string('NumeroPecosa', 20)->nullable(false)->unique();
            $table->dateTime("Fecha")->useCurrent();
            $table->unsignedInteger('IdOrigen')->nullable(false);
            $table->string('Observacion', 100)->nullable();
            $table->unsignedInteger('IdPersonal')->nullable(false);
            $table->foreign('IdOrigen')->references('IdOrigen')->on('origen');
            $table->foreign('IdPersonal')->references('IdPersonal')->on('personal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingreso');
    }
}
