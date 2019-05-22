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
    public function contrat_new_user2($slug){
        $personne= Personne::where('slug', $slug)->get()->first();
        $services = Services::all();
        $typecontrats= Typecontrat::all();
        return view('contrat/contrat_affiche',compact('personne','services','typecontrats'));
    }
    public function affiche_contrat($id){
        $contrat= Contrat::find($id);
        $personne= Personne::find($contrat->id_personne);

        $services = Services::all();
        $typecontrats= Typecontrat::all();
        return view('contrat/contrat_affiche',compact('personne','services','typecontrats','contrat'));
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
        $periode_essaie= $parameters["periode_essaie"];
        $ruptureEssai= $parameters["ruptureEssai"];
        $departdefinitif= $parameters["departdefinitif"];
        $dateInduction= $parameters["dateInduction"];

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
        $contrat->id_service=$type_de_contrat;
        $personne = Personne::where('slug','=',$slug)->get()->first();
        $personne->matricule=$matricule;
        $contrat->id_personne=$personne->id;

        $contrat->save();


        return redirect()->route('lister_contrat',['slug'=>$personne->slug])->with('success',"Le contrat  a été modifié avec succès");
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


        return redirect()->route('lister_personne')->with('success',"Le contrat  a été ajouté avec succès");
    }
}
