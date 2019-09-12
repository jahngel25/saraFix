<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrden extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orden_servicio', function (Blueprint $table) {
            $table->string('telefono');
            $table->string('address');
            $table->dateTime('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orden_servicio', function (Blueprint $table) {
            $table->dropColumn('telefono');
            $table->dropColumn('address');
            $table->dropColumn('date');
        });
    }
}
