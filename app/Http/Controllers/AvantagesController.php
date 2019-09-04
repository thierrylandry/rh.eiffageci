<?php

namespace App\Http\Controllers;

use App\Avantages;
use App\Equipement;
use App\Personne;
use App\Type_equipement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AvantagesController extends Controller
{
    //

    public function avantages(){

        $equipements=Equipement::where('etat','=',1)->get();
       // dd($equipements);
        $employes=Personne::with("fonction","pays","societe")
            ->where('entite','=',1)
            ->orWhere('entite','=',2)->get();
       // dd($employes);
        $avantages= Avantages::orderBy('created_at','DESC')->get();
      // dd($avantages[0]->equipement->);
        return view('avantages/avantages',compact('equipements','employes','avantages'));
    }

    public function save_avantage(Request $request){
        $parameters=$request->except(['_token']);
        $equipement_id=$parameters['equipement_id'];
        $employe=$parameters['employe'];

        $avantage = new Avantages();
        $avantage->dateDotation=date("m.d.y");
       // $avantage->retour=$TypePC;
        $avantage->id_equippements=$equipement_id;
        $avantage->id_personne=$employe;

        $avantage->save();

        $equipement =  Equipement::find($avantage->id_equippements);
        $equipement->etat=0;
        $equipement->save();
        return redirect()->back()->with('success',"L'équipement a été attribué avec succès");
    }
    public function gestionMateriel(){

        $type_equipements=Type_equipement::all();
        $equipements=Equipement::all();
        return view('avantages/gestionmateriel',compact('type_equipements','equipements'));
    }
    public function save_materiel(Request $request){
        $parameters=$request->except(['_token']);
        $code=$parameters['code'];
        $TypePC=$parameters['TypePC'];
        $saccoche=$parameters['saccoche'];
        $id_type_equipement=$parameters['id_type_equipement'];

        $equipement = new Equipement();
        $equipement->code=$code;
        $equipement->TypePC=$TypePC;
        $equipement->saccoche=$saccoche;
        $equipement->id_type_equipement=$id_type_equipement;
        $equipement->save();
        return redirect()->route('gestionmateriel')->with('success',"L'équipement a été ajouté avec succès");
    }

    public function modifier_equipement(Request $request){
        $parameters=$request->except(['_token']);
        $id=$parameters['id'];
        $code=$parameters['code'];
        $TypePC=$parameters['TypePC'];
        $saccoche=$parameters['saccoche'];
        $id_type_equipement=$parameters['id_type_equipement'];

        $equipement = Equipement::find($id);
        $equipement->code=$code;
        $equipement->TypePC=$TypePC;
        $equipement->saccoche=$saccoche;
        $equipement->id_type_equipement=$id_type_equipement;
        $equipement->save();
        return redirect()->back()->with('success',"L'équipement a été mis à jour  avec succès");
    }

    public function retourner_avantage(Request $request){
        $parameters=$request->except(['_token']);
        $id=$parameters['id'];
        //dd($id);
        $retour=$parameters['retour'];

        $avantage = Avantages::find($id);
       // dd($avantage);
        $avantage->retour=$retour;
        $avantage->save();
        $equipement = Equipement::find($avantage->id_equippements);
        $equipement->etat=1;
        $equipement->save();
        return redirect()->back()->with('success',"L'équipement a été retourné  avec succès");
    }
    public function updateMateriel($id){
        $equipement = Equipement::find($id);
        $type_equipements=Type_equipement::all();
        $equipements=Equipement::all();
        return view('avantages/gestionmateriel',compact('type_equipements','equipements','equipement'));
    }
    public function updateAvantage($id){
        $avantage = Avantages::find($id);

        $equipements=Equipement::where('etat','=',1)->get();
        // dd($equipements);
        $employes=Personne::with("fonction","pays","societe")
            ->where('entite','=',1)
            ->orWhere('entite','=',2)->get();
        // dd($employes);
        $avantages= Avantages::orderBy('created_at','DESC')->get();
        return view('avantages/avantages',compact('equipements','employes','avantages','avantage'));
    }
    public function supprimer_equipement($id){
        $equipement = Equipement::find($id);
        $equipement->delete();

        return redirect()->back()->with('success',"L'équipement a été supprimé  avec succès");
    }
    public function supprimer_avantage($id){
        $avantage = Avantages::find($id);

        if($avantage->retour=!null){
            $equipement= Equipement::find($avantage->id_equippements);
            $equipement->etat=1;
            $equipement->save();
        }
        $avantage->delete();


        return redirect()->back()->with('success',"L'avantages a été supprimé  avec succès");
    }
    public function historique_passages($id){
        $avantages = Avantages::where('id_equippements','=',$id)
                                ->join('personne','avantages.id_personne','=','personne.id')->get();
        return $avantages;
    }
}
