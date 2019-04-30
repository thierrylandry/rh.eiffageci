<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEmploye extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('prenoms');
            $table->date('datenaissance');
            $table->string('sexe');
            $table->string('nationnalite');
            $table->string('enfant')->nullable();
            $table->string('cnps')->nullable();
            $table->string('rib')->nullable();
            $table->string('rhesusSang')->nullable();
            $table->unsignedBigInteger('id_administratif');
            $table->foreign('id_administratif')->references('id')->on('administratif');
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
        Schema::dropIfExists('employe');
    }
}
