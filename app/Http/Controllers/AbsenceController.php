<?php

namespace App\Http\Controllers;

use App\Absence;
use App\Entite;
use App\Fonction;
use App\Personne;
use App\Services;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    //
    public function demande_absence()
    {
        $entite = Entite::all();
        $entites = Entite::all();
        $fonctions = Fonction::all();
        $services = Services::all();
        $personnes = Personne::all();
        $absences = Absence::all();
        return view('absences/ficheAbsence',compact('entite','entites','fonctions','services','personnes','absences'));
    }
}
