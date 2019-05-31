<?php

namespace App\Http\Controllers;

use App\Invite;
use Illuminate\Http\Request;

class InviterController extends Controller
{
    //
public function invite(){
    $invietes= Invite::all();



    return view('invite/gestion_invite',compact('invietes'));
}
public function save_invite( Request $request){
    dd($request);
    $invietes= Invite::all();



    return view('invite/gestion_invite',compact('invietes'));
}
}
