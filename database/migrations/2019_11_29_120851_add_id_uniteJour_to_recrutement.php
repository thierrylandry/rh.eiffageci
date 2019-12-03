<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdUniteJourToRecrutement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recrutement', function (Blueprint $table) {
            //
            if(!Schema::hasColumn('recrutement','id_uniteJour')){
                $table->integer('id_uniteJour');
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recrutement', function (Blueprint $table) {
            //
            $table->removeColumn('id_uniteJour');
        });
    }
}
