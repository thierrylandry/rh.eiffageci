<?php

namespace App\Http\Controllers;

use App\Avantagedotation;
use App\Categorie;
use App\Entite;
use App\Typecontrat;
use Illuminate\Http\Request;

class RecrutementController extends Controller
{
    //
    public function ajouter_recrutement(){

        $entites = Entite::all();
        $typecontrats = Typecontrat::all();
        $avantagedotations = Avantagedotation::all();
        $categories = Categorie::all();
        return view('recrutements/ficheRecrutement',compact('entites','typecontrats','avantagedotations','categories'));
    }

    public function lister_recrutement(){

$entites = Entite::all();
      //  return view('recrutements/ficheRecrutement',compact('entites'));
    }

    public function valider_recrutement(){

        $entites = Entite::all();
       // return view('recrutements/ficheRecrutement',compact('entites'));
    }

}
