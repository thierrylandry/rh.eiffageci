<?php

use Illuminate\Database\Seeder;

class ListeModifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $list_admin = new \App\Listmodifavenant();
        $list_admin->id=1;
        $list_admin->libelle="Service";
        $list_admin->save();
        $list_admin = new \App\Listmodifavenant();
        $list_admin->id=2;
        $list_admin->libelle="Fonction";
        $list_admin->save();
        $list_admin = new \App\Listmodifavenant();
        $list_admin->id=3;
        $list_admin->libelle="Type de contrat";
        $list_admin->save();
        $list_admin = new \App\Listmodifavenant();
        $list_admin->id=4;
        $list_admin->libelle="Date de fin";
        $list_admin->save();
        $list_admin = new \App\Listmodifavenant();
        $list_admin->id=5;
        $list_admin->libelle="Définition";
        $list_admin->save();
        $list_admin = new \App\Listmodifavenant();
        $list_admin->id=6;
        $list_admin->libelle="La catégorie";
        $list_admin->save();
        $list_admin = new \App\Listmodifavenant();
        $list_admin->id=7;
        $list_admin->libelle="Le régime";
        $list_admin->save();
        $list_admin = new \App\Listmodifavenant();
        $list_admin->id=8;
        $list_admin->libelle="Budget mensuell";
        $list_admin->save();
    }
}
