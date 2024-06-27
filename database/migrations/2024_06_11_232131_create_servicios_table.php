<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    public function up()
    {
        Schema::create('servicio', function (Blueprint $table) {
            $table->Increments("IdServicio");
            $table->string("Descripcion", 100)->nullable(false)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('servicio');
    }
}
