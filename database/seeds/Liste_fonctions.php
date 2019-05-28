<?php

use Illuminate\Database\Seeder;

class Liste_fonctions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $list_admin = new \App\Fonction();
        $list_admin->id=1;
        $list_admin->libelle="Informaticien";
        $list_admin->save();
        $list_admin = new \App\Fonction();
        $list_admin->id=2;
        $list_admin->libelle="Responsable Travaux";
        $list_admin->save();

        $list_admin = new \App\Fonction();
        $list_admin->id=3;
        $list_admin->libelle="Responsable Achat";
        $list_admin->save();
        $list_admin = new \App\Fonction();
        $list_admin->id=4;
        $list_admin->libelle="Directeur";
        $list_admin->save();
        $list_admin = new \App\Fonction();
        $list_admin->id=5;
        $list_admin->libelle="Assistante Achat";
        $list_admin->save();
        $list_admin = new \App\Fonction();
        $list_admin->id=6;
        $list_admin->libelle="Gestionnaire";
        $list_admin->save();
        $list_admin = new \App\Fonction();
        $list_admin->id=7;
        $list_admin->libelle="Responsable HSE";
        $list_admin->save();
        $list_admin = new \App\Fonction();
        $list_admin->id=8;
        $list_admin->libelle="Stagiaire";
        $list_admin->save();
        $list_admin = new \App\Fonction();
        $list_admin->id=9;
        $list_admin->libelle="Gestionnaire Materiel";
        $list_admin->save();
        $list_admin = new \App\Fonction();
        $list_admin->id=10;
        $list_admin->libelle="Ingénieur Etude Méthode";
        $list_admin->save();
        $list_admin = new \App\Fonction();
        $list_admin->id=11;
        $list_admin->libelle="Assistante de Direction";
        $list_admin->save();
        $list_admin->id=700;
        $list_admin->libelle="Autre...";
        $list_admin->save();
    }
}
