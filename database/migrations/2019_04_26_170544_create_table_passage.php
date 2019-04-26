<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePassage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('dateArrive');
            $table->date('dateDepart');
            $table->unsignedBigInteger('id_invite');
            $table->foreign('id_invite')->references('id')->on('invite');
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
        Schema::dropIfExists('passage');
    }
}
