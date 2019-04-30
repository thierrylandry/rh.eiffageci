<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRhToPersonne extends Migration
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
            $table->string('rh');

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
            $table->removeColumn('rh');
            $table->removeColumn('fonction');
            $table->removeColumn('service');
        });
    }
}
