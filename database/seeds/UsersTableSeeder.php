<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role_personne = Role::where('name', 'Personnes')->first();
        $parametrage = Role::where('name', 'Parametrage')->first();

        $user = new User();
        $user->nom = 'administrateur';
        $user->prenoms = '';
        $user->email = 'admin@eiffage.com';
        $user->password = bcrypt('Administrateur');
        $user->save();

        $user->roles()->attach($role_personne);
        $user->roles()->attach($parametrage);
    }
}
