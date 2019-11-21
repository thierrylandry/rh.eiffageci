<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdEntiteToRecrutement extends Migration
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
            $table->unsignedBigInteger('id_entite')->nullable();
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
            $table->removeColumn('id_entite');
        });
    }
}
