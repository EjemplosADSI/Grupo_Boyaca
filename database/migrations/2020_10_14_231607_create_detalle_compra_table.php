<?php

use App\Enums\EstadoCompra;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_compras', function (Blueprint $table) {
            $table->id();
            $table->double('valor_unitario')->unsigned();
            $table->integer('cantidad')->unsigned();
            $table->unsignedBigInteger('producto_id')->index()->unsigned(); //llave foranea
            $table->unsignedBigInteger('compra_id')->index()->unsigned(); //llave foranea
            $table->enum('estado', EstadoCompra::getValues())->default(EstadoCompra::Pendiente);
            $table->timestamps();

            $table->foreign('producto_id')
                ->references('id')->on('productos');


            $table->foreign('compra_id')
                ->references('id')->on('compras');


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
        Schema::dropIfExists('detalle_compras');
    }
}
