<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposTable extends Migration
{
    public function up()
    {
        Schema::create('tipo', function (Blueprint $table) {
            $table->Increments("IdTipo", 11);
            $table->string("Descripcion", 50)->nullable(false)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo');
    }
}
