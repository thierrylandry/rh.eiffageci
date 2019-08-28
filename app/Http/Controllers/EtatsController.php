<?php

namespace App\Http\Controllers;

use App\Fin_contrat;
use App\Jobs\EnvoieFincontrat;
use App\Liste_telephonique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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


    public function mailfin_contrat(){
        $contrats= Fin_contrat::all();
        $contact[]="cyriaque.kodia@eiffage.com";
        $contact[]="thierry.koffi@eiffage.com";
        $this->dispatch(new EnvoieFincontrat($contact,$contrats) );

        //return view('mail/mailfincontrat',compact('contrats'));
    }
}
