<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLieuNaissanceNomsPereNomMereToPersonne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personne', function (Blueprint $table) {
            //
            $table->string("lieu_naissance")->nullable();
            $table->string("noms_pere")->nullable();
            $table->string("noms_mere")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personne', function (Blueprint $table) {
            //
            $table->removeColumn("lieu_naissance");
            $table->removeColumn("noms_pere");
            $table->removeColumn("noms_mere");
        });
    }
}
