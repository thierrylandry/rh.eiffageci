<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableApprovisionnement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvisionnement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('qte')->default(1);
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
        Schema::dropIfExists('approvisionnement');
    }
}
