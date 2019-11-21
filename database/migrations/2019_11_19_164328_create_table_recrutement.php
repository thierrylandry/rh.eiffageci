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
        if (!schema::hasTable('recrutement')){
        Schema::create('recrutement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('posteAPouvoir')->nullable();
            $table->text('competenceRecherche')->nullable();
            $table->text('tache')->nullable();
            $table->integer('id_type_contrat')->nullable();
            // $table->foreign('id_type_contrat')->references('id')->on('typecontrat');
            $table->date('dateDebut')->nullable();
            $table->text('dureeMission')->nullable();
            $table->float('budgetMensuel')->nullable();
            $table->text('id_categorie')->nullable();
            // $table->foreign('id_categorie')->references('id')->on('categorie');
            $table->float('salaireBase')->nullable();
            $table->float('surSalaire')->nullable();
            $table->float('primeTp')->nullable();
            $table->float('totalBrut')->nullable();
            $table->float('totalNet1part')->nullable();
            $table->float('totalNetparts')->nullable();

            $table->boolean('telephone_portable')->default(false);
            $table->string('forfait')->nullable();
            $table->text('debit_internet')->nullable();
            $table->string('assurance_maladie')->nullable();
            $table->integer('etat')->default(1);
            // $table->unsignedBigInteger('id_avantagedotation')->nullable();
            $table->timestamps();
        });
    }
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
