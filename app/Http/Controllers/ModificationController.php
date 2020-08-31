<?php

namespace App\Http\Controllers;

use App\Absence;
use App\Assurance_maladie;
use App\Categorie;
use App\Contrat;
use App\Definition;
use App\Entite;
use App\Fin_contrat_traite;
use App\Fonction;
use App\Jobs\EnvoiesDemandeValidation;
use App\Jobs\EnvoiesDemandeValidation_personnalise;
use App\Jobs\EnvoiesDemandeValider;
use App\Jobs\EnvoiesInformationDemandeur;
use App\Jobs\EnvoiesRefusRecrutement;
use App\Listmodifavenant;
use App\Metier\Json\Rubrique;
use App\Modification;
use App\Personne;
use App\Personne_contrat;
use App\Personne_presente;
use App\Recrutement;
use App\Rubrique_salaire;
use App\Services;
use App\Typecontrat;
use App\uniteJour;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $modifications = Modification::where('etat','<>',0)->where('id_service','=',Auth::user()->id_service)->get();
       // dd(Auth::user()->id_chantier_connecte);
        if(Auth::user()->hasRole('Ressource_humaine')){
            $personnes = Personne_presente::orderBy('nom', 'ASC')->where('id_entite','=',Auth::user()->id_chantier_connecte)->orderBy('prenom', 'ASC')->get();
        }else{
            $personnes = Personne_presente::where('service','=',Auth::user()->id_service)->where('id_entite','=',Auth::user()->id_chantier_connecte)->orderBy('nom', 'ASC')->orderBy('prenom', 'ASC')->get();
        }
       // dd($personnes);

        //dd(Auth::user());
     //   dd($modifiaction);
        $fonctions = Fonction::all();
        $Listmodifavenants=Listmodifavenant::all();
        return view('modification/ficheModification',compact('entites','typecontrats','definitions','categories','services','modifications','personnes','fonctions','Listmodifavenants'));
    }
    public function save_renouvellement_multiple( Request $request){



        $parameters=$request->except(['_token']);
//dd($parameters);
        $lesid=explode(',',$parameters["id_personnetype_contratrenouvellement"]);
        $dateFinC=$parameters['dateFinC'];
        $type_de_contrat=$parameters['type_de_contrat'];
        $listemodif=Array();
        if($dateFinC!="") {
            $listemodif[] = "La date de fin";

        }
        if($type_de_contrat!=""){
            $listemodif[]="Le type de contrat";

        }
        $tab_list_modif=\GuzzleHttp\json_encode($listemodif);
        foreach($lesid as $id):
            // on remplie le tableau des demandes traitées
            $contrats= DB::select('call fin_contrat_service('.Auth::user()->service->id.','.Auth::user()->id_chantier_connecte.')');
            foreach($contrats as $contrat):
                if($contrat->id_p==$id){
                    $fin_contrat_traite = new Fin_contrat_traite();
                    $fin_contrat_traite->id_personne=$id;
                    $fin_contrat_traite->id_service=Auth::user()->service->id;
                    $fin_contrat_traite->nom=$contrat->nom;
                    $fin_contrat_traite->prenom=$contrat->prenom;
                    $fin_contrat_traite->libelle=$contrat->libelle;
                    $fin_contrat_traite->datedebutc=$contrat->datedebutc;
                    $fin_contrat_traite->datefinc=$contrat->datefinc;
                    $fin_contrat_traite->save();
                }

                endforeach;
            // fin du remplissement du tableau des demandes traitées
            $personne_presente= Personne_presente::where('id','=',$id)->first();
            $modification = new Modification();
        if($id!=""){
            if($dateFinC!="") {
                $modification->dateFinC=$dateFinC;
                $modification->datefinc_initial=$personne_presente->datefinc;
            }
            if($type_de_contrat!=""){
                $modification->id_type_contrat=$type_de_contrat;
                $modification->id_type_contrat_initial=$personne_presente->id_typecontrat;
            }

            $modification->id_typeModification=2;
            $modification->list_modif=$tab_list_modif;
            $modification->id_personne=$id;

            $modification->id_users=Auth::user()->id;
            $modification->id_service=Auth::user()->service->id;
            $modification->save();
        }


        endforeach;

        $users =User::all();
        $contact=Array();
        $contactdemandeur=Array();
        foreach($users as $user):

            if($user->hasRole('Chef_de_projet')){
                $contact[]=$user->email;

            }

        endforeach;

        if(!empty($contact)){
            $this->dispatch(new EnvoiesDemandeValidation(2,$contact));
        }

        return redirect()->back()->with('success',"Les demandes de renouvellement ont été ajoutées avec succès");
    }
    public function modification($id){

        $modification = Modification::find($id);
        $listmodif=json_decode($modification->list_modif);
        $modifications = Modification::where('etat','<>',0)->where('id_service','=',Auth::user()->id_service)->get();
      //  dd($modifications);
        $entites = Entite::all();
        $typecontrats = Typecontrat::all();
        $categories = Categorie::distinct('libelle')->get();
        $services = Services::all();
        $definitions = Definition::all();
        // $modifications = Modification::where('etat','<>',0)->where('id_service','=',Auth::user()->service->id)->get();
        if(Auth::user()->hasRole('Ressource_humaine')){
            $personnes = Personne_presente::orderBy('nom', 'ASC')->where('id_entite','=',Auth::user()->id_chantier_connecte)->orderBy('prenom', 'ASC')->get();
        }else{
            $personnes = Personne_presente::where('service','=',Auth::user()->id_service)->where('id_entite','=',Auth::user()->id_chantier_connecte)->orderBy('nom', 'ASC')->orderBy('prenom', 'ASC')->get();
        }
        $fonctions = Fonction::all();
        return view('modification/ficheModification',compact('entites','typecontrats','definitions','categories','services','modifications','modification','competences','fonctions','personnes','listmodif'));
    }
    public function afficher($id){

        $modification = Modification::find($id);
       //dd(json_decode($modification->list_modif));
        $entites = Entite::all();
        $typecontrats = Typecontrat::all();
        $categories = Categorie::all();
        $services = Services::all();
        $definitions = Definition::all();
        $modifications = Modification::where('etat','<>',0)->where('id_service','=',Auth::user()->service->id)->get();
        return view('modification/ConsulModification',compact('entites','typecontrats','definitions','categories','services','modifications','modification'));
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
    public function lapersonne_contrat($id){

        $personne = Personne_presente::find($id);

        $resultat[0]= $personne;
        $resultat['leservice']= $personne->leservice()->get();
        $resultat['lafonction']= $personne->lafonction()->get();
        $resultat['lecontrat']= $personne->lecontrat()->get();
        $resultat['Listmodifavenants']=   $Listmodifavenants=Listmodifavenant::all();

        return $resultat;
    }

    public function enregistrer_modification(Request $request ){


        $parameters=$request->except(['_token']);
       // dd($parameters);


        //les valeurs initiales

        $service1_initial=$parameters['service1_initial'];
       // $id_fonction1_initial=$parameters['id_fonction1_initial'];
        $id_type_contrat1_initial=$parameters['id_type_contrat1_initial'];
        $datefinc1_initial=$parameters['datefinc1_initial'];
        $dm_id_definition_initial=$parameters['dm_id_definition_initial'];
        $dm_id_categorie_initial=$parameters['dm_id_categorie_initial'];
        $regime1_initial=$parameters['regime1_initial'];
        $dm_budgetMensuel_initial=$parameters['dm_budgetMensuel_initial'];

        //fin des valeurs initial
        $listemodif=$parameters['listemodif'];
        $id_personne=$parameters['id_personne'];
        $service=$parameters['service'];
        //$id_fonction=$parameters['id_fonction'];
        $id_type_contrat=$parameters['id_type_contrat'];
        $datefinc=$parameters['datefinc'];
        $id_definition=$parameters['id_definition'];
        if(isset($parameters['id_categorie'])){
            $id_categorie=$parameters['id_categorie'];
        }else{
            $id_categorie=$dm_id_categorie_initial;
        }

        $regime=$parameters['regime'];
        $budgetMensuel=$parameters['budgetMensuel'];
        $vehicule=$parameters['vehicule'];
        $logement=$parameters['logement'];
        $gratification=$parameters['gratification'];


        $tab_list_modif=\GuzzleHttp\json_decode($listemodif);
       // dd($tab_list_modif);


        $modification = new Modification();
        $date= new DateTime(null);
        $modification->id_typeModification=3;
        if(in_array ("Le type de contrat",$tab_list_modif)){
            $modification->id_type_contrat=$id_type_contrat;
            $modification->id_type_contrat_initial=$id_type_contrat1_initial;
        }
        if(in_array ("La définition",$tab_list_modif)){
            $modification->id_definition=$id_definition;
            $modification->id_definition_initial=$dm_id_definition_initial;
        }
        if(in_array ("La catégorie",$tab_list_modif)){
            $modification->id_categorie=$id_categorie;
            $modification->id_categorie_initial=$dm_id_categorie_initial;
        }
        if(in_array ("La date de fin",$tab_list_modif)){
            $modification->dateFinC=$datefinc;
            $modification->datefinc_initial=$datefinc1_initial;
            $modification->id_typeModification=2;
        }
        if(in_array ("La durée hebdomadaire de travail",$tab_list_modif)){
            $modification->regime=$regime;
            $modification->regime_initial=$regime1_initial;

        }
        if(in_array ("La fonction",$tab_list_modif)){
          //  $modification->id_fonction=$id_fonction;
          //  $modification->id_fonction_initial=$id_fonction1_initial;
        }
        if(in_array ("Les conditions de rémunérations",$tab_list_modif)){
            $modification->budgetMensuel=$budgetMensuel;
            $modification->budgetMensuel_initial=$dm_budgetMensuel_initial;
        }
        if(in_array ("Le service",$tab_list_modif)){
            $modification->service=$service;
            $modification->service_initial=$service1_initial;
        }

        $modification->list_modif=$listemodif;
        $modification->id_personne=$id_personne;
        $modification->id_users=Auth::user()->id;
        $modification->id_service=Auth::user()->service->id;

        $modification->vehicule=$vehicule;
        $modification->logement=$logement;
        $modification->gratification=$gratification;



        $modification->save();

        $users =User::all();
        $contact=Array();
        $contactdemandeur=Array();
        foreach($users as $user):

            if($user->hasRole('Chef_de_projet')){
                $contact[]=$user->email;

            }

        endforeach;

        if(!empty($contact)){
            $this->dispatch(new EnvoiesDemandeValidation_personnalise(2,$contact,$modification));
        }
        return redirect()->back()->with('success',"La demande de modification a été  enregistrée avec succès");

    }
    public function je_connais_tes_droits_je_te_notifie_de_linformation_qui_te_concerne($les_droits,$email){


        if(in_array('Chef_de_projet',$les_droits)){
            $this->dispatch(new EnvoiesDemandeValidation(2,$email));
        }


    }
    public function dit_moi_qui_tu_es_je_te_dirai_tes_droits($id_users){

        $roles=DB::table('user_role')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('user_role.user_id','=',$id_users)
            ->select('roles.name')->get();
        $tab_roles= Array();
        foreach($roles as $rol):
            $tab_roles[]=$rol->name;
        endforeach;

        return $tab_roles;
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

        $id=$parameters['id'];
        $listemodif=$parameters['listemodif'];
        //$id_personne=$parameters['id_personne'];
        $service=$parameters['service'];
       // $id_fonction=$parameters['id_fonction'];
        $id_type_contrat=$parameters['id_type_contrat'];
        $datefinc=$parameters['datefinc'];
        $id_definition=$parameters['id_definition'];
        $id_categorie=$parameters['id_categorie'];
        $regime=$parameters['regime'];
        $budgetMensuel=$parameters['budgetMensuel'];

        $vehicule=$parameters['vehicule'];
        $logement=$parameters['logement'];
        $gratification=$parameters['gratification'];

        $tab_list_modif=\GuzzleHttp\json_decode($listemodif);



        $modification = Modification::find($id);
        $date= new DateTime(null);
//dd($tab_list_modif);
        $modification->id_typeModification=3;
        if(in_array ("Le type de contrat",$tab_list_modif)){
            $modification->id_type_contrat=$id_type_contrat;

        }
        if(in_array ("La définition",$tab_list_modif)){
            $modification->id_definition=$id_definition;
        }
        if(in_array ("La catégorie",$tab_list_modif)){
            $modification->id_categorie=$id_categorie;

        }
        if(in_array ("La date de fin",$tab_list_modif)){
            $modification->dateFinC=$datefinc;
            $modification->id_typeModification=3;
        }
        if(in_array ("La durée hebdomadaire de travail",$tab_list_modif)){
            $modification->regime=$regime;
        }
        if(in_array ("La fonction",$tab_list_modif)){
          //  $modification->id_fonction=$id_fonction;
        }
        if(in_array ("Les conditions de rémunérations",$tab_list_modif)){
            $modification->budgetMensuel=$budgetMensuel;
        }
        if(in_array ("Le service",$tab_list_modif)){
            $modification->service=$service;
        }
        $modification->list_modif=$listemodif;

        $modification->vehicule=$vehicule;
        $modification->logement=$logement;
        $modification->gratification=$gratification;


        $modification->save();
        return redirect()->back()->with('success',"La demande de modification a été  modifiée avec succès");
    }

    public function ActionValider($id){
        $recruement = Modification::find($id);
        $date= new DateTime(null);

        $recruement->etat=2;
        $recruement->id_validateur=Auth::user()->id;

        $recruement->save();
        $users =User::all();
        /*
        foreach($users as $user):
            $mes_droits =  $this->dit_moi_qui_tu_es_je_te_dirai_tes_droits($user->id);
            $this->je_connais_tes_droits_je_te_notifie_pour_la_gestion($mes_droits,$user->email);
        endforeach;
        */
        $contact=Array();
        $contactdemandeur=Array();
        foreach($users as $user):

            if($user->hasRole('Ressource_humaine')){
                $contact[]=$user->email;

            }

        endforeach;

        if(!empty($contact)){
            $this->dispatch(new EnvoiesDemandeValider(2,$contact));
        }
        $contactdemandeur[]=$recruement->user()->first()->email;
        if(!empty($contactdemandeur)){
            $this->dispatch(new EnvoiesInformationDemandeur(2,$contactdemandeur,$recruement));
        }


        return redirect()->route('modification.validation')->with('success',"La demande de recrutement a été  validée avec succès");

    }
    public function je_connais_tes_droits_je_te_notifie_pour_la_gestion($les_droits,$email){


        if(in_array('Ressource_humaine',$les_droits)){
            $this->dispatch(new EnvoiesDemandeValider(2,$email));
        }


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
        return view('modification/GestionModification',compact('entites','modifications','mode','typecontrats','categories','services','definitions','rubrique_salaires'));
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
        return view('modification/GestionModification',compact('entites','modifications','mode','typecontrats','categories','services','definitions','rubrique_salaires','mode'));
    }
    public function supprimer($slug){

        $modification = Modification::find($slug);
        $modification->delete();

        return redirect()->back()->with('success',"La demande de modification a été supprimé avec succès");

    }

    public function information_modification($id){
        $modification = Modification::find($id);
        $personne= Personne_presente::find($modification->id_personne);
        $contrats = Contrat::find($personne->id_contrat);
        $categories_initials = Categorie::where('id_definition','=',$contrats->id_definition)->get();
        $tab[0]=$contrats;

        $categories = Array();
        foreach($categories_initials as $lacategorie):

            if(!in_array($lacategorie,$categories)){
                $categories[]=$lacategorie;
            }
        endforeach;

        $tab[1]=$categories;


        $tab[2]=$modification;

        return $tab;

    }
    public function modifications_validation_collective(Request $request){

        $parameters=$request->except(['_token']);

        $mavariable=$parameters['mavariable'];

        $tab_id= explode(',',$mavariable);
        //   dd($tab_id);
        foreach($tab_id as $id):
            if($id!=""){
                $modification = Modification::find($id);

                $modification->etat=2;
                $modification->id_validateur=Auth::user()->id;

                $modification->save();
                $contactdemandeur[]=$modification->user()->first()->email;
                if(!empty($contactdemandeur)){
                //    $this->dispatch(new EnvoiesInformationDemandeur(2,$contactdemandeur,$modification));
                }
            }
        endforeach;
        if($id!="") {
            $users = User::all();
            $contact = Array();
            $contactdemandeur = Array();
            foreach ($users as $user):

                if ($user->hasRole('Ressource_humaine')) {
                    $contact[] = $user->email;

                }
            endforeach;

            if (!empty($contact)) {
                $this->dispatch(new EnvoiesDemandeValider(2, $contact));
            }
        }


    }
    public function voir_mail($id_modificatio){

       // $demande = Modification::find($id_modificatio);
        $demande = Absence::find($id_modificatio);
        $typedemande=3;
        return view('mail/information_demandeur',compact('demande','typedemande'));
    }

}
