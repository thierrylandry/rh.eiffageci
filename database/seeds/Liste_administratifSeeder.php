<?php

use Illuminate\Database\Seeder;

class Liste_administratifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $list_admin = new \App\Liste_Administratif();
        $list_admin->id=1;
        $list_admin->libelle="1 copie originale de l'extrait de naissance";
        $list_admin->save();
        $list_admin = new \App\Liste_Administratif();
        $list_admin->id=2;
        $list_admin->libelle="1 photocopie de la carte nationnale d'identité";
        $list_admin->save();
        $list_admin = new \App\Liste_Administratif();
        $list_admin->id=3;
        $list_admin->libelle="2 photo  d'identité couleur du même tirage";
        $list_admin->save();
        $list_admin = new \App\Liste_Administratif();
        $list_admin->id=4;
        $list_admin->libelle="1 photocopie de l'extrait d'acte de naissance des descendants";
        $list_admin->save();
        $list_admin = new \App\Liste_Administratif();
        $list_admin->id=5;
        $list_admin->libelle="1 photocopie de l'extrait d'acte de naissance du conjoint";
        $list_admin->save();
        $list_admin = new \App\Liste_Administratif();
        $list_admin->id=6;
        $list_admin->libelle="1 photocopie de l'extrait d'acte de mariage";
        $list_admin->save();
        $list_admin = new \App\Liste_Administratif();
        $list_admin->id=7;
        $list_admin->libelle="1 photo d'identité récente des membres de sa famille";
        $list_admin->save();        $list_admin = new \App\Liste_Administratif();
        $list_admin->id=8;
        $list_admin->libelle="1 photocopie du ou des diplômes";
        $list_admin->save();
        $list_admin = new \App\Liste_Administratif();
        $list_admin->id=9;
        $list_admin->libelle="1 copie du curriculum vitaé actualisé";
        $list_admin->save();
        $list_admin = new \App\Liste_Administratif();
        $list_admin->id=10;
        $list_admin->libelle="1 photocopie du ou des certificats de travail (personne en activité ou ayant déjà travaillé)";
        $list_admin->save();
        $list_admin = new \App\Liste_Administratif();
        $list_admin->id=11;
        $list_admin->libelle="1 copie du dernier bulletin de salaire";
        $list_admin->save();
        $list_admin = new \App\Liste_Administratif();
        $list_admin->id=12;
        $list_admin->libelle="1 copie des attestations de stage";
        $list_admin->save();
        $list_admin->id=13;
        $list_admin->libelle="1 copie de l'attestations d'immatriculation CNPS ou numéro sur support";
        $list_admin->save();
        $list_admin->id=14;
        $list_admin->libelle="les justificatifs de formation continue ou d'apprentissage";
        $list_admin->save();
        $list_admin->id=15;
        $list_admin->libelle="1 relevé d'identité bancaire (RIB)";
        $list_admin->save();


    }
}
