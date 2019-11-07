<?php

namespace App\Http\Controllers;

use App\Effectif;
use App\Entite;
use App\Partenaire;
use App\Personne;
use Illuminate\Http\Request;

class EffectifController extends Controller
{
    //

    public function effectif(){
        $effectifs = Partenaire::All();
        $entites= Entite::all();
        return view('effectif/effectif',compact('effectifs','entites'));
    }
    public function modifier_effectif(Request $request){

        $parameters=$request->except(['_token']);
        $effectif=$parameters['effectif'];
        $id_partenaire=$parameters['id_partenaire'];
        $partenaire= Effectif::find($id_partenaire);
        $partenaire->effectif=$effectif;

        $partenaire->save();

        return redirect()->route('effectif')->with('success',"Le partenaire a été modifié avec succès");

    }
}
