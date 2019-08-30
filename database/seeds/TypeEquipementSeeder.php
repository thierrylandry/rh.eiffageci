<?php

use Illuminate\Database\Seeder;

class TypeEquipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $type = new \App\Type_equipement();
        $type->id=1;
        $type->libelle="ECRAN";
        $type->libelleCode="Numero de serie";
        $type->image="";
        $type->save();

        $type = new \App\Type_equipement();
        $type->id=2;
        $type->libelle="ORDINATEUR";
        $type->libelleCode="PA";
        $type->image="";
        $type->save();

        $type = new \App\Type_equipement();
        $type->id=3;
        $type->libelle="STATION";
        $type->libelleCode="";
        $type->image="";
        $type->save();

        $type = new \App\Type_equipement();
        $type->id=4;
        $type->libelle="VEHICULE";
        $type->libelleCode="Immatriculation";
        $type->image="";
        $type->save();

        $type = new \App\Type_equipement();
        $type->id=5;
        $type->libelle="PUCE";
        $type->libelleCode="Numero";
        $type->image="";
        $type->save();

        $type = new \App\Type_equipement();
        $type->id=6;
        $type->libelle="DOMINO";
        $type->libelleCode="Numero";
        $type->image="";
        $type->save();
    }
}
