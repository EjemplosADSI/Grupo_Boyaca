<?php

use App\Enums\BasicStatus;
use App\Enums\Rol;
use App\Enums\TipoDocumento;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',80)->index();
            $table->string('apellido',80);
            $table->enum('tipo_documento', TipoDocumento::getValues());
            $table->unsignedBigInteger('documento')->unique();
            $table->bigInteger('telefono')->unsigned();
            $table->enum('rol', Rol::getValues());
            $table->unsignedBigInteger('municipio_id')->index()->unsigned(); //llave foranea
            $table->string('direccion', 80);
            $table->string('email', 320)->unique();
            $table->string('password')->nullable();
            $table->enum('estado', BasicStatus::getValues())->default(BasicStatus::Activo);
            $table->unsignedBigInteger('empresa_id')->index()->unsigned(); //llave foranea


            $table->rememberToken();
            $table->timestamps();

            $table->foreign('municipio_id')
                ->references('id')
                ->on('municipios');

            $table->foreign('empresa_id')
                ->references('id')->on('empresas');

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
        Schema::dropIfExists('users');
    }
}
