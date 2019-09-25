<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdresseToPersonne extends Migration
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

            if (!Schema::hasColumn('personne', 'adresse')) {
                $table->string('adresse')->nullable();
            }
            if (!Schema::hasColumn('personne', 'whatsapp')) {
                $table->string('whatsapp')->nullable();
            }
            if (!Schema::hasColumn('personne', 'sattelitaire')) {
                $table->string('sattelitaire')->nullable();
            }
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
            $table->removeColumn('adresse');
            $table->removeColumn('whatsapp');
            $table->removeColumn('sattelitaire');
        });
    }
}
