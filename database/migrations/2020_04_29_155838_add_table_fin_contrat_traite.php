<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableFinContratTraite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fin_contrat_traite', function (Blueprint $table) {
            //
            $table->bigIncrements('id');
            $table->integer('id_personne');
            $table->integer('id_service');
            $table->string('nom');
            $table->string('prenom');
            $table->string('libelle');
            $table->date('datedebutc');
            $table->date('datefinc');
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
        Schema::table('fin_contrat_traite', function (Blueprint $table) {
            //
        });
    }
}
