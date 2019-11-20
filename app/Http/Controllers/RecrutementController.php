<?php

namespace App\Http\Controllers;

use App\Entite;
use Illuminate\Http\Request;

class RecrutementController extends Controller
{
    //
    public function ajouter_recrutement(){

$entites = Entite::all();
        return view('recrutements/ficheRecrutement',compact('entites'));
    }

    public function lister_recrutement(){

$entites = Entite::all();
        return view('recrutements/ficheRecrutement',compact('entites'));
    }

    public function valider_recrutement(){

        $entites = Entite::all();
        return view('recrutements/ficheRecrutement',compact('entites'));
    }

}
