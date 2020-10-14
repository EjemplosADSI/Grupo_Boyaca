<?php

use App\Enums\BasicStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalBodegaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursal_bodega', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sucursal_id')->index()->unsigned(); //llave foranea
            $table->unsignedBigInteger('bodega_id')->index()->unsigned(); //llave foranea
            $table->enum('estado', BasicStatus::getValues())->default(BasicStatus::Activo);
            $table->timestamps();


            $table->foreign('sucursal_id')
                ->references('id')->on('sucursales');


            $table->foreign('bodega_id')
                ->references('id')->on('bodegas');

            $table->softDeletes();
    });
}
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursal_bodega');
    }
}

