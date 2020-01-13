<?php

namespace App\Http\Controllers;

use App\Entite;
use Illuminate\Http\Request;

class PoleDemandeController extends Controller
{
    //
    public function pole_de_demande(){

        $entites = Entite::all();
        return view('PoleDemande.pole_de_demande',compact('entites'));
    }
}
