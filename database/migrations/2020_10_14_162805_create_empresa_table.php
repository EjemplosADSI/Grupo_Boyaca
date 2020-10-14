<?php


use App\Enums\BasicStatus;
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
            $table->id();
            $table->string('nombre', 45)->index();
            $table->bigInteger('nit')->unique()->unsigned();
            $table->unsignedBigInteger('municipio_id')->index()->unsigned(); //llave foranea
            $table->string('direccion', 60);
            $table->bigInteger('telefono')->unsigned();
            $table->string('correoElectronico', 255)->unique();
            $table->string('logo', 80);
            $table->enum('estado', BasicStatus::getValues())->default(BasicStatus::Activo);

            $table->timestamps();

            $table->foreign('municipio_id')
                ->references('id')
                ->on('municipio');

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
        Schema::dropIfExists('empresa');
    }
}
