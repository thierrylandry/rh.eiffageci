<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServiceDescriptifFonctionToRecrutement extends Migration
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
            $table->bigInteger('id_service');
            $table->text('descriptifFonction')->nullable();
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
            $table->removeColumn('id_service');
        });
    }
}
