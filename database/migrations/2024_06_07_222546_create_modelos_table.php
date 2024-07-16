<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelosTable extends Migration
{
    public function up()
    {
        Schema::create('modelo', function (Blueprint $table) {
            $table->Increments("IdModelo",);
            $table->string("Descripcion", 50)->nullable(false)->unique();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('modelo');
    }
}
