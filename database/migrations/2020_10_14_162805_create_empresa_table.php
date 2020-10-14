<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('NIT');
            $table->integer('municipio_id'); //llave foranea
            $table->string('direccion');
            $table->integer('telefono');
            $table->string('correoElectronico');
            $table->string('logo');
            $table->string('logo'); //tipo enum
            $table->timestamps(); //Definición de campos created_at, updated_at (faltante deleted_at)

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}
