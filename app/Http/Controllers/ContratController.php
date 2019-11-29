<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Contrat;
use App\Definition;
use App\Entite;
use App\Personne;
use App\Services;
use App\Typecontrat;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    //

    public function contrat_new_user(){
        $personne= Personne::orderBy('id', 'desc')->get()->first();
$services = Services::all();
        $typecontrats= Typecontrat::all();
        $definitions = Definition::all();
        $entites= Entite::all();
        return view('contrat/contrat_new_user',compact('personne','services','typecontrats','definitions','entites'));
    }
    public function contrat_new_user2($slug){
        $definitions = Definition::all();
        $personne= Personne::where('slug', $slug)->get()->first();
        $services = Services::all();
        $typecontrats= Typecontrat::all();
        $entites= Entite::all();
        return view('contrat/contrat_affiche',compact('personne','services','typecontrats','definitions','entites'));
    }
    public function listercat($id_definition){
        $categories = Categorie::where('id_definition','=',$id_definition)->distinct('libelle')->get();

       return $categories;
    }
    public function affiche_contrat($id){
        $contrat= Contrat::find($id);
        $categories = Categorie::where('id_definition','=',$contrat->id_definition)->get();
        $personne= Personne::find($contrat->id_personne);

        $services = Services::all();
        $definitions = Definition::all();
        $typecontrats= Typecontrat::all();
        $entites= Entite::all();
        return view('contrat/contrat_affiche',compact('personne','services','typecontrats','contrat','definitions','categories','entites'));
    }

    public function lister_contrat($slug){
        $personne= Personne::where('slug','=',$slug)->get()->first();
        $services = Services::all();
        $typecontrats= Typecontrat::all();
        $contrats = Contrat::where('id_personne','=',$personne->id)
            ->orderBy('datedebutc','DESC')->get();
        $entites= Entite::all();

        return view('contrat/lister_contrat',compact('personne','services','typecontrats','contrats','entites'));
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

        $slug=$parameters["slug"];


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

        if(isset($parameters["id_categorie"])){
            $id_categorie= $parameters["id_categorie"];
        }else{
            $id_categorie='';
        }

        $contrat= new Contrat();

        $contrat->matricule=$matricule;
        $contrat->position=$position;
        $contrat->periode_essaie=$periode_essaie;
        $contrat->couvertureMaladie=$couverture_maladie;
        $contrat->dateDebutC=$dateDebutC;
        $contrat->dateFinC=$dateFinC;
        $contrat->id_type_contrat=$type_de_contrat;
        $contrat->id_service=$service;
        $personne = Personne::where('slug','=',$slug)->get()->first();



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

        return redirect()->route('lister_personne',['entite'=>$entite])->with('success',"Le contrat  a été ajouté avec succès");
    }
    public function contratCDDpdf(){

        $pdf = PDF::loadView('contrat.contratCDDpdf');

        return $pdf->stream();
    }public function contratCDIpdf(){

        $pdf = PDF::loadView('contrat.contratCDIpdf');

        return $pdf->stream();
    }
    public function renouvellement_contratpdf(){

        $pdf = PDF::loadView('contrat.renouvelement_contratpdf');

        return $pdf->stream();
    }
    public function avenant_contratpdf(){

        $pdf = PDF::loadView('contrat.avenant_contratpdf');

        return $pdf->stream();
    }
}
