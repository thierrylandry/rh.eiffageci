<?php

namespace App\Http\Controllers;

use App\Assurance_maladie;
use App\Avantagedotation;
use App\Categorie;
use App\Debit_internet;
use App\Entite;
use App\Forfait;
use App\Recrutement;
use App\Services;
use App\Typecontrat;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RecrutementController extends Controller
{
    //
    public function ajouter_recrutement(){

        $entites = Entite::all();
        $typecontrats = Typecontrat::all();
       // $avantagedotations = Avantagedotation::all();
        $debit_internets=Debit_internet::all();
        $forfaits = Forfait::all();
        $assurance_maladies= Assurance_maladie::all();
        $categories = Categorie::all();
        $services = Services::all();
        return view('recrutements/ficheRecrutement',compact('entites','typecontrats','categories','debit_internets','forfaits','assurance_maladies','services'));
    }

    public function enregistrer_recrutement(Request $request ){

        $parameters=$request->except(['_token']);
        $posteAPouvoir=$parameters['posteAPouvoir'];
        $id_entite=$parameters['id_entite'];
        $id_service=$parameters['service'];
        $descriptifFonction=$parameters['descriptifFonction'];
        $competences=$parameters['competences'];
        $taches=$parameters['taches'];
        $id_type_contrat=$parameters['id_type_contrat'];
        $dateDebut=$parameters['dateDebut'];
        $dureeMission=$parameters['dureeMission'];
        $budgetMensuel=$parameters['budgetMensuel'];
        $id_categorie=$parameters['id_categorie'];
        $salaireBase=$parameters['salaireBase'];
        $surSalaire=$parameters['surSalaire'];
        $primeTp=$parameters['primeTp'];
        $totalBrute=$parameters['totalBrute'];
        $totalnet1part=$parameters['totalnet1part'];
        $totalnetparts=$parameters['totalnetparts'];
        $telephone_portable=$parameters['telephone_portable'];
        $forfait=$parameters['forfait'];
        $debit_internet=$parameters['debit_internet'];
        $assurance_maladie=$parameters['assurance_maladie'];

        $recruement = new Recrutement();
        $date= new DateTime(null);

        $recruement->posteAPouvoir=$posteAPouvoir;
        $recruement->id_entite=$id_entite;
        $recruement->id_service=$id_service;
        $recruement->descriptifFonction=$descriptifFonction;
        $recruement->competenceRecherche=json_encode($competences);
        $recruement->tache=json_encode($taches);
        $recruement->id_type_contrat=$id_type_contrat;
        $recruement->dateDebut=$dateDebut;
        $recruement->dureeMission=$dureeMission;
        $recruement->budgetMensuel=$budgetMensuel;
        $recruement->id_categorie=$id_categorie;
        $recruement->salaireBase=$salaireBase;
        $recruement->surSalaire=$surSalaire;
        $recruement->primeTp=$primeTp;
        $recruement->totalBrut=$totalBrute;
        $recruement->totalnet1part=$totalnet1part;
        $recruement->totalnetparts=$totalnetparts;
        $recruement->telephone_portable=$telephone_portable;
        $recruement->forfait=$forfait;
        $recruement->debit_internet=$debit_internet;
        $recruement->assurance_maladie=$assurance_maladie;
        $recruement->id_users=Auth::user()->id;
        $recruement->slug=Str::slug($posteAPouvoir.$id_entite.$date->format('dmYhis'));


        $recruement->save();

        return redirect()->route('utilisateur')->with('success',"La demande de recrutement a été  enregistrée avec succès");

    }

    public function lister_recrutement(){

        $recrutements= Recrutement::all();
        $entites = Entite::all();
        return view('recrutements/GestionRecrutement',compact('entites','recrutements'));
    }

    public function valider_recrutement(){

        $entites = Entite::all();
       // return view('recrutements/ficheRecrutement',compact('entites'));
    }

}
