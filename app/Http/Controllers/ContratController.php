<?php

namespace App\Http\Controllers;

use App\Assurance_maladie;
use App\Categorie;
use App\Contrat;
use App\Definition;
use App\Entite;
use App\Fonction;
use App\Listmodifavenant;
use App\Metier\Json\Rubrique;
use App\Modification;
use App\Nature_contrat;
use App\Personne;
use App\Personne_presente;
use App\Recrutement;
use App\Rubrique_salaire;
use App\Salaire;
use App\Services;
use App\Typecontrat;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContratController extends Controller
{
    //

    public function contrat_new_user(){
        $personne= Personne::orderBy('id', 'desc')->get()->first();
        $services = Services::all();
        $typecontrats= Typecontrat::all();
        $definitions = Definition::all();
        $entites= Entite::all();
        $nature_contrats= Nature_contrat::all();
        $recrutements=Recrutement::where('NbrePersonne','<>','NbrePersonneEffect')->get();
        $rubrique_salaires= Rubrique_salaire::all();
        if($personne->entretien_cs==1 && $personne->entretien_rh==1 && ($personne->visite_medicale==1 || $personne->date_visite!="")){
            return view('contrat/contrat_new_user',compact('personne','services','typecontrats','definitions','entites','nature_contrats','recrutements','rubrique_salaires'));
        }else{
            return redirect()->back()->with('error',"Cette personne n'a pas subit les entretiens préliminaires donc ne peut pas avoir de contrat");
        }

    }
    public function contrat_embauche($id){
        $personne = Personne::find($id);

        $contrat=Array();
        $categories=Array();
        if(isset($personne->contrat_renouvelles)){
            $contrat= $personne->contrat_renouvelles()->orderby('date_debutc_eff','desc')->first();

            if(isset($contrat)){
                $categories = Categorie::where('id_definition','=',$contrat->id_definition)->get();
                $personne= Personne::find($contrat->id_personne);
            }


        }



        $services = Services::all();
        $definitions = Definition::all();
        $typecontrats= Typecontrat::all();
        $entites= Entite::all();
        $nature_contrats= Nature_contrat::all();
        $recrutements = Recrutement::where('etat','=',2)->get();

        $rubrique_salaires= Rubrique_salaire::all();
        return view('contrat/contrat_affiche_recrutement',compact('personne','services','typecontrats','contrat','definitions','categories','entites','nature_contrats','recrutements','rubrique_salaires'));
    }
    public function contrat_new_user2($id,$id_typeModification){

        $modification=null;
        $recrutement=null;
        $listmodif=null;

        if($id_typeModification==2 || $id_typeModification==3 || $id_typeModification==1){
            $modification_recrutement= Modification::find($id);
            $personne= Personne::find($modification_recrutement->id_personne);
            $listmodif=json_decode($modification_recrutement->list_modif);
        }else{
            $modification_recrutement= Recrutement::find($id);
            $personne=null;
        }
        //dd($modification_recrutement->list_modif);
        $definitions = Definition::all();


        $contrat= Contrat::where([['id_personne','=',$personne->id],['etat','=',1]])->orderby('datedebutc','desc')->first();
        if(isset($contrat)){
            $categories = Categorie::where('id_definition','=',$contrat->id_definition)->get();
        }

        $valeurSalaire= Array();
        if(isset($contrat) && !is_null($contrat->valeurSalaire)){
            $valeurSalairepartiels=\GuzzleHttp\json_decode($contrat->valeurSalaire);

            foreach($valeurSalairepartiels as $valeurSalairepartiel):
                $valeurSalaire[$valeurSalairepartiel->libelle]=$valeurSalairepartiel->valeur;

            endforeach;
        }

        $rubrique_salaires= Rubrique_salaire::all();
        //   dd($valeurSalaire);
        $ancien_contrat=true;
        $services = Services::all();
        $typecontrats= Typecontrat::all();
        $entites= Entite::all();
        $nature_contrats= Nature_contrat::all();
        $recrutements= Recrutement::where('NbrePersonne','<>','NbrePersonneEffect')->get();
        $assurance_maladies=Assurance_maladie::all();
        $fonctions =Fonction::all();

        $resultat="";
        if(!empty($contrat->valeurSalaire)){

            $salaires=\GuzzleHttp\json_decode($contrat->valeurSalaire);


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
//dd($contrat->personne->fonction);
        if($personne->entretien_cs==1 && $personne->entretien_rh==1 && ($personne->visite_medicale==1 || $personne->date_visite!="")){
            return view('contrat/contrat_affiche',compact('personne','services','typecontrats','definitions','entites','nature_contrats','contrat','ancien_contrat','categories','rubrique_salaires','recrutements','valeurSalaire','id_typeModification','recrutement','modification_recrutement','id_typeModification','listmodif','assurance_maladies','resultat','fonctions'));
        }else{
            return redirect()->back()->with('error',"Cette personne n'a pas subit les entretiens préliminaires donc ne peut pas avoir de contrat");
        }

    }
    public function listercat($id_definition){
        $categories_initials = Categorie::where('id_definition','=',$id_definition)->distinct('libelle')->select('libelle')->get();
        //    dd($categories_initials);
        $categories = Array();
        foreach($categories_initials as $lacategorie):

            if(!in_array($lacategorie,$categories)){
                $categories[]=$lacategorie;
            }
        endforeach;

        //    dd($categories);
        return $categories;
    }
    public function lerecrutement($id_recrutement){
        $lerecrutement = Recrutement::find($id_recrutement);


        return $lerecrutement;
    }
    public function affiche_contrat($id){
        $contrat= Contrat::find($id);
        //dd(json_decode($contrat->valeurSalaire));
        $rubrique_salaires= Rubrique_salaire::all();
        $rubrique_salaires_limite_5= Rubrique_salaire::orderBy('id','asc')->limit(5)->get();
        $libelrubrique= Array();
        foreach($rubrique_salaires_limite_5 as $sal):
            $libelrubrique[]=$sal->libelle;
            endforeach;
        $categories = Categorie::where('id_definition','=',$contrat->id_definition)->get();
        $personne= Personne::find($contrat->id_personne);
        $services = Services::all();
        $definitions = Definition::all();
        $typecontrats= Typecontrat::all();
        $entites= Entite::all();
        $nature_contrats= Nature_contrat::all();
        $assurance_maladies= Assurance_maladie::all();
        $resultat="";
        if(!empty($contrat->valeurSalaire)){

            $salaires=\GuzzleHttp\json_decode($contrat->valeurSalaire);


            $j=0;
            foreach($salaires as $salaire ):
                $j++;
             //   dd($rubrique_salaires_limite_5);
                if(!in_array($salaire->libelle,$libelrubrique)) {
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

        return view('contrat/contrat_pour_correction',compact('personne','services','typecontrats','contrat','definitions','categories','entites','nature_contrats','assurance_maladies','rubrique_salaires','resultat'));
    }

    public function lister_contrat($slug){
        $personne= Personne::find($slug);
        $services = Services::all();
        $typecontrats= Typecontrat::all();
        $contrats = Contrat::where('id_personne','=',$personne->id)
            ->orderBy('datedebutc','DESC')->get();
        $entites= Entite::all();
        $definitions = Definition::all();

        $modifications =Modification::where('etat','=','2')->where('id_personne','=',$personne->id)->get();

        return view('contrat/lister_contrat',compact('personne','services','typecontrats','contrats','entites','services','typecontrats','definitions','modifications'));
    }

    public function information_contrat($id){
        $contrats = Contrat::find($id);
        $categories_initials = Categorie::where('id_definition','=',$contrats->id_definition)->get();
        $tab[0]=$contrats;

        $categories = Array();
        foreach($categories_initials as $lacategorie):

            if(!in_array($lacategorie,$categories)){
                $categories[]=$lacategorie;
            }
        endforeach;

        $tab[1]=$categories;
        return $tab;

    }

    public function update_contrat( Request $request){

        $parameters=$request->except(['_token']);
        $slug=$parameters["slug"];
        $id_contrat=$parameters["id_contrat"];
        $matricule=$parameters["matricule"];
        $couverture_maladie=$parameters["couverture_maladie"];
        $dateDebutC=$parameters["dateDebutC"];
        $dateFinC= $parameters["dateFinC"];
        $type_de_contrat= $parameters["type_de_contrat"];
        $service= $parameters["service"];
        $periode_essaie= $parameters["periode_essaie"];
        $ruptureEssai= $parameters["ruptureEssai"];
        $departdefinitif= $parameters["departdefinitif"];
        $dateInduction= $parameters["dateInduction"];
        $id_definition= $parameters["id_definition"];
        $id_categorie= $parameters["id_categorie"];
        $email= $parameters["email"];
        $contact= $parameters["contact"];
        $position= $parameters["position"];
        $regime= $parameters["regime"];
        // $id_nature_contrat= $parameters["id_nature_contrat"];

        $contrat=  Contrat::find($id_contrat);

        $contrat->position=$position;
        $contrat->matricule=$matricule;
        $contrat->periode_essaie=$periode_essaie;
        $contrat->couvertureMaladie=$couverture_maladie;
        $contrat->ruptureEssaie=$ruptureEssai;
        $contrat->departdefinitif=$departdefinitif;
        $contrat->dateInduction=$dateInduction;
        $contrat->dateDebutC=$dateDebutC;
        $contrat->dateFinC=$dateFinC;
        $contrat->id_type_contrat=$type_de_contrat;
        $contrat->id_service=$service;
        $contrat->regime=$regime;
        //   $contrat->id_nature_contrat=$id_nature_contrat;
        $personne = Personne::where('slug','=',$slug)->get()->first();

        //changer l'etat de tout les anciens contrats
        $ancien_contrat=  Contrat::where('id_personne','=',$personne->id)
            ->orderby('datedebutc','DESC')
            ->first();
        if(!empty($ancien_contrat) ){
            if($ancien_contrat->datedebutc < $dateDebutC){
                $ancien_contrat->etat=2;
                $contrat->etat=1;
                $ancien_contrat->departDefinitif=date('d-m-Y');
                $ancien_contrat->save();
                $personne->matricule=$matricule;
                $personne->service=$service;
                //            dd("ancien contrat : ".$ancien_contrat->datedebutc." NOUVEAU CONTRAT :".$dateDebutC);
            }else{

                if($ancien_contrat->datedebutc != $dateDebutC){
                    $contrat->etat=2;
                    $ancien_contrat->etat=1;
                }
                if(!empty($ancien_contrat)){
                    $contrat->departDefinitif=$ancien_contrat->departDefinitif;
                }else{
                    $contrat->departDefinitif=date('d-m-Y');
                }

            }
        }else{

            $personne->matricule=$matricule;
            $personne->service=$service;
        }


        $contrat->id_personne=$personne->id;
        $contrat->id_definition=$id_definition;
        $contrat->id_categorie=$id_categorie;
        $contrat->email=$email;
        $contrat->contact=$contact;

        $contrat->save();
        $personne->save();

        // armonisation contrat actif
        $leplusressent=  Contrat::where('id_personne','=',$personne->id)
            ->orderby('datedebutc','DESC')
            ->first();

        $personne->service=$leplusressent->service;
        $personne->matricule=$leplusressent->matricule;
        $leplusressent->etat=1;
        $leplusressent->departDefinitif=null;
        $leplusressent->save();
        $personne->save();


        return redirect()->route('lister_contrat',['slug'=>$personne->slug])->with('success',"Le contrat  a été modifié avec succès");
    }
    public function upload_pj_contrat( Request $request){

        $parameters=$request->except(['_token']);
        $id=$parameters["id"];

        $contrat=  Contrat::find($id);
        $fin='';
        if($contrat->datefinc!=""){
            $fin='_fin_'.$contrat->datefinc;
        }
        $contrat->scan=Str::ascii($contrat->type_contrat->libelle.'_debut_'.$contrat->datedebutc.$fin.'.'.$request->file('pj')->getClientOriginalExtension());

        $contrat->save();
        $path = Storage::putFileAs(
            'document'.DIRECTORY_SEPARATOR.'contrat'.DIRECTORY_SEPARATOR .$contrat->personne->slug,$request->file('pj'),$contrat->scan
        );

        return redirect()->route('lister_contrat',['slug'=>$contrat->personne->id])->with('success',"La Pièce jointe à été ajouté au contrat avec succès");
    }
    public function rupture_contrat($id){
        $contrat= Contrat::find($id);
        $personne=Personne::find($contrat->id_personne);
        $entites= Entite::all();
        return view('contrat/rupture_contrat',compact('personne','contrat','entites'));
    }
    public function rompre(Request $request){

        $parameters=$request->except(['_token']);
        $slug=$parameters["slug"];
        $id_contrat=$parameters["id_contrat"];
        $departdefinitif=$parameters["departdefinitif"];

        $contrat=  Contrat::find($id_contrat);

        $contrat->etat=2;
        $contrat->departdefinitif=$departdefinitif;


        $contrat->save();
        return redirect()->route('lister_contrat',['slug'=>$contrat->id_personne])->with('success',"Le contrat  a été rompu");
    }
    public function save_contrat( Request $request){



        $parameters=$request->except(['_token']);
        //   dd($parameters);
        $slug=$parameters["slug"];

        $personne = Personne::where('slug','=',$slug)->get()->first();


        /* vérifier si on a le droit de creer un contrat pour ce mec */
        if($personne->entretien_cs==1 && $personne->entretien_rh==1 && ($personne->visite_medicale==1 || $personne->date_visite!="")){
        }else{
            return redirect()->back()->with('error',"Cette personne n'a pas subit les entretiens préliminaires donc ne peut pas avoir de contrat");
        }
        /* -- fin  vérifier si on a le droit de creer un contrat pour ce mec */

        $matricule=trim(str_replace(' ','',$parameters["matricule"]));
        $couverture_maladie=$parameters["couverture_maladie"];
        $dateDebutC=$parameters["dateDebutC"];
        $date_debutc_eff=$parameters["date_debutc_eff"];
        $dateFinC= $parameters["dateFinC"];
        $type_de_contrat= $parameters["type_de_contrat"];
        $service= $parameters["service"];
        $periode_essaie= $parameters["periode_essaie"];
        $email= $parameters["email"];
        $contact= $parameters["contact"];
        $position= $parameters["position"];
        $id_definition= $parameters["id_definition"];
        $regime= $parameters["regime"];
        $id_typeModification= $parameters["id_typeModification"];
        $id_recrutement_modification= $parameters["id_recrutement_modification"];
        $vehicule=$parameters['vehicule'];
        $logement=$parameters['logement'];
        $gratification=$parameters['gratification'];

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

        if(isset($parameters["id_categorie"])){
            //dd($parameters["id_categorie"]);
            $id_categorie=$parameters["id_categorie"];

        }else{
            $id_categorie='';
        }

        $contrat= new Contrat();
        $salaire= new Salaire();

        $salaire->id_personne=$personne->id;
        $salaire->valeurSalaire=json_encode($rubriques->toArray());
        $salaire->save();

        $contrat->valeurSalaire=json_encode($rubriques->toArray());
        $contrat->matricule=$matricule;
        $contrat->position=$position;
        $contrat->periode_essaie=$periode_essaie;
        $contrat->couvertureMaladie=$couverture_maladie;
        $contrat->dateDebutC=$dateDebutC;
        $contrat->date_debutc_eff=$date_debutc_eff;
        $contrat->dateFinC=$dateFinC;
        $contrat->id_type_contrat=$type_de_contrat;
        $contrat->id_service=$service;
        $contrat->id_nature_contrat=$id_typeModification;
        $contrat->regime=$regime;

        $contrat->vehicule=$vehicule;
        $contrat->logement=$logement;
        $contrat->gratification=$gratification;

        $contrat->id_modification=$id_recrutement_modification;
        $modification= Modification::find($id_recrutement_modification);
        $modification->etat=3;
        $modification->id_typeModification=$id_typeModification;
        $modification->save();



        //changer l'etat de tout les anciens contrats
        $ancien_contrat=  Contrat::where('id_personne','=',$personne->id)
            ->orderby('date_debutc_eff','DESC')
            ->first();
           //dd($ancien_contrat);


        //si le  type est CDI alors date de fin == nul

        if($type_de_contrat==2){
            $contrat->dateFinC=null;
        }
        //


        // on regarde si il y a un ou plusieurs anciens contrats. Si oui alors récupéré celui qui a la date de debut la plus ressente
        if(!empty($ancien_contrat) ){
            if($ancien_contrat->dateFinC < $dateFinC || $type_de_contrat==2){
                $ancien_contrat->etat=2;
                $ancien_contrat->departDefinitif=date('d-m-Y');
                $ancien_contrat->save();
                $personne->matricule=$matricule;
                $personne->service=$service;
                //            dd("ancien contrat : ".$ancien_contrat->datedebutc." NOUVEAU CONTRAT :".$dateDebutC);
            }else{
                $contrat->etat=2;

                if(!empty($ancien_contrat)){
                    $contrat->departDefinitif=$ancien_contrat->departDefinitif;
                }else{
                    $contrat->departDefinitif=date('d-m-Y');
                }

            }
        }else{

            $personne->matricule=$matricule;
            $personne->service=$service;
        }


        $contrat->id_personne=$personne->id;
        $contrat->email=$email;
        $contrat->contact=$contact;
        $contrat->id_definition=$id_definition;
        if(isset($parameters["id_categorie"])){
            $contrat->id_categorie=$id_categorie;
        }
        $personne->save();
        $contrat->save();

        $entite=$personne->id_entite;

        return redirect()->route('lister_contrat',$personne->id)->with('success',"Le contrat  a été ajouté avec succès");
    }
    public function save_correction_contrat( Request $request){



        $parameters=$request->except(['_token']);
   //       dd($parameters);
        $slug=$parameters["slug"];

        $personne = Personne::where('slug','=',$slug)->get()->first();

        $matricule=trim(str_replace(' ','',$parameters["matricule"]));
        $couverture_maladie=$parameters["couverture_maladie"];
        $dateDebutC=$parameters["dateDebutC"];
        $date_debutc_eff=$parameters["date_debutc_eff"];


        $type_de_contrat= $parameters["type_de_contrat"];
        if($type_de_contrat!=2){
            $dateFinC= $parameters["dateFinC"];
        }
        $service= $parameters["service"];
        $periode_essaie= $parameters["periode_essaie"];
        $email= $parameters["email"];
        $contact= $parameters["contact"];
        $position= $parameters["position"];
        $id_definition= $parameters["id_definition"];
        $regime= $parameters["regime"];
        $id_typeModification= $parameters["id_typeModification"];
        $id_recrutement_modification= $parameters["id_recrutement_modification"];
        $vehicule=$parameters['vehicule'];
        $logement=$parameters['logement'];
        $gratification=$parameters['gratification'];

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

        if(isset($parameters["id_categorie"])){
            //dd($parameters["id_categorie"]);
            $id_categorie=$parameters["id_categorie"];

        }else{
            $id_categorie='';
        }

        $contrat= Contrat::find($parameters['id_contrat']);
        $salaire= new Salaire();
//dd($rubriques);
        $salaire->id_personne=$personne->id;
        $salaire->valeurSalaire=json_encode($rubriques->toArray());
        $salaire->save();

        $contrat->valeurSalaire=json_encode($rubriques->toArray());
        $contrat->matricule=$matricule;
        $contrat->position=$position;
        $contrat->periode_essaie=$periode_essaie;
        $contrat->couvertureMaladie=$couverture_maladie;
        $contrat->dateDebutC=$dateDebutC;
        $contrat->date_debutc_eff=$date_debutc_eff;


        $contrat->logement=$logement;
        $contrat->vehicule=$vehicule;
        $contrat->gratification=$gratification;
        if(isset($contrat->modification->list_modif)){
            $list_modif= \GuzzleHttp\json_decode($contrat->modification->list_modif) ;
            if($contrat->logement!="" || $contrat->vehicule!="" || $contrat->gratification!=""){

                if(!in_array("Les dotations en nature",$list_modif)){
                    $list_modif[]="Les dotations en nature";
                    $contrat->modification->list_modif=\GuzzleHttp\json_encode($list_modif);
                    $contrat->modification->save();
                }

            }else{
                if(in_array("Les dotations en nature",$list_modif)){
                    $listmodinew= Array();
                    foreach($list_modif as $modif):
                        if($modif!="Les dotations en nature"){
                            $listmodinew[]=$modif;
                        }
                    endforeach;
                    $list_modif=$listmodinew;
                    $contrat->modification->list_modif=\GuzzleHttp\json_encode($list_modif);
                    $contrat->modification->save();
                }
            }
        }

        if($type_de_contrat!=2){
            $contrat->dateFinC=$dateFinC;
        }

        $contrat->id_type_contrat=$type_de_contrat;
        $contrat->id_service=$service;
      //  $contrat->id_nature_contrat=$id_typeModification;
        $contrat->regime=$regime;

      //  $contrat->id_modification=$id_recrutement_modification;



        //changer l'etat de tout les anciens contrats
        $ancien_contrat=  Contrat::where('id_personne','=',$personne->id)
            ->orderby('date_debutc_eff','DESC')
            ->first();
        //   dd($ancien_contrat);


        //si le  type est CDI alors date de fin == nul

        if($type_de_contrat==2){
            $contrat->dateFinC=null;
        }
        //


        // on regarde si il y a un ou plusieurs anciens contrats. Si oui alors récupéré celui qui a la date de debut la plus ressente


            $personne->matricule=$matricule;
            $personne->service=$service;


        $contrat->id_personne=$personne->id;
        $contrat->email=$email;
        $contrat->contact=$contact;
        $contrat->id_definition=$id_definition;
        if(isset($parameters["id_categorie"])){
            $contrat->id_categorie=$id_categorie;
        }
       // $personne->fonction=$parameters['id_fonction'];
        $personne->save();
        $contrat->save();

        $entite=$personne->id_entite;

        return redirect()->route('lister_contrat',$personne->id)->with('success',"Le contrat  a été mis à jour avec succès");
    }
    public function save_contrat_recrutement( Request $request){



        $parameters=$request->except(['_token']);

        $slug=$parameters["slug"];

        $personne = Personne::where('slug','=',$slug)->get()->first();

        // dd($personne);

        /* vérifier si on a le droit de creer un contrat pour ce mec */
        if($personne->entretien_cs==1 && $personne->entretien_rh==1 && ($personne->visite_medicale==1 || $personne->date_visite!="")){
        }else{
            return redirect()->back()->with('error',"Cette personne n'a pas subit les entretiens préliminaires donc ne peut pas avoir de contrat");
        }
        /* -- fin  vérifier si on a le droit de creer un contrat pour ce mec */

        $matricule=trim(str_replace(' ','',$parameters["matricule"]));
        $couverture_maladie=$parameters["couverture_maladie"];
        $dateDebutC=$parameters["dateDebutC"];
        $dateFinC= $parameters["dateFinC"];
        $type_de_contrat= $parameters["type_de_contrat"];
        $service= $parameters["service"];
        $periode_essaie= $parameters["periode_essaie"];
        $email= $parameters["email"];
        $contact= $parameters["contact"];
        $position= $parameters["position"];
        $id_definition= $parameters["id_definition"];
        $regime= $parameters["regime"];

        $id_nature_contrat= $parameters["id_nature_contrat"];
        $id_recrutement= $parameters["id_recrutement"];


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

        if(isset($parameters["id_categorie"])){
            //dd($parameters["id_categorie"]);
            $id_categorie=$parameters["id_categorie"];

        }else{
            $id_categorie='';
        }

        $contrat= new Contrat();
        $salaire= new Salaire();

        $salaire->id_personne=$personne->id;
        $salaire->valeurSalaire=json_encode($rubriques->toArray());
        $salaire->save();

        $contrat->valeurSalaire=json_encode($rubriques->toArray());
        $contrat->valeurSalaire=json_encode($rubriques->toArray());
        $contrat->matricule=$matricule;
        $contrat->position=$position;
        $contrat->periode_essaie=$periode_essaie;
        $contrat->couvertureMaladie=$couverture_maladie;
        $contrat->dateDebutC=$dateDebutC;
        $contrat->date_debutc_eff=$dateDebutC;
        $contrat->dateFinC=$dateFinC;
        $contrat->id_type_contrat=$type_de_contrat;
        $contrat->id_service=$service;
        $contrat->id_nature_contrat=$id_nature_contrat;
        $contrat->regime=$regime;
        $contrat->id_recrutement=$id_recrutement;

        $recrutement=Recrutement::find($id_recrutement);
        $recrutement->NbrePersonneEffect+=1;
        if($recrutement->NbrePersonneEffect==$recrutement->NbrePersonne){
            $recrutement->etat=3;
        }
        $recrutement->save();

        //changer l'etat de tout les anciens contrats
        $ancien_contrat=  Contrat::where('id_personne','=',$personne->id)
            ->orderby('datedebutc','DESC')
            ->first();
        //   dd($ancien_contrat);

        // on regarde si il y a un ou plusieurs anciens contrats. Si oui alors récupéré celui qui a la date de debut la plus ressente
        if(!empty($ancien_contrat) ){
            if($ancien_contrat->datedebutc < $dateDebutC){
                $ancien_contrat->etat=2;
                $ancien_contrat->departDefinitif=date('d-m-Y');
                $ancien_contrat->save();
                $personne->matricule=$matricule;
                $personne->service=$service;
                //            dd("ancien contrat : ".$ancien_contrat->datedebutc." NOUVEAU CONTRAT :".$dateDebutC);
            }else{
               // $contrat->etat=2;

                if(!empty($ancien_contrat)){
                    $contrat->departDefinitif=$ancien_contrat->departDefinitif;
                }else{
                    $contrat->departDefinitif=date('d-m-Y');
                }

            }
        }else{

            $personne->matricule=$matricule;
            $personne->service=$service;
        }


        $contrat->id_personne=$personne->id;
        $contrat->email=$email;
        $contrat->contact=$contact;
        $contrat->id_definition=$id_definition;
        if(isset($parameters["id_categorie"])){
            $contrat->id_categorie=$id_categorie;
        }

        $personne->save();
        $contrat->save();

        $entite=$personne->id_entite;

        return redirect()->route('lister_contrat',$personne->id)->with('success',"Le contrat  a été ajouté avec succès");
    }
    public function save_renouvellezment_avenant( Request $request){



        $parameters=$request->except(['_token']);

        $id_personne=$parameters["id_personne"];

        $personne = Personne::find($id_personne);
        //  dd($parameters);

        $matricule=trim(str_replace(' ','',$parameters["matricule"]));
        $couverture_maladie=$parameters["couverture_maladie"];
        $dateDebutC=$parameters["dateDebutC"];
        $dateFinC= $parameters["dateFinC"];
        $type_de_contrat= $parameters["type_de_contrat"];
        $service= $parameters["service"];
        $id_definition= $parameters["id_definition"];
        $id_nature_contrat= $parameters["id_nature_contrat"];
        $regime= $parameters["regime"];

        if(isset($parameters["id_categorie"])){
            //dd($parameters["id_categorie"]);
            $id_categorie= Categorie::where('id','=',$parameters["id_categorie"])->orWhere('libelle','=',$parameters["id_categorie"])->where('regime','=',$regime)->first()->id;
            //  dd($id_categorie);
        }else{
            $id_categorie='';
        }

        $contrat= new Contrat();

        $contrat->matricule=$matricule;
        $contrat->couvertureMaladie=$couverture_maladie;
        $contrat->dateDebutC=$dateDebutC;
        $contrat->dateFinC=$dateFinC;
        $contrat->id_type_contrat=$type_de_contrat;
        $contrat->id_service=$service;
        $contrat->id_nature_contrat=$id_nature_contrat;
        $contrat->regime=$regime;



        //changer l'etat de tout les anciens contrats
        $ancien_contrat=  Contrat::where('id_personne','=',$personne->id)
            ->where('matricule','=',$personne->matricule)->where('etat','=',1)
            // ->where('id_nature_contrat','=',1)
            ->first();

        //dd($ancien_contrat);
        $contrat->id_personne=$personne->id;
        $contrat->email=$ancien_contrat->email;
        $contrat->contact=$ancien_contrat->contact;
        $contrat->position=$ancien_contrat->position;
        $contrat->id_definition=$id_definition;
        if(isset($parameters["id_categorie"])){
            $contrat->id_categorie=$id_categorie;
        }

        //  $personne->save();
        $ancien_contrat->etat=2;
        $ancien_contrat->save();
        $contrat->save();

        $entite=$personne->id_entite;

        return redirect()->back()->with('success',"Le contrat  a été ajouté avec succès");
    }
    public function contratpdf($id){
        $contrat = Contrat::find($id);
            $pieces=json_decode($contrat->personne->pieces);
        if($contrat->id_type_contrat==1){
            $pdf = PDF::loadView('contrat.contratcddpdf',compact('contrat','pieces'));
        }elseif($contrat->id_type_contrat==2){
            $pdf = PDF::loadView('contrat.contratcdipdf',compact('contrat','pieces'));
        }elseif($contrat->id_type_contrat==3){
            $pdf = PDF::loadView('contrat.convention_stage',compact('contrat','pieces'));
        }


        return $pdf->stream();
        //return view('contrat.contratcdipdf',compact('contrat'));
    }
    public function contratCDIpdf(){

        $pdf = PDF::loadView('contrat.contratCDIpdf');

        return $pdf->stream();
    }
    public function renouvellement_contratpdf($id){

        $contrat=Contrat::find($id);
        $pieces=json_decode($contrat->personne->pieces);
        $pdf = PDF::loadView('contrat.renouvellement_contratpdf',compact('contrat','pieces'));

        return $pdf->stream();
    }
    public function avenant_type_contratpdf($id){

        $contrat=Contrat::find($id);
        $pdf = PDF::loadView('contrat.avenant',compact('contrat'));

        return $pdf->stream();
    }

    public function avenant($id){

        $contrat=Contrat::find($id);

        $contratprec= Contrat::where([['id_personne','=',$contrat->personne->id],['etat','=',2]])->orderby('date_debutc_eff','desc')->first();

        $listmodifavenants = Listmodifavenant::all();
        //dd($listmodifavenants);
        $listavn= Array();
        foreach($listmodifavenants as $listavenant):
            $listavn []= $listavenant->libelle;
        endforeach;
        $list_modif=\GuzzleHttp\json_decode($contrat->modification->list_modif);

        $array_intersection = array_intersect($listavn,$list_modif);
        $array_diff=array_diff($listavn,$list_modif);
       // dd($listavn);
        // dd($array_intersection);
        $pdf = PDF::loadView('contrat.avenant',compact('contrat','listmodifavenants','array_diff','array_intersection','contratprec'));

        return $pdf->stream();
    }
    public function avenant_renum_contratpdf($id){
        $contrat=Contrat::find($id);
        $pdf = PDF::loadView('contrat.avenant_renum_contratpdf',compact('contrat'));

        return $pdf->stream();
    }

}
