<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_Admin = new Role();
        $role_Admin->name="Parametrage";
        $role_Admin->description="PARAMETRAGE";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Gestion_utilisateur";
        $role_Admin->description="GESTION UTILISATEUR";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Personnes";
        $role_Admin->description="PERSONNES";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Invites";
        $role_Admin->description="INVITES";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Salaires";
        $role_Admin->description="SALAIRES";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Effectifs";
        $role_Admin->description="EFFECTIFS";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Conges";
        $role_Admin->description="CONGES";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Sanctions";
        $role_Admin->description="SANCTIONS";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Etats";
        $role_Admin->description="ETATS";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Recrutements";
        $role_Admin->description="RECRUTEMENTS";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Gestion_recrutement";
        $role_Admin->description="GESTION RECRUTEMENT";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Demande_recrutement";
        $role_Admin->description="DEMANDE DE RECRUTEMENT";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Validation_recrutement";
        $role_Admin->description="VALIDATION DE RECRUTEMENT";
        $role_Admin->save();

        $role_Admin = new Role();
        $role_Admin->name="Recrutements";
        $role_Admin->description="Recrutements";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Chef_de_projet";
        $role_Admin->description="CHEF DE PROJET";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Chef_de_service";
        $role_Admin->description="CHEF DE SERVICE";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Ressource_humaine";
        $role_Admin->description="RESSOURCE HUMAINE";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="Assitante_direction";
        $role_Admin->description="ASSISTANTE DE DIRECTION";
        $role_Admin->save();
        $role_Admin = new Role();
        $role_Admin->name="RRH";
        $role_Admin->description="RESPONSABLE DE RESSOURCES HUMAINES";
        $role_Admin->save();

    }
}
