<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdPersonneToadministratif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administratif', function (Blueprint $table) {
            //
            $table->foreign('id_personne')->references('id')->on('personne');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('administratif', function (Blueprint $table) {
            //
            $table->removeColumn('id_personne');
        });
    }
}
