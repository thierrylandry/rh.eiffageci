<?php

namespace App\Http\Controllers;

use App\Absence;
use App\Entite;
use App\Fonction;
use App\Personne;
use App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    //
    public function demande_absence()
    {
        $entites = Entite::all();
        $personnes = Personne::all();
        $absences = Absence::where('id_users',Auth::user()->id)->get();
        return view('absences/ficheAbsence',compact('entites','personnes','absences'));
    }
    public function modification($id)
    {
        $absence= Absence::find($id);
        $entites = Entite::all();
        $personnes = Personne::all();
        $absences = Absence::where('id_users',Auth::user()->id)->get();
        return view('absences/ficheAbsence',compact('entites','personnes','absences','absence'));
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
}
