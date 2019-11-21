<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAvantagedotation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avantagedotation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('telephonePortable')->defaut(false);
            $table->string('forfait');
            $table->string('debitInternet');
            $table->string('assuranceMaladie');
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
        Schema::dropIfExists('avantagedatation');
    }
}
