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
        $societe->libellesoc="Expatriés PHB";
        $societe->save();

        $societe = new Societe();
        $societe->id=2;
        $societe->libellesoc="Expatriés DIR. CI";
        $societe->save();

        $societe = new Societe();
        $societe->id=3;
        $societe->libellesoc="Locaux EGC CI";
        $societe->save();

         $societe = new Societe();
        $societe->id=4;
        $societe->libellesoc="SPIE Fondations";
        $societe->save();

        $societe = new Societe();
        $societe->id=5;
        $societe->libellesoc="Sous - Traitant";
        $societe->save();
    }
}
