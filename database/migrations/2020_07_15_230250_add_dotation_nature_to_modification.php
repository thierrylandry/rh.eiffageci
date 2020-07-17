<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDotationNatureToModification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modification', function (Blueprint $table) {
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
        Schema::table('modification', function (Blueprint $table) {
            //
            $table->removeColumn('logement');
            $table->removeColumn('vehicule');
            $table->removeColumn('gratification');
        });
    }
}
