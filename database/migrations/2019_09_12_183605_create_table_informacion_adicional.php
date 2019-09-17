<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInformacionAdicional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacion_adicional', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('identificacion');
            $table->date('fecha_nacimiento');
            $table->string('img_foto')->nullable();
            $table->string('direccion');
            $table->string('transporte');
            $table->string('documento_doc')->nullable();
            $table->string('certificado_doc')->nullable();
            $table->string('bachiller_doc')->nullable();
            $table->string('eps_doc')->nullable();
            $table->string('experiencia');
            $table->string('perfil');
            $table->integer('id_user')->unsigned();
            $table->integer('id_tipo_documento')->unsigned();
            $table->integer('id_ciudad')->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_tipo_documento')->references('id')->on('tipo_documento')->onDelete('cascade');
            $table->foreign('id_ciudad')->references('id')->on('ciudad')->onDelete('cascade');
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
        Schema::dropIfExists('informacion_adicional');
    }
}
