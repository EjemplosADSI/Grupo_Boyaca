<?php

use App\Enums\EstadoVenta;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->double('valor_unitario')->unsigned();
            $table->integer('descuento')->unsigned()->nullable();
            $table->integer('cantidad')->unsigned();
            $table->unsignedBigInteger('producto_id')->index()->unsigned(); //llave foranea
            $table->unsignedBigInteger('venta_id')->index()->unsigned(); //llave foranea
            $table->enum('estado', EstadoVenta::getValues())->default(EstadoVenta::Pendiente);
            $table->timestamps();




            $table->foreign('producto_id')
                ->references('id')->on('productos');


            $table->foreign('venta_id')
                ->references('id')->on('ventas');


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
        Schema::dropIfExists('detalle_ventas');
    }
}
