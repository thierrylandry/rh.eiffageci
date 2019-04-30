<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSalaire extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaire', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fonction');
            $table->double('sursalaire');
            $table->double('transport');
            $table->double('logement');
            $table->double('salissure');
            $table->double('tenueTravail');
            $table->double('mensuelBrut');
            $table->double('mensuelNet');
            $table->date('dateDebutS');
            $table->date('dateFin');
            $table->double('salbrut');
            $table->unsignedBigInteger('id_categorie');
            $table->unsignedBigInteger('id_contrat');
            $table->foreign('id_categorie')->references('id')->on('categorie');
            $table->foreign('id_contrat')->references('id')->on('contrat');

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
        Schema::dropIfExists('salaire');
    }
}
