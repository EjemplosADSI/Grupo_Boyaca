<?php

use App\Enums\BasicStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique()->index();
            $table->unsignedBigInteger('departamento_id')->index(); //llave foranea
            $table->string('acortado', 40)->nullable();
            $table->enum('estado', BasicStatus::getValues())->default(BasicStatus::Activo);

            $table->timestamps(); //Definición de campos created_at, updated_at (faltante deleted_at)

            $table->foreign('departamento_id')
                ->references('id')
                ->on('departamento');
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
        Schema::dropIfExists('municipio');
    }
}
