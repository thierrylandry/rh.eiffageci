<?php

namespace App\Http\Controllers;

use App\Entite;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function utilisateur(){
        $utilisateurs= User::all();
        $roles=  Role::all();
        $entites = Entite::all();
        return view('utilisateurs/utilisateurs',compact('utilisateurs','roles','entites'));

    }
    public function modifier_utilisateur($id){
        $utilisateur= User::find($id);
        $utilisateurs= User::all();
        $roles=  Role::all();
        $entites = Entite::all();
        return view('utilisateurs/utilisateurs',compact('utilisateurs','utilisateur','roles','entites'));

    }
    public function supprimer_utilisateur($id){
        $utilisateur= User::find($id);
        $utilisateur->delete();

        return redirect()->route('utilisateur')->with('success',"L'utilisateur a été supprimer avec succès");

    }
    public function modifier_user(Request $request){

        $parameters=$request->except(['_token']);
        $id=$parameters['id'];
        $nom=$parameters['nom'];
        $prenom=$parameters['prenom'];
        $email=$parameters['email'];
        $mdp=$parameters['password'];


        $utilisateur =  User::find($id);
        $utilisateur->nom=$nom;
        $utilisateur->prenoms=$prenom;
        $utilisateur->email=$email;
        if(Hash::needsRehash($mdp)){

            $utilisateur->password =Hash::make($mdp);
        }
        if(isset($request->all()['photo'])){
            $data['photo']=$request->all()['photo'];
            $data['instension']=$request->file('photo')->getClientOriginalExtension();
            $path = Storage::putFileAs(
                'images/users', $request->file('photo'), $nom.$prenom.'.'.$request->file('photo')->getClientOriginalExtension()
            );
            $utilisateur->photo=$nom.$prenom.'.'.$data['instension'];
        }else{

        }


        $utilisateur->save();
        $roles=$parameters['roles'];
        $utilisateur->roles()->detach();
        foreach ($roles as $role):
            $utilisateur->roles()->attach(Role::where('name',$role)->first());
        endforeach;

        return redirect()->route('utilisateur')->with('success',"L'utilisateur a été modifier avec succès");
    }
    public function save_user(Request $request){

        $parameters=$request->except(['_token']);
        $nom=$parameters['nom'];
        $prenom=$parameters['prenom'];
        $email=$parameters['email'];
        $mdp=$parameters['password'];


        $utilisateur = new User();
        $utilisateur->nom=$nom;
        $utilisateur->prenoms=$prenom;
        $utilisateur->email=$email;
        //$utilisateur->password=$mdp;
        if(Hash::needsRehash($mdp)){

            $utilisateur->password =Hash::make($mdp);
        }
        if(isset($request->all()['photo'])){
            $data['photo']=$request->all()['photo'];
            $data['instension']=$request->file('photo')->getClientOriginalExtension();
            $path = Storage::putFileAs(
                'images/users', $request->file('photo'), $nom.$prenom.'.'.$request->file('photo')->getClientOriginalExtension()
            );
            $utilisateur->photo=$nom.$prenom.'.'.$data['instension'];
        }else{

        }


        $utilisateur->save();
        $roles=$parameters['roles'];
        $utilisateur->roles()->detach();
        foreach ($roles as $role):
            $utilisateur->roles()->attach(Role::where('name',$role)->first());
        endforeach;
        return redirect()->route('utilisateur')->with('success',"L'utilisateur a été crée avec succès");

    }
}
