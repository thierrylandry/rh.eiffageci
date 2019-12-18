<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttrinuteInitialToModification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modification', function (Blueprint $table) {
            //

            $table->integer('service_initial')->nullable();
            $table->integer('id_fonction_initial')->nullable();
            $table->integer('id_type_contrat_initial')->nullable();
            $table->integer('datefinc_initial')->nullable();
            $table->integer('id_definition_initial')->nullable();
            $table->string('id_categorie_initial')->nullable();
            $table->string('regime_initial')->nullable();
            $table->double('budgetMensuel_initial')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('modification', function (Blueprint $table) {
            //
            $table->removeColumn('service_initial');
            $table->removeColumn('id_fonction_initial');
            $table->removeColumn('id_type_contrat_initial');
            $table->removeColumn('datefinc_initial');
            $table->removeColumn('id_definition_initial');
            $table->removeColumn('id_categorie_initial');
            $table->removeColumn('regime1_initial');
            $table->removeColumn('budgetMensuel_initial');
        });
    }
}
