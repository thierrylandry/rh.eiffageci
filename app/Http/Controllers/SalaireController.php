<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaireController extends Controller
{
    //
    public function salaires(){
        $personnes= DB::table('personne')
            ->leftjoin('fonctions','fonctions.id','=','personne.fonction')
            ->select('personne.id','personne.nom','personne.prenom','sexe','entite','id_societe','personne.slug','fonctions.libelle','nationalite')
            ->orderBy('id', 'desc')->get();
        return view('salaires/liste_personnel',compact('personnes'));
    }
}
