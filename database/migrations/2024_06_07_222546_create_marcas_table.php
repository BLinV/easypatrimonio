<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcasTable extends Migration
{
    public function up()
    {
        Schema::create('marca', function (Blueprint $table) {
            $table->Increments("IdMarca",);
            $table->string("Descripcion", 50)->nullable(false)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marca');
    }
}
