<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSucursalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursal', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 60)->index();
            $table->unsignedBigInteger('municipio_id')->index()->unsigned(); //llave foranea
            $table->string('direccion', 60);
            $table->bigInteger('telefono')->unsigned();

            $table->unsignedBigInteger('jefe_id')->nullable()->unsigned();//llave foranea opcional


            $table->unsignedBigInteger('empresa_id')->index()->unsigned(); //llave foranea

            $table->timestamps();


            $table->foreign('empresa_id')
                ->references('id')->on('empresas')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('municipio_id')
                ->references('id')->on('municipio')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('jefe_id')
                ->references('id')->on('usuario')
                ->onDelete('no action')
                ->onUpdate('no action');

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
        Schema::dropIfExists('sucursal');
    }
}
