<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RelationTypeUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_typeUser', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->integer('id_type')->unsigned();
            

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_type')->references('id')->on('type_users')->onDelete('cascade');
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
        Schema::table('relation_typeUser', function (Blueprint $table) {
            $table->dropForeign('relation_typeUser_id_type_foreign');
            $table->dropForeign('relation_typeUser_id_user_foreign');            
        });

        Schema::dropIfExists('relation_typeUser');
    }
}
