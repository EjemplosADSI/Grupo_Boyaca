<?php

use App\Enums\BasicStatus;
use App\Enums\DepartamentoRegion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamento', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 90)->unique()->index();
            $table->enum('region', DepartamentoRegion::getValues());
            $table->enum('estado', BasicStatus::getValues())->default(BasicStatus::Activo);
            $table->timestamps();
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
        Schema::dropIfExists('departamento');
    }
}
