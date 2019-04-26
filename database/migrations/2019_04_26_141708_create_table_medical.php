<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMedical extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicale', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('typevisite')->nullable();
            $table->string('vaccin')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('id_employe');
            $table->foreign('id_employe')->references('id')->on('employe');
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
        Schema::dropIfExists('medicale');
    }
}
