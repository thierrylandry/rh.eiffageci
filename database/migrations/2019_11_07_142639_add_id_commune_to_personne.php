<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdCommuneToPersonne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('personne','id_commune')){

            Schema::table('personne', function (Blueprint $table) {
                //

                $table->unsignedBigInteger('id_commune');
                $table->foreign('id_commune')->references('id')->on('commune');
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
        Schema::table('personne', function (Blueprint $table) {
            //
        });
    }
}
