<?php

use Illuminate\Database\Seeder;

class Liste_definitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //« Cadre », « Agent de Maitrise », « Employé » et « Ouvrier »
        $list_admin = new \App\Definition();
        $list_admin->id=1;
        $list_admin->libelle="Cadre";
        $list_admin->save();
        $list_admin = new \App\Definition();
        $list_admin->id=2;
        $list_admin->libelle="Agent de Maitrise";
        $list_admin->save();
        $list_admin = new \App\Definition();
        $list_admin->id=3;
        $list_admin->libelle="Employé";
        $list_admin->save();
        $list_admin = new \App\Definition();
        $list_admin->id=4;
        $list_admin->libelle="Ouvrier";
        $list_admin->save();
    }
}
