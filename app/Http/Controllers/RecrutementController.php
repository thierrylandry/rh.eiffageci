<?php

namespace App\Http\Controllers;

use App\Assurance_maladie;
use App\Avantagedotation;
use App\Categorie;
use App\Debit_internet;
use App\Definition;
use App\Entite;
use App\Forfait;
use App\Recrutement;
use App\Services;
use App\Typecontrat;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Metier\Json\Element;

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
        $definitions = Definition::all();
        $recrutements = Recrutement::where('id_service','=',Auth::user()->service->id)->get();
        return view('recrutements/ficheRecrutement',compact('entites','typecontrats','definitions','categories','debit_internets','forfaits','assurance_maladies','services','recrutements'));
    }
    public function modification($slug){

        $recrutement = Recrutement::where('slug','=',$slug)->first();
        $entites = Entite::all();
        $typecontrats = Typecontrat::all();
       // $avantagedotations = Avantagedotation::all();
        $debit_internets=Debit_internet::all();
        $forfaits = Forfait::all();
        $assurance_maladies= Assurance_maladie::all();
        $categories = Categorie::all();
        $services = Services::all();
        $definitions = Definition::all();
        $recrutements = Recrutement::where('id_service','=',Auth::user()->service->id)->get();
        $competences= json_decode($recrutement->competenceRecherche);
        $taches= json_decode($recrutement->tache);
        return view('recrutements/ficheRecrutement',compact('entites','typecontrats','definitions','categories','debit_internets','forfaits','assurance_maladies','services','recrutements','recrutement','competences','taches'));
    }
    public function afficher($slug){

        $recrutement = Recrutement::where('slug','=',$slug)->first();
        $entites = Entite::all();
        $typecontrats = Typecontrat::all();
       // $avantagedotations = Avantagedotation::all();
        $debit_internets=Debit_internet::all();
        $forfaits = Forfait::all();
        $assurance_maladies= Assurance_maladie::all();
        $categories = Categorie::all();
        $services = Services::all();
        $definitions = Definition::all();
        $recrutements = Recrutement::where('id_service','=',Auth::user()->service->id)->get();
        $competences= json_decode($recrutement->competenceRecherche);
        $taches= json_decode($recrutement->tache);
        return view('recrutements/Consulrecrutement',compact('entites','typecontrats','definitions','categories','debit_internets','forfaits','assurance_maladies','services','recrutements','recrutement','competences','taches'));
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
        $telephone_portable=$parameters['telephone_portable'];
        $forfait=$parameters['forfait'];
        $debit_internet=$parameters['debit_internet'];
        $assurance_maladie=$parameters['assurance_maladie'];
        $nombre_personne=$parameters['nombre_personne'];

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
        $recruement->telephone_portable=$telephone_portable;
        $recruement->forfait=$forfait;
        $recruement->debit_internet=$debit_internet;
        $recruement->assurance_maladie=$assurance_maladie;
        $recruement->id_users=Auth::user()->id;
        $recruement->nombre_personne=$nombre_personne;
        $recruement->slug=Str::slug($posteAPouvoir.$id_entite.$date->format('dmYhis'));


        $recruement->save();

        return redirect()->route('recrutement.demande')->with('success',"La demande de recrutement a été  enregistrée avec succès");

    }

    /**
     *
     */
    public function modifier_recrutement(Request $request){

        $parameters=$request->except(['_token']);
        $slug=$parameters['slug'];
        $posteAPouvoir=$parameters['posteAPouvoir'];
        $id_entite=$parameters['id_entite'];
        $id_service=$parameters['service'];
        $descriptifFonction=$parameters['descriptifFonction'];
        $competences=$parameters['competences'];
        $taches=$parameters['taches'];
        $id_type_contrat=$parameters['id_type_contrat'];
        $dateDebut=$parameters['dateDebut'];
        $dureeMission=$parameters['dureeMission'];
        $telephone_portable=$parameters['telephone_portable'];
        $forfait=$parameters['forfait'];
        $debit_internet=$parameters['debit_internet'];
        $assurance_maladie=$parameters['assurance_maladie'];
        $nombre_personne=$parameters['nombre_personne'];

        $recruement = Recrutement::where('slug','=',$slug)->first();

        $recruement->posteAPouvoir=$posteAPouvoir;
      /*  $recruement->id_entite=$id_entite;
        $recruement->id_service=$id_service;*/
        $recruement->descriptifFonction=$descriptifFonction;


        $competences = new Collection();
        for($i = 0; $i <= count($request->input("competences"))-1; $i++ )
        {
            $competence = new Element();

            if( !empty($request->input("competences")[$i])){
                $competence->valeur = $request->input("competences")[$i];

                $competences->add($competence);
            }

        }
        $recruement->competenceRecherche=$competences;
        $taches = new Collection();
        for($i = 0; $i <= count($request->input("taches"))-1; $i++ )
        {
            $tache = new Element();

            if( !empty($request->input("taches")[$i])){
                $tache->valeur = $request->input("taches")[$i];

                $taches->add($tache);
            }

        }

        $recruement->tache=$taches;
        $recruement->id_type_contrat=$id_type_contrat;
        $recruement->dateDebut=$dateDebut;
        $recruement->dureeMission=$dureeMission;
        $recruement->telephone_portable=$telephone_portable;
        $recruement->forfait=$forfait;
        $recruement->debit_internet=$debit_internet;
        $recruement->assurance_maladie=$assurance_maladie;
        $recruement->nombre_personne=$nombre_personne;

        $recruement->save();

        return redirect()->back()->with('success',"La demande de recrutement a été  modifiée avec succès");
    }

    public function ActionValider($slug){
        $recruement = Recrutement::where('slug','=',$slug)->first();
        $date= new DateTime(null);

        $recruement->etat=2;
        $recruement->id_valideur=Auth::user()->id;

        $recruement->save();

        return redirect()->route('recrutement.validation')->with('success',"La demande de recrutement a été  validée avec succès");

    }
    public function ActionRejeter($slug){
        $recruement = Recrutement::where('slug','=',$slug)->first();
        $date= new DateTime(null);

        $recruement->etat=4;
        $recruement->id_valideur=Auth::user()->id;

        $recruement->save();

        return redirect()->route('recrutement.validation')->with('success',"La demande de recrutement a été  réfusé avec succès");

    }

    public function lister_recrutement(){
        $recrutements= Recrutement::where('etat','<>',1)->get();
        $entites = Entite::all();
        $mode="gestion";

        $entites = Entite::all();
        $typecontrats = Typecontrat::all();
        // $avantagedotations = Avantagedotation::all();
        $debit_internets=Debit_internet::all();
        $forfaits = Forfait::all();
        $assurance_maladies= Assurance_maladie::all();
        $categories = Categorie::all();
        $services = Services::all();
        $definitions = Definition::all();
        return view('recrutements/GestionRecrutement',compact('entites','recrutements','mode','typecontrats','debit_internets','forfaits','assurance_maladies','categories','services','definitions'));
    }

    public function valider_recrutement(){

        $entites = Entite::all();
        $recrutements= Recrutement::where('etat','=',1)->get();
        $mode="validation";

        $typecontrats = Typecontrat::all();
        // $avantagedotations = Avantagedotation::all();
        $debit_internets=Debit_internet::all();
        $forfaits = Forfait::all();
        $assurance_maladies= Assurance_maladie::all();
        $categories = Categorie::all();
        $services = Services::all();
        $definitions = Definition::all();
        return view('recrutements/GestionRecrutement',compact('entites','recrutements','mode','typecontrats','debit_internets','forfaits','assurance_maladies','categories','services','definitions'));
    }

}
