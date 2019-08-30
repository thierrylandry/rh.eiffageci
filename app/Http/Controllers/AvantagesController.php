<?php

namespace App\Http\Controllers;

use App\Equipement;
use App\Type_equipement;
use Illuminate\Http\Request;

class AvantagesController extends Controller
{
    //

    public function avantages(){

        return view('avantages/avantages');
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
    public function updateMateriel($id){
        $equipement = Equipement::find($id);
        $type_equipements=Type_equipement::all();
        $equipements=Equipement::all();
        return view('avantages/gestionmateriel',compact('type_equipements','equipements','equipement'));
    }
    public function supprimer_equipement($id){
        $equipement = Equipement::find($id);
        $equipement->delete();

        return redirect()->back()->with('success',"L'équipement a été supprimé  avec succès");
    }
}
