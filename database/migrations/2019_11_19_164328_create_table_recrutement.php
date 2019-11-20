<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRecrutement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recrutement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('posteAPouvoir')->nullable();
            $table->string('competenceRecherche')->nullable();
            $table->integer('id_type_contrat')->nullable();
           // $table->foreign('id_type_contrat')->references('id')->on('typecontrat');
            $table->date('dateDebut')->nullable();
            $table->string('dureeMission')->nullable();
            $table->float('budgetMensuel')->nullable();
            $table->integer('id_categorie')->nullable();
           // $table->foreign('id_categorie')->references('id')->on('categorie');
            $table->float('salaireBase')->nullable();
            $table->float('surSalaire')->nullable();
            $table->float('primeTp')->nullable();
            $table->float('totalBrut')->nullable();
            $table->float('totalNet1part')->nullable();
            $table->float('totalNetparts')->nullable();
            $table->boolean('telephonePortable')->nullable();
            $table->string('forfait')->nullable();
            $table->string('debitInternet')->nullable();
            $table->string('assurenceMaladie')->nullable();
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
        Schema::dropIfExists('recrutement');
    }
}
