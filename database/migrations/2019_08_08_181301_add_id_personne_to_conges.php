<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdPersonneToConges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conges', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('id_personne');

            $table->foreign('id_personne')->references('id')->on('personne');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conges', function (Blueprint $table) {
            //
            $table->removeColumn('id_personne');
        });
    }
}
