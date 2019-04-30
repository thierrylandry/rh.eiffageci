<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdSocieteToSociete extends Migration
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
            $table->unsignedBigInteger('id_societe')->nullable();
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
            $table->dropColumn('personne');
        });
    }
}
