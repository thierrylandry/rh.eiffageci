<?php

namespace App\Http\Controllers;

use App\Absence;
use App\Contrat;
use App\Entite;
use App\Fonction;
use App\Personne;
use App\Personne_presente;
use App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    //
    public function demande_absence()
    {
        $entites = Entite::all();
        $personnes = Personne_presente::all();
        $absences = Absence::where('id_users',Auth::user()->id)->get();
        return view('absences/ficheAbsence',compact('entites','personnes','absences'));
    }
    public function modification($id)
    {
        $absence= Absence::find($id);
        $entites = Entite::all();
        $personnes = Personne_presente::all();
        $absences = Absence::where('id_users',Auth::user()->id)->get();
       // $contrat= Contrat::where('id')
        $contrat=Contrat::where('id_personne','=',$absence->id_personne)->where('etat','=',1)->first();


        return view('absences/ficheAbsence',compact('entites','personnes','absences','absence','contrat'));
    }
    public function ActionValider($id){
        $recruement = Modification::find($id);
        $date= new DateTime(null);

        $recruement->etat=2;
        $recruement->id_validateur=Auth::user()->id;

        $recruement->save();

        return redirect()->route('modification.validation')->with('success',"La demande de recrutement a été  validée avec succès");

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

    public function enregistrer(Request $request ){


        $parameters=$request->except(['_token']);
        //dd($parameters);


        //les valeurs initiales

        $id_personne=$parameters['id_personne'];
        $debut=$parameters['debut'];
        $fin=$parameters['fin'];
        $jour=$parameters['jour'];
        $reprise=$parameters['reprise'];


        $absence = new Absence();
        $absence->debut=$debut;
        $absence->fin=$fin;
        $absence->reprise=$reprise;
        $absence->id_personne=$id_personne;
        $absence->jour=$jour;
        $absence->id_users=Auth::user()->id;
        $absence->etat=1;



        $absence->save();

        return redirect()->back()->with('success',"La demande d'absence a été  enregistrée avec succès");

    }
    public function modifier(Request $request ){


        $parameters=$request->except(['_token']);
        //dd($parameters);


        //les valeurs initiales

        $id=$parameters['id'];
        $id_personne=$parameters['id_personne'];
        $debut=$parameters['debut'];
        $fin=$parameters['fin'];
        $jour=$parameters['jour'];
        $reprise=$parameters['reprise'];


        $absence = Absence::find($id);
        $absence->debut=$debut;
        $absence->fin=$fin;
        $absence->reprise=$reprise;
        $absence->jour=$jour;
        $absence->id_personne=$id_personne;
        $absence->id_users=Auth::user()->id;
        $absence->etat=1;



        $absence->save();

        return redirect()->back()->with('success',"La demande d'absence a été  modifiée avec succès");

    }
    public function supprimer($id){
        $absence= Absence::find($id);

        $absence->delete();
        return redirect()->back()->with('success',"La demande d'absence a été  supprimée avec succès");
    }
    public function validation_absence(){
                $absences= Absence::where('etat','=',1)->get();
                $mode="validation";
        $entites=Entite::all();
                return view('absences/GestionAbsence',compact('absences','mode','entites'));
            }
}
