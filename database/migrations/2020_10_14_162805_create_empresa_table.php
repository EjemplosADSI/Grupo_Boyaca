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
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 45);
            $table->bigInteger('nit');
            $table->bigInteger('municipio_id');
            $table->string('direccion', 60);
            $table->bigInteger('telefono');
            $table->string('correoElectronico', 255);
            $table->string('logo', 80);
            $table->enum('estado', ['Activo', 'Inactivo']);
            # Indexes
            $table->unique('id');
            $table->unique('nit');
            $table->unique('correoElectronico');
            $table->index('municipio_id');
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('municipio_id', 'fk_empresas_municipio1_idx')
                ->references('id')->on('municipio')
                ->onDelete('no action')
                ->onUpdate('no action');
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
