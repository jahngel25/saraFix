<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NuevosServicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nuevo_servicio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('description');
            $table->string('correo');
            $table->string('telefono');
            $table->integer('id_area')->unsigned();
            $table->foreign('id_area')->references('id')->on('area')->onDelete('cascade');
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
        Schema::dropIfExists('nuevo_servicio');
    }
}
