<?php

namespace App\Http\Controllers;

use App\Assurance_maladie;
use App\Categorie;
use App\Definition;
use App\Entite;
use App\Fonction;
use App\Jobs\EnvoiesRefusRecrutement;
use App\Metier\Json\Rubrique;
use App\Modification;
use App\Personne;
use App\Recrutement;
use App\Rubrique_salaire;
use App\Services;
use App\Typecontrat;
use App\uniteJour;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Metier\Json\Element;

class ModificationController extends Controller
{
    //
    public function demande_modification(){

        $entites = Entite::all();
        $typecontrats = Typecontrat::all();
        $categories = Categorie::all();
        $services = Services::all();
        $definitions = Definition::all();
        $modifications = Modification::all();
        $personnes = Personne::all();
        $fonctions = Fonction::all();
        return view('modification/ficheModification',compact('entites','typecontrats','definitions','categories','services','modifications','personnes','fonctions'));
    }
    public function modification($slug){

        $modifications = Modification::where('slug','=',$slug)->first();
        $entites = Entite::all();
        $typecontrats = Typecontrat::all();
        $assurance_maladies= Assurance_maladie::all();
        $categories = Categorie::distinct('libelle')->get();
        $services = Services::all();
        $definitions = Definition::all();
        // $modifications = Modification::where('etat','<>',0)->where('id_service','=',Auth::user()->service->id)->get();
        $competences= json_decode($modifications->competenceRecherche);
        $taches= json_decode($modifications->tache);
        $uniteJours=uniteJour::all();
        return view('modifications/ficheModification',compact('entites','typecontrats','definitions','categories','debit_internets','forfaits','assurance_maladies','services','recrutements','recrutement','competences','taches','uniteJours'));
    }
    public function afficher($slug){

        $modifications = Modification::where('slug','=',$slug)->first();
        $entites = Entite::all();
        $typecontrats = Typecontrat::all();
        $categories = Categorie::all();
        $services = Services::all();
        $definitions = Definition::all();
        $modifications = Modification::where('etat','<>',0)->where('id_service','=',Auth::user()->service->id)->get();
        $competences= json_decode($modifications->competenceRecherche);
        $taches= json_decode($modifications->tache);
        return view('modifications/ConsulModification',compact('entites','typecontrats','definitions','categories','services','modifications','competences','taches'));
    }
    public function liste_salaire($slug){

        $recrutement = Modification::where('slug','=',$slug)->first();
        $rubrique_salaires= Rubrique_salaire::all();
        $resultat="";
        if(!empty($recrutement->salaire)){

            $salaires=\GuzzleHttp\json_decode($recrutement->salaire);


$j=0;
            foreach($salaires as $salaire ):
                $j++;
                if($j>5) {
                    $resultat .= "<div class='form-control-label'><label for='rubrique[]'>Rubrique</label> <div class='form-group col-sm-12'> <select type='text' name='rubrique[]' class='type_c form-control input-field'>";


                $selected='';
                if(isset($rubrique_salaires)){
                    $i=0;
                    foreach($rubrique_salaires as $rubrique_salaire):
                            $i++;

                        if($i>5){
                            if($rubrique_salaire->libelle==$salaire->libelle){
                                $selected="selected";
                            }else{
                                $selected='';
                            }
                        $resultat.= " <option value='".$rubrique_salaire->libelle."'".$selected." >".$rubrique_salaire->libelle."</option>";
                        }
                    endforeach;
                }

                    $resultat .= "</select></div></div><div class='form-control-label'> <label for='valeur[]'>Valeur</label><div class='form-group col-sm-12'><div class='form-line'><input type='text' name='valeur[]' class='valeur_c form-control' placeholder='Valeur' value='" . $salaire->valeur . "'></div></div></div><hr width='800' color='blue'> ";
                }
            endforeach;

        }
     //   dd($resultat);

        $tab[]=$salaires;
        $tab[]=$resultat;
        return $tab;
    }
     public function monrecrutement($slug){

        $recrutement = Modification::where('slug','=',$slug)->first();
        $rubrique_salaires= Rubrique_salaire::all();


        return $recrutement;
    }
    public function macategorie($categorieLibelle,$id_definition,$regime){

        $catgorie = Categorie::where([

                                        ['libelle','=',$categorieLibelle],
                                        ['id_definition','=',$id_definition],
                                        ['regime','=',$regime],
                                    ])->first();

       // dd($id_categorie);
        return $catgorie;
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
        $id_uniteJour=$parameters['id_uniteJour'];

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
        $recruement->NbrePersonne=$nombre_personne;
        $recruement->id_uniteJour=$id_uniteJour;
        $recruement->slug=Str::slug($posteAPouvoir.$id_entite.$date->format('dmYhis'));


        $recruement->save();

        return redirect()->route('recrutement.demande')->with('success',"La demande de recrutement a été  enregistrée avec succès");

    }
  public function ConditionRemuneration(Request $request ){

     // dd($request);
        $parameters=$request->except(['_token']);
        $slug=$parameters['slugConditionRemuneration'];
        $id_categorie=$parameters['id_categorie'];
        $id_definition=$parameters['id_definition'];
        $regime=$parameters['regime'];
     // $rubrique_salaire=$parameters['rubrique_salaire'];


//les rubriques du salaire
      $rubriques = new Collection();
      for($i = 0; $i <= count($request->input("rubrique"))-1; $i++ )
      {
          $rubrique = new Rubrique();

          if( !empty($request->input("valeur")[$i])){
              $rubrique->libelle = $request->input("rubrique")[$i];
              $rubrique->valeur= $request->input("valeur")[$i];
              $rubriques->add($rubrique);
          }

      }

      $recruement = Modification::where('slug','=',$slug)->first();
        $date= new DateTime(null);

        $recruement->salaire=json_encode($rubriques->toArray());
        $recruement->id_categorie=$id_categorie;
        $recruement->id_definition=$id_definition;
        $recruement->regime=$regime;

        $recruement->save();

        return redirect()->back()->with('success',"Les condition de rémunération ont été enregistrée avec succès");

    }

