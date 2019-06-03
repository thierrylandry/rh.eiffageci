<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function utilisateur(){
        $utilisateurs= User::all();

        return view('utilisateurs/utilisateurs',compact('utilisateurs'));

    }
}
