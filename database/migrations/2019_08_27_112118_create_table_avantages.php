<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAvantages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avantages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('dateDotation')->nullable();
            $table->date('retour')->nullable();
            $table->unsignedBigInteger('id_equippements')->nullable();
            $table->foreign('id_equippements')->references('id')->on('equippements');
            $table->unsignedBigInteger('id_personne')->nullable();
            $table->foreign('id_personne')->references('id')->on('personne');
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
        Schema::dropIfExists('avantages');
    }
}
