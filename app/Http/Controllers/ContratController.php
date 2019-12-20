<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Contrat;
use App\Definition;
use App\Entite;
use App\Metier\Json\Rubrique;
use App\Modification;
use App\Nature_contrat;
use App\Personne;
use App\Recrutement;
use App\Rubrique_salaire;
use App\Salaire;
use App\Services;
use App\Typecontrat;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

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
        if($personne->entretien_cs==1 && $personne->entretien_rh==1 && ($personne->visite_medicale==1 || $personne->date_visite!="")){
            return view('contrat/contrat_new_user',compact('personne','services','typecontrats','definitions','entites','nature_contrats'));
        }else{
            return redirect()->back()->with('error',"Cette personne n'a pas subit les entretiens préliminaires donc ne peut pas avoir de contrat");
        }

    }
    public function contrat_new_user2($id,$id_typeModification){

        $modification=null;
        $recrutement=null;
        if($id_typeModification==2 || $id_typeModification==3){
            $modification_recrutement= Modification::find($id);
            $personne= Personne::find($modification_recrutement->id_personne);
        }else{
            $modification_recrutement= Recrutement::find($id);
            $personne=null;
        }

        $definitions = Definition::all();


        $contrat= Contrat::where('id_personne','=',$personne->id)->orderby('datedebutc','desc')->first();
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
        if($personne->entretien_cs==1 && $personne->entretien_rh==1 && ($personne->visite_medicale==1 || $personne->date_visite!="")){
            return view('contrat/contrat_affiche',compact('personne','services','typecontrats','definitions','entites','nature_contrats','contrat','ancien_contrat','categories','rubrique_salaires','recrutements','valeurSalaire','id_nature_contrat','recrutement','modification_recrutement','id_typeModification'));
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
        $categories = Categorie::where('id_definition','=',$contrat->id_definition)->get();
        $personne= Personne::find($contrat->id_personne);

        $services = Services::all();
        $definitions = Definition::all();
        $typecontrats= Typecontrat::all();
        $entites= Entite::all();
        $nature_contrats= Nature_contrat::all();
        return view('contrat/contrat_affiche',compact('personne','services','typecontrats','contrat','definitions','categories','entites','nature_contrats'));
    }

    public function lister_contrat($slug){
        $personne= Personne::where('slug','=',$slug)->get()->first();
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
        return redirect()->route('lister_contrat',['slug'=>$slug])->with('success',"Le contrat  a été rompu");
    }
    public function save_contrat( Request $request){



        $parameters=$request->except(['_token']);
        //    dd($parameters);
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
       $dateFinC= $parameters["dateFinC"];
       $type_de_contrat= $parameters["type_de_contrat"];
       $service= $parameters["service"];
       $periode_essaie= $parameters["periode_essaie"];
        $email= $parameters["email"];
        $contact= $parameters["contact"];
        $position= $parameters["position"];
        $id_definition= $parameters["id_definition"];
        $regime= $parameters["regime"];
        $id_nature_contrat= $parameters["id_typeModification"];
        $id_recrutement_modification= $parameters["id_recrutement_modification"];


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
        $contrat->dateFinC=$dateFinC;
        $contrat->id_type_contrat=$type_de_contrat;
        $contrat->id_service=$service;
        $contrat->id_nature_contrat=$id_nature_contrat;
        $contrat->regime=$regime;
        if($id_nature_contrat==1){
            $contrat->id_recrutement=$id_recrutement_modification;
            $recrutement= Recrutement::find($id_recrutement_modification);
            $recrutement->etat=3;
            $recrutement->save();

        }else{
            $contrat->id_modification=$id_recrutement_modification;
            $modification= Modification::find($id_recrutement_modification);
            $modification->etat=3;
            $modification->save();
        }


        //changer l'etat de tout les anciens contrats
        $ancien_contrat=  Contrat::where('id_personne','=',$personne->id)
                          ->orderby('datedebutc','DESC')
                          ->first();
     //   dd($ancien_contrat);


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

        return redirect()->route('Modifications.gestion')->with('success',"Le contrat  a été ajouté avec succès");
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
    public function contratCDDpdf(){

        $pdf = PDF::loadView('contrat.contratCDDpdf');

        return $pdf->stream();
    }
    public function contratCDIpdf(){

        $pdf = PDF::loadView('contrat.contratCDIpdf');

        return $pdf->stream();
    }
    public function renouvellement_contratpdf($id){

        $contrat=Contrat::find($id);

        $pdf = PDF::loadView('contrat.renouvellement_contratpdf',compact('contrat'));

        return $pdf->stream();
    }
    public function avenant_type_contratpdf(){

        $pdf = PDF::loadView('contrat.avenant_type_contratpdf');

        return $pdf->stream();
    }
    public function avenant_renum_contratpdf(){

        $pdf = PDF::loadView('contrat.avenant_renum_contratpdf');

        return $pdf->stream();
    }
}
