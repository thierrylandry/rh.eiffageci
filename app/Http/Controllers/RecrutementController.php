<?php

namespace App\Http\Controllers;

use App\Assurance_maladie;
use App\Avantagedotation;
use App\Categorie;
use App\Debit_internet;
use App\Entite;
use App\Forfait;
use App\Typecontrat;
use Illuminate\Http\Request;

class RecrutementController extends Controller
{
    //
    public function ajouter_recrutement(){

        $entites = Entite::all();
        $typecontrats = Typecontrat::all();
       // $avantagedotations = Avantagedotation::all();
        $debit_internets=Debit_internet::all();
        $forfaits = Forfait::all();
        $assurance_maladies= Assurance_maladie::all();
        $categories = Categorie::all();
        return view('recrutements/ficheRecrutement',compact('entites','typecontrats','categories','debit_internets','forfaits','assurance_maladies'));
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
