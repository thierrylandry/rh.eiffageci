<?php

namespace App\Http\Controllers;

use App\Fonction;
use Illuminate\Http\Request;

class FonctionsController extends Controller
{
    //
    public function fonctions(){

        $fonctions = Fonction::all();

        return view('fonctions/liste_fonction',compact('fonctions'));
    }
    public function save_fonction(Request $request){
        $parameters=$request->except(['_token']);

        $libelle=$parameters["libelle"];
      //  $fonctions = Fonction::all();

        $fonction=new Fonction();
        $fonction->libelle=$libelle;
        $fonction->save();
        return redirect()->route('fonctions')->with('success',"La fonction   a été ajoutée avec succès");
    }
    public function modifier_fonction(Request $request){
        $parameters=$request->except(['_token']);
        $libelle=$parameters["libelle"];
        //  $fonctions = Fonction::all();
        $id=$parameters["id"];
        $fonction= Fonction::find($id);
        $fonction->libelle=$libelle;
        $fonction->save();

        return redirect()->route('fonctions')->with('success',"La fonction   a été modifiées avec succès");
    }
    public function pmodifier_fonction($id){

        $fonction=Fonction::find($id);
        $fonctions = Fonction::all();

        return view('fonctions/liste_fonction',compact('fonctions','fonction'));
    }
    public function supprimer_fonction($id){

        $fonction=Fonction::find($id);

        $fonction->delete();
        return redirect()->route('fonctions')->with('success',"La fonction  a été supprimées avec succès");
    }
}