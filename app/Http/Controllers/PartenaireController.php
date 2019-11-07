<?php

namespace App\Http\Controllers;

use App\Entite;
use App\Partenaire;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    //
    public function ajouter_partenaire()
    {
        $societes=Societe::all();
        $payss=Pays::all();
        $entites= Entite::all();
        return view('personne/ajouter_partenaire',compact('societes','payss','entites'));
    }
    public function lister_partenaire()
    {
        $partenaires=Partenaire::all();
        $entites= Entite::all();
        return view('partenaire/lister_partenaire',compact('partenaires','entites'));
    }
    public function detail_partenaire($id)
    {
        $partenaires=Partenaire::all();
        $partenaire=Partenaire::find($id);
        $entites= Entite::all();
        return view('partenaire/lister_partenaire',compact('partenaires','partenaire','entites'));
    }
    public function modifier_partenaire(Request $request){

        $parameters=$request->except(['_token']);
        $libelle=$parameters['libelle'];
        $effectif=$parameters['effectif'];
        $femme=$parameters['femme'];
        $homme=$parameters['homme'];
        $id_partenaire=$parameters['id_partenaire'];
        $partenaire= Partenaire::find($id_partenaire);
        $partenaire->nom=$libelle;
        $partenaire->femme=$femme;
        $partenaire->homme=$homme;
        $partenaire->effectif=$effectif;

        $partenaire->save();

        return redirect()->back()->with('success',"Le partenaire a été modifié avec succès");

    }
    public function enregistrer_partenaire(Request $request){

        $parameters=$request->except(['_token']);
        $libelle=$parameters['libelle'];
        $effectif=$parameters['effectif'];
        $femme=$parameters['femme'];
        $homme=$parameters['homme'];
        $partenaire= new Partenaire();
        $partenaire->nom=$libelle;
        $partenaire->femme=$femme;
        $partenaire->homme=$homme;
        $partenaire->effectif=$effectif;

        $partenaire->save();

        return redirect()->back()->with('success',"Le partenaire a été ajouté avec succès");

    }

    public function supprimer_partenaire($id){


        $partenaire= Partenaire::find($id);


        $partenaire->delete();

        return redirect()->back()->with('success',"Le partenaire a été supprimé avec succès");

    }
}
