<?php

namespace App\Http\Controllers;

use App\Invite;
use App\Passage;
use Illuminate\Http\Request;

class InviterController extends Controller
{
    //
public function invite(){
    $invites= Invite::all();



    return view('invite/gestion_invite',compact('invites'));
}
public function save_invite( Request $request){
    $parameters=$request->except(['_token']);
    $nom=$parameters['nom'];
    $prenom=$parameters['prenom'];
    $entreprise=$parameters['entreprise'];
    $surete=$parameters['surete'];
    $contact=$parameters['contact'];
    $email=$parameters['email'];

    $inviete= new Invite();

    $inviete->nom=$nom;
    $inviete->prenoms=$prenom;
    $inviete->entreprise=$entreprise;
    $inviete->surete=$surete;
    $inviete->contact=$contact;
    $inviete->email=$email;
    $inviete->save();
    return redirect()->route('invite')->with('success',"Invité ajouté avec succès");
}
public function enregistrer_passage( Request $request){
    $parameters=$request->except(['_token']);
    $id_invite=$parameters['id_invite'];
    $dateArrive=$parameters['dateArrive'];
    $dateDepart=$parameters['dateDepart'];
    $objectif=$parameters['objectif'];


    $invite= Invite::find($id_invite);
    $passage= new Passage();

    $passage->id_invite=$id_invite;
    $passage->dateArrive=$dateArrive;
    $passage->dateDepart=$dateDepart;
    $passage->objectif=$objectif;
    $passage->save();
    return redirect()->route('passage_invite')->with(['success' => "Invité ajouté avec succès",'invite'=>$invite]);
}
public function modifier_invite( Request $request){
    $parameters=$request->except(['_token']);
    $id=$parameters['id'];
    $nom=$parameters['nom'];
    $prenom=$parameters['prenom'];
    $entreprise=$parameters['entreprise'];
    $surete=$parameters['surete'];
    $contact=$parameters['contact'];
    $email=$parameters['email'];

    $inviete=  Invite::find($id);

    $inviete->nom=$nom;
    $inviete->prenoms=$prenom;
    $inviete->entreprise=$entreprise;
    $inviete->surete=$surete;
    $inviete->contact=$contact;
    $inviete->email=$email;
    $inviete->save();
    return redirect()->route('invite')->with('success',"Invité ajouté avec succès");
}
public function pmodifier_invite($id){

    $invite= Invite::find($id);
    $invites= Invite::all();



    return view('invite/gestion_invite',compact('invites','invite'));
}
public function passage_invite($id){

    $invite= Invite::find($id);
    //$passages= $invite->comments();



    return view('invite/gestion_passage',compact('passages','invite'));
}
public function supprimer_invite($id){

    $invite= Invite::find($id);

    $invite->delete();


    return redirect()->route('invite')->with('success',"Invité supprimé avec succès");
}
}
