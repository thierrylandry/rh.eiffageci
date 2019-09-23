<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEtatToEquipement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('equipements', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('equipements', 'etat')) {
                //
                $table->integer('etat')->nullable()->default(1);
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
        Schema::table('equipements', function (Blueprint $table) {
            //
            $table->removeColumn('etat');
        });
    }
}
