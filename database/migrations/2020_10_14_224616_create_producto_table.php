<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',254)->index();
            $table->unsignedBigInteger('categoria_id')->index()->unsigned(); //llave foranea
            $table->string('referencia_fabrica', 60)->nullable();
            $table->bigInteger('codigo_barras');
            $table->string('unidad_medida', 80);
            $table->text('descripcion');
            $table->integer('stock')->unsigned();
            $table->tinyInteger('iva')->nullable()->default(19);
            $table->double('precio');
            $table->timestamps();





            $table->foreign('categoria_id')
                ->references('id')->on('categorias');

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
        Schema::dropIfExists('productos');
    }
}
