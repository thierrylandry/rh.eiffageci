<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EpiController extends Controller
{
    //
    public function gestion_epi()
    {

        return view('epi/gestion_epi');
    }
}
