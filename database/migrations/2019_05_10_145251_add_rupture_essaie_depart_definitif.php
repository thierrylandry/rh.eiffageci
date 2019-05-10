<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRuptureEssaieDepartDefinitif extends Migration
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
            $table->date('ruptureEssaie')->nullable();
            $table->string('departDefinitif')->nullable();
            $table->unsignedBigInteger('id_type_contrat')->nullable();
            $table->foreign('id_type_contrat')->references('id')->on('type_contrat');
            $table->unsignedBigInteger('id_personne')->nullable();
            $table->foreign('id_personne')->references('id')->on('personne');
            $table->unsignedBigInteger('id_service')->nullable();
            $table->foreign('id_service')->references('id')->on('services');
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
        });
    }
}
