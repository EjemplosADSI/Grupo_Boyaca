<?php

use App\Enums\EstadoCompra;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->double('valor_total')->unsigned();
            $table->unsignedBigInteger('proveedor_id')->index()->unsigned(); //llave foranea
            $table->unsignedBigInteger('bodega_id')->index()->unsigned(); //llave foranea
            $table->enum('estado', \App\Enums\EstadoVenta::getValues())->default(EstadoCompra::Pendiente);

            $table->softDeletes();
            $table->timestamps();


            $table->foreign('proveedor_id')
                ->references('id')->on('users');

            $table->foreign('bodega_id')
                ->references('id')->on('bodegas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra');
    }
}
