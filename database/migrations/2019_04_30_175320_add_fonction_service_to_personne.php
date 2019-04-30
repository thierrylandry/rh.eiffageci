<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFonctionServiceToPersonne extends Migration
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
            $table->string('fonction');
            $table->string('service');
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
            $table->removeColumn('fonction');
            $table->removeColumn('service');
        });
    }
}
