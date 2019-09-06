<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationServicioOrden extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_servicio_orden', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_orden')->unsigned();
            $table->integer('id_servicio')->unsigned();
            $table->foreign('id_orden')->references('id')->on('orden_servicio')->onDelete('cascade');
            $table->foreign('id_servicio')->references('id')->on('servicio')->onDelete('cascade');
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
        Schema::dropIfExists('relation_servicio_orden');
    }
}
