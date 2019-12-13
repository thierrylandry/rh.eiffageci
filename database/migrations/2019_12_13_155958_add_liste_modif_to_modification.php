<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddListeModifToModification extends Migration
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
            $table->string("list_modif")->nullable();
            $table->integer("id_definition")->nullable();
            $table->integer("id_personne")->nullable();
            $table->integer("id_foction")->nullable();
            $table->integer("service")->nullable();
            $table->integer("id_users")->nullable();
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
            $table->removeColumn("list_modif");
        });
    }
}
