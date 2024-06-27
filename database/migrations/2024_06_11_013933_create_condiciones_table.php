<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondicionesTable extends Migration
{
    public function up()
    {
        Schema::create('condicion', function (Blueprint $table) {
            $table->Increments("IdCondicion", 11);
            $table->string("Descripcion", 50)->nullable(false)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('condicion');
    }
}
