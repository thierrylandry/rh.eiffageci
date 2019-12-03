<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEntrettienAndVisiteMedicaleToPersonne extends Migration
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
            $table->boolean("entretien_cs")->default(false);
            $table->boolean("entretien_rh")->default(false);
            $table->boolean("visite_medicale")->default(false);
            $table->date("date_visite")->nullable();
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
            $table->removeColumn("entretien_cs");
            $table->removeColumn("entretien_rh");
            $table->removeColumn("visite_medicale");
            $table->removeColumn("date_visite");
        });
    }
}
