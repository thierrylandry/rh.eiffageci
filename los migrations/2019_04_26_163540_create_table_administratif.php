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
            $table->boolean('copie_extrait')->default('false');
            $table->boolean('copie_cni')->default('false');
            $table->boolean('photo_couleur')->default('false');
            $table->boolean('copie_extrait_descendants')->default('false');
            $table->boolean('copie_extrait_conjoint')->default('false');
            $table->boolean('copie_extrait_acte_mariage')->default('false');
            $table->boolean('copie_certificat_celeb_mariage')->default('false');
            $table->boolean('copie_cni_membre_famille')->default('false');
            $table->boolean('copie_diplome')->default('false');
            $table->boolean('copie_cv')->default('false');
            $table->boolean('copie_certif_travail')->default('false');
            $table->boolean('copie_bulletin_salaire')->default('false');
            $table->boolean('copie_attestation_stage')->default('false');
            $table->boolean('copie_attest_imm_cnps')->default('false');
            $table->boolean('justif_form_continue')->default('false');
            $table->boolean('rib')->default('false');
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
        Schema::dropIfExists('administratif');
    }
}
