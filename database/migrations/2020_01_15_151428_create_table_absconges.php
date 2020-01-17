<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAbsconges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absconges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_personne');
            $table->integer('id_motif_demande');
            $table->integer('id_users');
            $table->integer('jour');
            $table->boolean('solde');
            $table->date('debut');
            $table->date('fins');
            $table->date('reprise');
            $table->integer('id_valideur')->nullable();
            $table->string('adresse_pd_conges');
            $table->string('contact_telephonique');
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
        Schema::dropIfExists('absconges');
    }
}
