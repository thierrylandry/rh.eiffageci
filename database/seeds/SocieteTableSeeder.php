<?php

use App\Societe;
use Illuminate\Database\Seeder;

class SocieteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $societe = new Societe();
        $societe->id=1;
        $societe->libelleUnite="Expatriés PHB";
        $societe->save();

        $societe = new Societe();
        $societe->id=2;
        $societe->libelleUnite="Expatriés DIR. CI";
        $societe->save();

        $societe = new Societe();
        $societe->id=3;
        $societe->libelleUnite="Locaux EGC CI";
        $societe->save();

         $societe = new Societe();
        $societe->id=4;
        $societe->libelleUnite="SPIE Fondations";
        $societe->save();

        $societe = new Societe();
        $societe->id=5;
        $societe->libelleUnite="Sous - Traitant";
        $societe->save();
    }
}
