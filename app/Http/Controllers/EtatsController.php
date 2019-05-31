<?php

namespace App\Http\Controllers;

use App\Fin_contrat;
use App\Liste_telephonique;
use Illuminate\Http\Request;

class EtatsController extends Controller
{
    //
    public function repertoire(){
$repertoires= Liste_telephonique::all();

        return view('etats/repertoire',compact('repertoires'));
    }
    public function fin_contrat(){
        $contrats= Fin_contrat::all();

        return view('etats/fin_contrat',compact('contrats'));
    }
}
