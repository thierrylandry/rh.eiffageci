<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAbsence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absence', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('jour')->nullable();
            $table->date('debut')->nullable();
            $table->date('fin')->nullable();
            $table->date('reprise')->nullable();
            $table->date('date')->nullable();
            $table->integer('etat')->nullable();
            $table->integer('id_personne')->nullable();
            //$table->foreign('id_personne')->references('id')->on('personne');
            $table->integer('id_users')->nullable();
            $table->foreign('id_users')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absence');
    }
}
