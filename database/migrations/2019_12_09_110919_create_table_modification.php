<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableModification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('fonction')->nullable();
            $table->date('dateFinC')->nullable();
            $table->integer('id_categorie')->nullable();
            $table->foreign('id_categorie')->references('id')->on('categorie');
            $table->date('id_contrat')->nullable();
            $table->foreign('id_contrat')->references('id')->on('contrat');
            $table->float('budgetMensuel')->nullable();
            $table->float('regime')->nullable();
            $table->date('dateEffet')->nullable();
            $table->integer('etat')->default(1);
            $table->integer('id_typeModification')->nullable();
            $table->foreign('id_typeModification')->references('id')->on('type_modification');
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
        Schema::dropIfExists('modification');
    }
}
