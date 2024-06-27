<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalTable extends Migration
{
    public function up()
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->Increments("IdPersonal");
            $table->string('Nombres', 70)->nullable(false);
            $table->string('Apellidos', 70)->nullable(false);
            $table->char("Dni", 8)->nullable(false)->unique();
            $table->string('Celular', 9)->nullable(false);
            $table->boolean('Estado')->nullable(false)->default(true);
            $table->unsignedInteger('IdCondicion')->nullable(false);
            $table->unsignedInteger('IdServicio')->nullable(false);
            //$table->unsignedBigInteger('IdUsuario')->nullable();
            $table->foreign('IdServicio')->references('IdServicio')->on('servicio');
            $table->foreign('IdCondicion')->references('IdCondicion')->on('condicion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personal');
    }
}
