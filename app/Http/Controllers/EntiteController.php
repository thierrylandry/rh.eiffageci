<?php

namespace App\Http\Controllers;

use App\Entite;
use Illuminate\Http\Request;

class EntiteController extends Controller
{
    //
    public function ajouter_entite()
    {
        $societes=Societe::all();
        $payss=Pays::all();
        return view('entite/ajouter_entite',compact('societes','payss'));
    }
    public function lister_entite()
    {
        $entites=Entite::all();
        return view('entite/lister_entite',compact('entites'));
    }
    public function detail_entite($id)
    {
        $entites=Entite::all();
        $entite=Entite::find($id);
        return view('entite/lister_entite',compact('entite','entites'));
    }
    public function modifier_entite(Request $request){

        $parameters=$request->except(['_token']);
        $libelle=$parameters['libelle'];
        $id_entite=$parameters['id_entite'];
        $entite= Entite::find($id_entite);
        $entite->libelle=$libelle;

        $entite->save();

        return redirect()->back()->with('success',"L'entité a été modifié avec succès");

    }
    public function enregistrer_entite(Request $request){

        $parameters=$request->except(['_token']);
        $libelle=$parameters['libelle'];
        $entite= new Entite();
        $entite->libelle=$libelle;

        $entite->save();

        return redirect()->back()->with('success',"Le partenaire a été ajouté avec succès");

    }

    public function supprimer_entite($id){


        $entite= Entite::find($id);


        $entite->delete();

        return redirect()->back()->with('success',"Le partenaire a été supprimé avec succès");

    }
}
