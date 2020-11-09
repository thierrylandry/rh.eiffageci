<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRepresantToProjet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entite', function (Blueprint $table) {
            //
            $table->string('representant')->nullable();
            $table->string('genre')->nullable();
            $table->string('entreprise')->nullable();
            $table->string('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entite', function (Blueprint $table) {
            //
            $table->removeColumn('representant');
            $table->removeColumn('genre');
            $table->removeColumn('entreprise');
            $table->removeColumn('description');
        });
    }
}
