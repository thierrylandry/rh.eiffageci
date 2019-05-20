<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAdministratif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administratif', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_doc')->nullable();
            $table->integer('existance')->nullable();
            $table->string('pj')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('id_personne');
            $table->foreign('id_personne')->references('id')->on('personne');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administratif');
    }
}
