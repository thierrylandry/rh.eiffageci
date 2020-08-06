<?php

namespace App\Http\Controllers;

use App\Entite;
use App\Equipement;
use App\Equipement_securite;
use App\Personne;
use App\Personne_presente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EpiController extends Controller
{
    //
    public function gestion_epi()
    {
        $equipements = Equipement_securite::all();
        $entites= Entite::all();


        $personnesactives = Personne_presente::where('id_entite','=',Auth::user()->id_chantier_connecte)->get();
        $tab = Array();
        foreach($personnesactives as $pers):
            $tab[]=$pers->id;
        endforeach;
        $personnes= Personne::with("fonction","pays","societe")
            ->where('id_entite','=',Auth::user()->id_chantier_connecte)
            ->whereIn('id',$tab)
            ->orderBy('id', 'desc')
            ->paginate(2000);
        $entites= Entite::all();
//dd($personnes->first()->fonction()->first()->libelle);
        return view('epi/gestion_epi',compact('equipements','entites','personnes'));
    }
    public function save_epi(Request $request)
    {
        $parameters=$request->except(['_token']);

        $libelleequipement= $parameters['libelleequipement'];
        $qte_equipement= $parameters['qte_equipement'];

        $photo_equipement=$parameters['photo_equipement'];

        $equipement= new Equipement_securite();

        $equipement->libelle=$libelleequipement;
        $equipement->qte =$qte_equipement;
        if($request->file('photo_equipement')){
            $equipement->image=$equipement->libelle.'.'.$request->file('photo_equipement')->getClientOriginalExtension();

            $path = Storage::putFileAs(
                'images', $request->file('photo_equipement'), $equipement->libelle.'.'.$request->file('photo_equipement')->getClientOriginalExtension()
            );
        }else{
            $equipement->image="";
        }

        $equipement->save();

        return redirect()->back()->with('success',"L'équipement a été enregistré");

    }
}
