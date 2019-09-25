<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdresseToInvite extends Migration
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
            if (!Schema::hasColumn('invite', 'adresse')) {
                $table->string('adresse')->nullable();
            }
            if (!Schema::hasColumn('invite', 'whatsapp')) {
                $table->string('whatsapp')->nullable();
            }
            if (!Schema::hasColumn('invite', 'sattelitaire')) {
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
        Schema::table('invite', function (Blueprint $table) {
            //
            $table->removeColumn('adresse');
            $table->removeColumn('whatsapp');
            $table->removeColumn('sattelitaire');
        });
    }
}
