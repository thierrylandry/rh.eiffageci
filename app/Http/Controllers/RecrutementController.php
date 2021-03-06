<?php

namespace App\Http\Controllers;

use App\Assurance_maladie;
use App\Avantagedotation;
use App\Categorie;
use App\Debit_internet;
use App\Definition;
use App\Entite;
use App\Forfait;
use App\Jobs\EnvoiesDemandeValidation;
use App\Jobs\EnvoiesDemandeValider;
use App\Jobs\EnvoiesInformationDemandeur;
use App\Jobs\EnvoiesRefusRecrutement;
use App\Metier\Json\Rubrique;
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
use Illuminate\Support\Facades\Mail;
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
        $recrutements = Recrutement::where('id_service','=',Auth::user()->service->id)->where('id_entite','=',Auth::user()->id_chantier_connecte)->get();
       // dd($recrutements);
        $uniteJours=uniteJour::all();
        return view('recrutements/ficheRecrutement',compact('entites','typecontrats','definitions','categories','debit_internets','forfaits','assurance_maladies','services','recrutements','uniteJours'));
    }
    public function modification($slug){

        $recrutement = Recrutement::where('slug','=',$slug)->first();
        $entites = Entite::all();
        $typecontrats = Typecontrat::all();
       // $avantagedotations = Avantagedotation::all();
        $debit_internets=Debit_internet::all();
        $forfaits = Forfait::all();
        $assurance_maladies= Assurance_maladie::all();
        $categories = Categorie::distinct('libelle')->get();
        $services = Services::all();
        $definitions = Definition::all();
        $recrutements = Recrutement::where('etat','<>',0)->where('id_service','=',Auth::user()->service->id)->where('id_entite','=',Auth::user()->id_chantier_connecte)->get();
        $competences= json_decode($recrutement->competenceRecherche);
       // dd($competences);
        $taches= json_decode($recrutement->tache);
        $uniteJours=uniteJour::all();
        return view('recrutements/ficheRecrutement',compact('entites','typecontrats','definitions','categories','debit_internets','forfaits','assurance_maladies','services','recrutements','recrutement','competences','taches','uniteJours'));
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
        $recrutements = Recrutement::where('etat','<>',0)->where('id_service','=',Auth::user()->service->id)->where('id_entite','=',Auth::user()->id_chantier_connecte)->get();
        $competences= json_decode($recrutement->competenceRecherche);
        $taches= json_decode($recrutement->tache);
      //  dd($competences[0]);
        return view('recrutements/Consulrecrutement',compact('entites','typecontrats','definitions','categories','debit_internets','forfaits','assurance_maladies','services','recrutements','recrutement','competences','taches'));
    }
    public function liste_salaire($slug){

        $recrutement = Recrutement::where('slug','=',$slug)->first();
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

        if(isset($salaires)){
            $tab[]=$salaires;
        }else{
            $tab[]="";
        }

        $tab[]=$resultat;
        return $tab;
    }
    public function liste_salaire_by_id($id){

        $recrutement = Recrutement::find($id);
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

        }else{
            $salaires="";
            $resultat="";
        }
     //   dd($resultat);

        $tab[]=$salaires;
        $tab[]=$resultat;
        return $tab;
    }
     public function monrecrutement($slug){

        $recrutement = Recrutement::where('slug','=',$slug)->first();
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
        $recruement->etat=$this->en_fonction_de_tes_roles_quel_est_la_force_de_ta_demande(Auth::user()->id_personne);

        $recruement->save();

        $users =User::all();
        /*
        foreach($users as $user):
            $mes_droits =  $this->dit_moi_qui_tu_es_je_te_dirai_tes_droits($user->id);
            $this->je_connais_tes_droits_je_te_notifie_de_linformation_qui_te_concerne($mes_droits,$user->email);
        endforeach;
         */
        $contact=$this->contact_a_notifier($recruement);
        //dd($contact);
        $recruement->save();

        if(!empty($contact)){
            $this->dispatch(new EnvoiesDemandeValidation(1,$contact));
        }


        return redirect()->route('recrutement.demande')->with('success',"La demande de recrutement a été  enregistrée avec succès");

    }
    public function en_fonction_de_tes_roles_quel_est_la_force_de_ta_demande($id_personne){
        $etat=0;
        //dd($id_personne);
        $personne =Personne_presente::find($id_personne);
        if(Auth::user()->hasRole('Ressource_humaine')){
            if(isset($personne) & $personne->id_sous_service==""){
                $etat=1;
            }else{
                $etat=0;
            }
        }elseif(Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_SEMELLES')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_CAISSONS')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_LABORATOIRE')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_MAINTENANCE')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_SOUDEURS')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_CENTRAL_A_BETON')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_NERVURE')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_BETON_PROJETE')){
            $etat=0;
        }else{
            $etat=1;
        }

        return $etat;
    }
    public function contact_a_notifier($recrutement){
        $contacts = Array();
        $users=User::where('id_chantier_connecte','=',Auth::user()->id_chantier_connecte)->get();
        $personne = Personne_presente::find(Auth::user()->id_personne);
        //dd($personne);
        if($recrutement->etat==0){
//dd($personne->sous_service->role->name);
            $libelle_role=$personne->sous_service->role->name;
            foreach($users as $user):
                if($user->hasRole('Chef_de_service') && $personne->lecontrat()->where('etat','=',1)->first()->id_service==$user->id_service){
                    $contacts[]=$user->email;
                }
            endforeach;
        }elseif($recrutement->etat==1){
            foreach($users as $user):

                if( $user->hasRole('Chef_de_projet')){
                    $contacts[]=$user->email;
                }
                if($user->hasRole('Chef_de_service') && $personne->lecontrat()->where('etat','=',1)->first()->id_service==$user->id_service && $personne->id!=Auth::user()->id_personne){
                    $contacts[]=$user->email;

                }

            endforeach;
        }
        return $contacts;

    }
    public function je_connais_tes_droits_je_te_notifie_de_linformation_qui_te_concerne($les_droits,$email){


        if(in_array('Chef_de_projet',$les_droits)){
            $this->dispatch(new EnvoiesDemandeValidation(1,$email));
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

      $recruement = Recrutement::where('slug','=',$slug)->first();
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
        $recruement->NbrePersonne=$nombre_personne;

        $recruement->save();

        return redirect()->back()->with('success',"La demande de recrutement a été  modifiée avec succès");
    }

    public function ActionValider($slug){
        $recruement = Recrutement::where('slug','=',$slug)->first();
        $date= new DateTime(null);

        if($recruement->etat==0){
            $recruement->etat=1;
        }else{
            $recruement->etat=2;
        }
        $recruement->id_valideur=Auth::user()->id;

        $recruement->save();
        $users =User::all();
        /*
        foreach($users as $user):
            $mes_droits =  $this->dit_moi_qui_tu_es_je_te_dirai_tes_droits($user->id);
            $this->je_connais_tes_droits_je_te_notifie_pour_la_gestion($mes_droits,$user->email);
        endforeach;
        */
        if($recruement->etat==2){
            $contact=Array();
            $contactdemandeur=Array();
            foreach($users as $user):

                if($user->hasRole('Ressource_humaine')){
                    $contact[]=$user->email;

                }

            endforeach;

            if(!empty($contact)){
                $this->dispatch(new EnvoiesDemandeValider(1,$contact));
            }
            $contactdemandeur[]=$recruement->user()->first()->email;
            if(!empty($contactdemandeur)){
                $this->dispatch(new EnvoiesInformationDemandeur(1,$contactdemandeur,$recruement));
            }
        }else{

            $contactdemandeur=Array();
            $contact=$this->contact_a_notifier($recruement);

            if(!empty($contact)){
                $this->dispatch(new EnvoiesDemandeValidation(1,$contact));
            }
            $contactdemandeur[]=$recruement->user()->first()->email;
            if(!empty($contactdemandeur)){
               // $this->dispatch(new EnvoiesInformationDemandeur(1,$contactdemandeur,$recruement));
            }
        }

        return redirect()->route('recrutement.validation')->with('success',"La demande de recrutement a été  validée avec succès");

    }
    public function je_connais_tes_droits_je_te_notifie_pour_la_gestion($les_droits,$email){


        if(in_array('Ressource_humaine',$les_droits)){
            $this->dispatch(new EnvoiesDemandeValider(1,$email));
        }


    }
    public function ActionRejeter(Request $request){
        $parameters=$request->except(['_token']);
        $slug=$parameters['slug'];
        $motif=$parameters['motif'];
        $recrutement = Recrutement::where('slug','=',$slug)->first();
        $date= new DateTime(null);

        $recrutement->etat=4;
        $recrutement->id_valideur=Auth::user()->id;

        $recrutement->save();

        $this->dispatch(new EnvoiesRefusRecrutement($recrutement,$motif));

        return redirect()->route('recrutement.validation')->with('success',"La demande de recrutement a été  réfusé");

    }

    public function lister_recrutement(){
        $recrutements= Recrutement::where('etat','<>',0)->where('etat','<>',1)->get();
        $entites = Entite::all();
        $mode="gestion";

        $entites = Entite::all();
        $typecontrats = Typecontrat::all();
        // $avantagedotations = Avantagedotation::all();
        $debit_internets=Debit_internet::all();
        $forfaits = Forfait::all();
        $assurance_maladies= Assurance_maladie::all();
        $categories = Categorie::distinct('libelle')->get();
        $services = Services::all();
        $definitions = Definition::all();
        $rubrique_salaires= Rubrique_salaire::all();
        return view('recrutements/GestionRecrutement',compact('entites','recrutements','mode','typecontrats','debit_internets','forfaits','assurance_maladies','categories','services','definitions','rubrique_salaires'));
    }

    public function valider_recrutement(){

        $entites = Entite::all();
        $tabusers= array();
        if(Auth::user()->hasRole('Chef_de_projet') && Auth::user()->hasRole('Chef_de_service') ){
            $recrutements= Recrutement::whereIn('etat',[1,0])->get();
        }if(Auth::user()->hasRole('Chef_de_projet')){
            $recrutements= Recrutement::whereIn('etat',[1])->get();
        }else{
            if(Auth::user()->hasRole('Chef_de_service')){
                $users=User::where('id_service','=',Auth::user()->id_service)->get();
                foreach ($users as $us):
                    $tabusers[]=$us->id;
                endforeach;
                $recrutements= Recrutement::whereIn('etat',[0])->whereIn('id_users',$tabusers)->get();
            }
        }


        $mode="validation";

        $typecontrats = Typecontrat::all();
        // $avantagedotations = Avantagedotation::all();
        $debit_internets=Debit_internet::all();
        $forfaits = Forfait::all();
        $assurance_maladies= Assurance_maladie::all();
        $categories = Categorie::all();
        $services = Services::all();
        $definitions = Definition::all();
        $rubrique_salaires= Rubrique_salaire::all();
        return view('recrutements/GestionRecrutement',compact('entites','recrutements','mode','typecontrats','debit_internets','forfaits','assurance_maladies','categories','services','definitions','rubrique_salaires'));
    }
    public function supprimer($slug){

        $recruement = Recrutement::where('slug','=',$slug)->first();
        $date= new DateTime(null);

        $recruement->etat=0;
        $recruement->id_valideur=Auth::user()->id;

        $recruement->save();

        return redirect()->back()->with('success',"La demande de recrutement a été  supprimé avec succès");

    }

}
