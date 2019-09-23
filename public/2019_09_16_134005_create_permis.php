<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numero');
            $table->integer('delivrance');
            $table->integer('validite');
            $table->unsignedBigInteger('id_personne');
            $table->foreign('id_personne')->references('id')->on('personne');
            $table->unsignedBigInteger('id_type_permis');
            $table->foreign('id_type_permis')->references('id')->on('type_permis');
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
        Schema::dropIfExists('permis');
    }
}
