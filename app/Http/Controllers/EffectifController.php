<?php

namespace App\Http\Controllers;

use App\Effectif;
use Illuminate\Http\Request;

class EffectifController extends Controller
{
    //

    public function effectif(){
        $effectifs = Effectif::All();

        return view('effectif/effectif',compact('effectifs'));
    }
}
