<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContratController extends Controller
{
    //
    public function contrat_new_user(){

        return view('contrat/contrat_new_user');
    }
}
