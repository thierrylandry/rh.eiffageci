<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdUsersToPersonne extends Migration
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
            $table->integer('id_createur');
            $table->integer('id_modificateur');
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
            $table->dropColumn('id_createur');
            $table->dropColumn('id_modificateur');
        });
    }
}
