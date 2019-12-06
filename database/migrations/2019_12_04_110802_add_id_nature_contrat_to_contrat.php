<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdNatureContratToContrat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('contrat','id_nature_contrat')){
            Schema::table('contrat', function (Blueprint $table) {
                //
                $table->unsignedBigInteger('id_nature_contrat')->nullable();
                $table->foreign('id_nature_contrat')->references('id')->on('nature_contrat');
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
        Schema::table('contrat', function (Blueprint $table) {
            //
            $table->removeColumn('id_nature_contrat');
        });
    }
}
