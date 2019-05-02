<?php

namespace App\Http\Controllers;

use App\Personne;
use App\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PersonneController extends Controller
{
    //
    public function ajouter_personne()
    {
        $societes=Societe::all();
        return view('personne/ajouter_personne',compact('societes'));
    }
    public function lister_personne()
    {
$personnes= Personne::all();
        $societes=Societe::all();
        return view('personne/lister_personne',compact('personnes','societes'));
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
        $personne->situationmat=$sit;
        $personne->fonction=$fonction;
        $personne->service=$service;
        $personne->entite=$entite;
        $personne->id_societe=$societe;
        $personne->pointure=$pointure;
        $personne->slug=Str::slug($nom.$prenom.$date->format('dmYhis'));
        if($request->file('photo')){
            $personne->image=$personne->slug.'.'.$request->file('photo')->getClientOriginalExtension();

            $path = Storage::putFileAs(
                'images', $request->file('photo'), $personne->slug.'.'.$request->file('photo')->getClientOriginalExtension()
            );
        }else{
            $personne->image="";
        }

        $personne->save();

        return redirect()->route('Ajouter_personne')->with('success',"La personne a été ajoutée avec succès");

    }
    public function supprimer_personne($slug)
    {
        $personne= Personne::where('slug','=',$slug)->get()->first();
        if($personne->delete()){
            return redirect()->route('lister_personne')->with('success',"La suppression a reussi");
        }else{
            return redirect()->route('lister_personne')->with('error',"La suppression a échoué");
        }

    }
    public function detail_personne($slug)
    {
        $societes=Societe::all();
        $personne= Personne::where('slug','=',$slug)->get()->first();
        return view('personne/detail_personne',compact('personne','societes'));
    }
    public function modifier_personne(Request $request){

        $parameters=$request->except(['_token']);
        $nom=$parameters['nom'];
        $slug=$parameters['slug'];
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


        $personne= Personne::where('slug','=',$slug)->get()->first();
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
        $personne->situationmat=$sit;
        $personne->fonction=$fonction;
        $personne->service=$service;
        $personne->entite=$entite;
        $personne->id_societe=$societe;
        $personne->pointure=$pointure;
        $personne->slug=Str::slug($nom.$prenom.$date->format('dmYhis'));
        if($request->file('photo')){
            $personne->image=$personne->slug.'.'.$request->file('photo')->getClientOriginalExtension();

            $path = Storage::putFileAs(
                'images', $request->file('photo'), $personne->slug.'.'.$request->file('photo')->getClientOriginalExtension()
            );
        }else{
        }

        $personne->save();

        return redirect()->route('lister_personne')->with('success',"La personne a été mise à jour avec succès");

    }

}
