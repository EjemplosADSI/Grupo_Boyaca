
<?php

use App\Enums\FormaPago;
use App\Enums\EstadoVenta;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateVentaTable extends Migration
{
    /**
     * Run the migrations.
     * @table venta
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->double('valor_total')->unsigned();
            $table->unsignedBigInteger('cliente_id')->index()->unsigned(); //llave foranea
            $table->unsignedBigInteger('vendedor_id')->index()->unsigned(); //llave foranea
            $table->unsignedBigInteger('sucursal_id')->index()->unsigned(); //llave foranea
            $table->enum('forma_pago', FormaPago::getValues());
            $table->enum('estado', \App\Enums\EstadoVenta::getValues())->default(EstadoVenta::Pendiente);

            $table->softDeletes();
            $table->timestamps();


            $table->foreign('cliente_id')
                ->references('id')->on('users');

            $table->foreign('vendedor_id')
                ->references('id')->on('users');

            $table->foreign('sucursal_id')
                ->references('id')->on('sucursales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('ventas');
    }
}
