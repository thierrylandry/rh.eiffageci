<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFonctionNationaliteToInvite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invite', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('invite', 'fonction')) {
                $table->string('fonction')->nullable();
            }
            if (!Schema::hasColumn('invite', 'nationalite')) {
                $table->string('nationalite')->nullable();
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
        Schema::table('invite', function (Blueprint $table) {
            //
            $table->removeColumn('fonction');
            $table->removeColumn('nationalite');
        });
    }
}
