<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('title', 150)->index();
            $table->string('label', 20)->nullable();
            $table->string('label_color', 20)->nullable();
            $table->string('description')->nullable();
            $table->string('model', 60)->nullable();
            $table->string('route', 150)->nullable();
            $table->unsignedSmallInteger('order')->default(0);
            $table->string('icon')->nullable();
            $table->string('icon_color')->nullable();
            $table->boolean('enabled')->default(1);
            $table->foreign('parent_id')->nullable()->index()->references('id')->on('menus') //Relacion Indexada para mejorar las busquedas
            ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
