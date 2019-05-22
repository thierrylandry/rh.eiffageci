<?php

namespace App\Http\Controllers;

use App\Partenaire;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    //
    public function ajouter_partenaire()
    {
        $societes=Societe::all();
        $payss=Pays::all();
        return view('personne/ajouter_partenaire',compact('societes','payss'));
    }
    public function lister_partenaire()
    {
        $partenaires=Partenaire::all();
        return view('partenaire/lister_partenaire',compact('partenaires'));
    }
    public function detail_partenaire($id)
    {
        $partenaire=Partenaire::find($id);
        return view('partenaire/detail_partenaire',compact('partenaire'));
    }
    public function modifier_partenaire(Request $request){

        $parameters=$request->except(['_token']);
        $nom=$parameters['nom'];
        $effectif=$parameters['effectif'];
        $id_partenaire=$parameters['id_partenaire'];
        $partenaire= Partenaire::find($id_partenaire);
        $partenaire->nom=$nom;
        $partenaire->effectif=$effectif;

        $partenaire->save();

        return redirect()->route('lister_partenaire')->with('success',"Le partenaire a été modifié avec succès");

    }
}
