<?php

namespace App\Http\Controllers;

use App\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PersonneController extends Controller
{
    //
    public function ajouter_personne()
    {

        return view('personne/ajouter_personne');
    }
    public function lister_personne()
    {

        return view('personne/lister_personne');
    }
    public function enregistrer_personne(Request $request){

        $parameters=$request->except(['_token']);
        $nom=$parameters['nom'];
        $prenom=$parameters['prenom'];
        $datenaissance=$parameters['datenaissance'];
        $sexe=$parameters['sexe'];
        $nationnalite=$parameters['nationnalite'];
        $sit=$parameters['sit'];
        $nb_enf=$parameters['nb_enf'];
        $email=$parameters['email'];
        $contact=$parameters['contact'];
        $cnps=$parameters['cnps'];
        $rib=$parameters['rib'];
        $rh=$parameters['rh'];
        $fonction=$parameters['fonction'];
        $service=$parameters['service'];
        $entite=$parameters['entite'];
        $societe=$parameters['societe'];
        $pointure=$parameters['pointure'];

        $date= new \DateTime(null);


        $personne= new Personne();
        $personne->nom=$nom;
        $personne->prenom=$prenom;
        $personne->datenaissance=$datenaissance;
        $personne->sexe=$sexe;
        $personne->nationalite=$nationnalite;
        $personne->matrimonial=$sit;
        $personne->enfant=$nb_enf;
        $personne->email=$email;
        $personne->contact=$contact;
        $personne->cnps=$cnps;
        $personne->rib=$rib;
        $personne->rh=$rh;
        $personne->fonction=$fonction;
        $personne->service=$service;
        $personne->entite=$entite;
        $personne->id_societe=$societe;
        $personne->pointure=$pointure;
        $personne->slug=Str::slug($nom.$prenom.$date->format('dmYhis'));
        $personne->image=$personne->slug.'.'.$request->file('photo')->getClientOriginalExtension();

        $path = Storage::putFileAs(
            'images', $request->file('photo'), $personne->slug.'.'.$request->file('photo')->getClientOriginalExtension()
        );
        $personne->save();

        return redirect()->route('Ajouter_personne')->with('success',"La personne a été ajoutée avec succès");

    }
}
