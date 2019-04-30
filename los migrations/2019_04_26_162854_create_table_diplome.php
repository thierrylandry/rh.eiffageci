<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDiplome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diplome', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle');
            $table->text('detail');
            $table->unsignedBigInteger('id_typediplome');
            $table->foreign('id_typediplome')->references('id')->on('typediplome');
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
        Schema::dropIfExists('diplome');
    }
}
