<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatrimoniosTable extends Migration
{
    public function up()
    {
        Schema::create('patrimonio', function (Blueprint $table) {
            $table->Increments("IdPatrimonio");
            $table->unsignedInteger('IdTipo')->nullable(false);
            $table->unsignedInteger('IdMarca')->nullable(false);
            $table->string('Modelo', 100)->nullable(false);
            $table->unsignedInteger('IdCategoria')->nullable(false);
            $table->foreign('IdTipo')->references('IdTipo')->on('tipo');
            $table->foreign('IdMarca')->references('IdMarca')->on('marca');
            $table->foreign('IdCategoria')->references('IdCategoria')->on('categoria');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('patrimonio');
    }
}
