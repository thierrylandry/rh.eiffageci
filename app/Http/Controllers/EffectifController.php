<?php

namespace App\Http\Controllers;

use App\Effectif;
use App\Personne;
use Illuminate\Http\Request;

class EffectifController extends Controller
{
    //

    public function effectif(){
        $effectifs = Effectif::All();
        $effEiffage = Personne::where('entite','=',1)->get();
        //concernant php
        $effectif_phb_homme = Personne::where([
                                                ['entite','=',1],
                                                ['sexe','=','M']

        ])->get();
        $effectif_phb_femme = Personne::where([
            ['entite','=',1],
            ['sexe','=','F']

        ])->get();
        $effectif_phb_locaux = Personne::where([
            ['entite','=',1],
            ['id_unite','=','1']

        ])->get();
        $effectif_phb_exp = Personne::where([
            ['entite','=',1],
            ['id_unite','=','2']

        ])->get();
        //concernant dir ci
        $effectif_dir = Personne::where([
            ['entite','=',3]

        ])->get();
        $effectif_dir_homme = Personne::where([
            ['entite','=',3],
            ['sexe','=','M']

        ])->get();
        $effectif_dir_femme = Personne::where([
            ['entite','=',3],
            ['sexe','=','F']

        ])->get();
        $effectif_dir_locaux = Personne::where([
            ['entite','=',3],
            ['id_unite','=','1']

        ])->get();
        $effectif_dir_exp = Personne::where([
            ['entite','=',3],
            ['id_unite','=','2']

        ])->get();

        //concernant spie fondation
        $effspietotal = Personne::where('entite','=',2)->get();
        $effectif_spie_homme = Personne::where([
            ['entite','=',2],
            ['sexe','=','M']

        ])->get();
        $effectif_spie_femme = Personne::where([
            ['entite','=',2],
            ['sexe','=','F']

        ])->get();
        $effectif_spie_locaux = Personne::where([
            ['entite','=',2],
            ['id_unite','=','1']

        ])->get();
        $effectif_spie_exp = Personne::where([
            ['entite','=',2],
            ['id_unite','=','2']

        ])->get();


        return view('effectif/effectif',compact('effectifs','effectif_dir','effEiffage','effectif_phb_homme','effectif_phb_femme','effectif_phb_locaux','effectif_phb_exp','effectif_dir_homme','effectif_dir_femme','effectif_dir_locaux','effectif_dir_exp','effspietotal','effectif_spie_homme','effectif_spie_femme','effectif_spie_locaux','effectif_spie_exp'));
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
