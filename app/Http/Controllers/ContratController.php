<?php

namespace App\Http\Controllers;

use App\Contrat;
use App\Definition;
use App\Personne;
use App\Services;
use App\Typecontrat;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    //

    public function contrat_new_user(){
        $personne= Personne::orderBy('id', 'desc')->get()->first();
$services = Services::all();
        $typecontrats= Typecontrat::all();
        $definitions = Definition::all();
        return view('contrat/contrat_new_user',compact('personne','services','typecontrats','definitions'));
    }
    public function contrat_new_user2($slug){
        $definitions = Definition::all();
        $personne= Personne::where('slug', $slug)->get()->first();
        $services = Services::all();
        $typecontrats= Typecontrat::all();
        return view('contrat/contrat_affiche',compact('personne','services','typecontrats','definitions'));
    }
    public function affiche_contrat($id){
        $contrat= Contrat::find($id);
        $personne= Personne::find($contrat->id_personne);

        $services = Services::all();
        $definitions = Definition::all();
        $typecontrats= Typecontrat::all();
        return view('contrat/contrat_affiche',compact('personne','services','typecontrats','contrat','definitions'));
    }

    public function lister_contrat($slug){
        $personne= Personne::where('slug','=',$slug)->get()->first();
        $services = Services::all();
        $typecontrats= Typecontrat::all();
        $contrats = Contrat::where('id_personne','=',$personne->id)->get();


        return view('contrat/lister_contrat',compact('personne','services','typecontrats','contrats'));
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
        $email= $parameters["email"];
        $contact= $parameters["contact"];

        $contrat=  Contrat::find($id_contrat);

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
        $personne->matricule=$matricule;
        $personne->service=$service;
        $personne->save();

        $contrat->id_personne=$personne->id;
        $contrat->id_definition=$id_definition;
        $contrat->email=$email;
        $contrat->contact=$contact;

        $contrat->save();


        return redirect()->route('lister_contrat',['slug'=>$personne->slug])->with('success',"Le contrat  a été modifié avec succès");
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
        $id_definition= $parameters["id_definition"];
        $contrat= new Contrat();

        $contrat->matricule=$matricule;
        $contrat->periode_essaie=$periode_essaie;
        $contrat->couvertureMaladie=$couverture_maladie;
        $contrat->dateDebutC=$dateDebutC;
        $contrat->dateFinC=$dateFinC;
        $contrat->id_type_contrat=$type_de_contrat;
        $contrat->id_service=$service;
        $personne = Personne::where('slug','=',$slug)->get()->first();
        $personne->matricule=$matricule;
        $personne->service=$service;
        $personne->save();

        //changer l'etat de tout les anciens contrats
        $ancien_contrat=  Contrat::where('id_personne','=',$personne->id)->get()->first();
        if(!empty($ancien_contrat)){
            $ancien_contrat->etat=2;
            $ancien_contrat->save();
        }

        $contrat->id_personne=$personne->id;
        $contrat->email=$email;
        $contrat->contact=$contact;
        $contrat->id_definition=$id_definition;

        $contrat->save();


        return redirect()->route('lister_personne')->with('success',"Le contrat  a été ajouté avec succès");
    }
}
