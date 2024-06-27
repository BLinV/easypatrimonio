<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrigenesTable extends Migration
{
    public function up()
    {
        Schema::create('origen', function (Blueprint $table) {
            $table->Increments("IdOrigen");
            $table->string("Descripcion", 100)->nullable(false)->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('origen');
    }
}
