<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDotationNatureToContrat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contrat', function (Blueprint $table) {
            //
            $table->string('logement')->nullable();
            $table->string('vehicule')->nullable();
            $table->string('gratification')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contrat', function (Blueprint $table) {
            //
            $table->removeColumn('logement');
            $table->removeColumn('vehicule');
            $table->removeColumn('gratification');
        });
    }
}
