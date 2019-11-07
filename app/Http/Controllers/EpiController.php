<?php

namespace App\Http\Controllers;

use App\Entite;
use App\Equipement;
use App\Equipement_securite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EpiController extends Controller
{
    //
    public function gestion_epi()
    {
        $equipements = Equipement_securite::all();
        $entites= Entite::all();
        return view('epi/gestion_epi',compact('equipements','entites'));
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
