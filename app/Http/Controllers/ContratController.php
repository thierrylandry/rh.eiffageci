<?php

namespace App\Http\Controllers;

use App\Contrat;
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
        return view('contrat/contrat_new_user',compact('personne','services','typecontrats'));
    }
    public function affiche_contrat($slug){
        $personne= Personne::where('slug','=',$slug)->get()->first();
        $services = Services::all();
        $typecontrats= Typecontrat::all();
        return view('contrat/contrat_affiche',compact('personne','services','typecontrats'));
    }

    public function lister_contrat($slug){
        $personne= Personne::where('slug','=',$slug)->get()->first();
        $services = Services::all();
        $typecontrats= Typecontrat::all();
        $contrats = Contrat::where('id_personne','=',$personne->id)->get();

        return view('contrat/lister_contrat',compact('personne','services','typecontrats','contrats'));
    }

    public function update_contrat( Request $request){
        dd("mise a jours");
        $parameters=$request->except(['_token']);
        $slug=$parameters["slug"];
        $matricule=$parameters["matricule"];
        $couverture_maladie=$parameters["couverture_maladie"];
        $dateDebutC=$parameters["dateDebutC"];
        $dateFinC= $parameters["dateFinC"];
        $type_de_contrat= $parameters["type_de_contrat"];
        $periode_essaie= $parameters["periode_essaie"];

        $contrat= new Contrat();

        $contrat->matricule=$matricule;
        $contrat->periode_essaie=$periode_essaie;
        $contrat->couvertureMaladie=$couverture_maladie;
        $contrat->dateDebutC=$dateDebutC;
        $contrat->dateFinC=$dateFinC;
        $contrat->id_type_contrat=$type_de_contrat;
        $contrat->id_service=$type_de_contrat;
        $personne = Personne::where('slug','=',$slug)->get()->first();
        $personne->matricule=$matricule;
        $contrat->id_personne=$personne->id;

        $contrat->save();


        return redirect()->route('lister_personne')->with('success',"Le contrat  a été ajoutée avec succès");
    }
    public function save_contrat( Request $request){
        $parameters=$request->except(['_token']);
        $slug=$parameters["slug"];
        $matricule=$parameters["matricule"];
        $couverture_maladie=$parameters["couverture_maladie"];
        $dateDebutC=$parameters["dateDebutC"];
       $dateFinC= $parameters["dateFinC"];
       $type_de_contrat= $parameters["type_de_contrat"];
       $periode_essaie= $parameters["periode_essaie"];

        $contrat= new Contrat();

        $contrat->matricule=$matricule;
        $contrat->periode_essaie=$periode_essaie;
        $contrat->couvertureMaladie=$couverture_maladie;
        $contrat->dateDebutC=$dateDebutC;
        $contrat->dateFinC=$dateFinC;
        $contrat->id_type_contrat=$type_de_contrat;
        $contrat->id_service=$type_de_contrat;
        $personne = Personne::where('slug','=',$slug)->get()->first();
        $personne->matricule=$matricule;
        $contrat->id_personne=$personne->id;

        $contrat->save();


        return redirect()->route('lister_personne')->with('success',"Le contrat  a été ajoutée avec succès");
    }
}
