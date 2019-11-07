<?php

use Illuminate\Database\Seeder;

class EntiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $entite = new \App\Entite();
        $entite->id=1;
        $entite->libelle="PHB";
        $entite->save();

        $entite = new \App\Entite();
        $entite->id=2;
        $entite->libelle="SPIE FONDATIONS";
        $entite->save();

        $entite = new \App\Entite();
        $entite->id=3;
        $entite->libelle="DIRECTION CI";
        $entite->save();
    }
}
