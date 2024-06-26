<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baja', function (Blueprint $table) {
            $table->Increments("IdBaja");
            $table->string('CodigoBaja', 20)->nullable(false)->unique();
            $table->dateTime("Fecha")->useCurrent();
            $table->string('Observacion', 100)->nullable();
            $table->unsignedInteger('IdPersonal')->nullable(false);
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
        Schema::dropIfExists('baja');
    }
}
