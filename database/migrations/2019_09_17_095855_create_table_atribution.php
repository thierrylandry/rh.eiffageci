<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAtribution extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribution', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('gte')->default(1);
            $table->unsignedBigInteger('id_personne');
            $table->foreign('id_personne')->references('id')->on('personne');
            $table->unsignedBigInteger('id_equipement_securite');
            $table->foreign('id_equipement_securite')->references('id')->on('equipement_securite');
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
        Schema::dropIfExists('attribution');
    }
}
