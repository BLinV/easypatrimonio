<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallepatrimoniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallepatrimonio', function (Blueprint $table) {
            $table->Increments("IdDetallePatrimonio");
            $table->unsignedInteger('IdPatrimonio')->nullable(false);
            $table->char("CodUTES", 12)->nullable(false)->unique();
            $table->string("CodInterno", 12)->nullable()->unique();
            $table->string('Descripcion', 250)->nullable(false);
            $table->boolean('Operativo')->default('1');
            $table->boolean('Baja')->default('0');
            $table->unsignedInteger('IdServicio')->nullable(false);
            $table->foreign('IdPatrimonio')->references('IdPatrimonio')->on('patrimonio');
            $table->foreign('IdServicio')->references('IdServicio')->on('servicio');
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
        Schema::dropIfExists('detallepatrimonio');
    }
}