    /**
     *
     */
    public function modifier_modification(Request $request){

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

        $recruement = Modification::where('slug','=',$slug)->first();

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
        $recruement->NbrePersonne=$nombre_personne;

        $recruement->save();

        return redirect()->back()->with('success',"La demande de recrutement a été  modifiée avec succès");
    }

    public function ActionValider($slug){
        $recruement = Modification::where('slug','=',$slug)->first();
        $date= new DateTime(null);

        $recruement->etat=2;
        $recruement->id_valideur=Auth::user()->id;

        $recruement->save();

        return redirect()->route('recrutement.validation')->with('success',"La demande de recrutement a été  validée avec succès");

    }
    public function ActionRejeter(Request $request){
        $parameters=$request->except(['_token']);
        $slug=$parameters['slug'];
        $motif=$parameters['motif'];
        $recrutement = Recrutement::where('slug','=',$slug)->first();
        $date= new DateTime(null);

        $recrutement->etat=0;
        $recrutement->id_valideur=Auth::user()->id;

        $recrutement->save();

        $this->dispatch(new EnvoiesRefusRecrutement($recrutement,$motif));

        return redirect()->route('recrutement.validation')->with('success',"La demande de recrutement a été réfusé");

    }

    public function lister_modification(){
        $modifications= Modification::where('etat','<>',0)->where('etat','<>',1)->get();
        $entites = Entite::all();
        $mode="gestion";

        $entites = Entite::all();
        $typecontrats = Typecontrat::all();
        $categories = Categorie::distinct('libelle')->get();
        $services = Services::all();
        $definitions = Definition::all();
        $rubrique_salaires= Rubrique_salaire::all();
        return view('recrutements/GestionRecrutement',compact('entites','modifications','mode','typecontrats','categories','services','definitions','rubrique_salaires'));
    }

    public function valider_modification(){

        $entites = Entite::all();
        $modifications= Modification::where('etat','=',1)->get();
        $mode="validation";
        $typecontrats = Typecontrat::all();
        $categories = Categorie::all();
        $services = Services::all();
        $definitions = Definition::all();
        $rubrique_salaires= Rubrique_salaire::all();
        return view('modification/GestionModification',compact('entites','modifications','mode','typecontrats','categories','services','definitions','rubrique_salaires'));
    }
    public function supprimer($slug){

        $recruement = Recrutement::where('slug','=',$slug)->first();
        $date= new DateTime(null);

        $recruement->etat=0;
        $recruement->id_valideur=Auth::user()->id;

        $recruement->save();

        return redirect()->back()->with('success',"La demande de recrutement a été supprimé avec succès");

    }

}
