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
        if(!Schema::hasTable('modification','id'))
        {Schema::create('modification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('fonction')->nullable();
            $table->date('dateFinC')->nullable();
            $table->string('id_categorie')->nullable();
            $table->integer('id_type_contrat')->nullable();
            $table->integer('id_contrat')->nullable();
            //$table->foreign('id_contrat')->references('id')->on('contrat');
            $table->string('budgetMensuel')->nullable();
            $table->string('regime')->nullable();
            $table->date('dateEffet')->nullable();
            $table->integer('etat')->default(1);
            $table->integer('id_typeModification')->nullable();
            $table->foreign('id_typeModification')->references('id')->on('type_modification');
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
        Schema::dropIfExists('modification');
    }
}
