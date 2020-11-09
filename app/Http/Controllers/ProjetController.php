<?php

namespace App\Http\Controllers;

use App\Entite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjetController extends Controller
{
    //
    public function projet(){

        $entites= Entite::all();
        $projet = Entite::find(Auth::user()->id_chantier_connecte);
        return view('projet.detail_projet',compact('projet','entites'));
    }
    public function modifier_projet(Request $request){
        $parameters=$request->except(['_token']);
        $id=$parameters['id'];
        $libelle=$parameters['libelle'];
        $representant=$parameters['representant'];
        $description=$parameters['description'];
        $genre=$parameters['genre'];
        $projet =  Entite::find($id);
        $projet->libelle=$libelle;
        $projet->representant=$representant;
        $projet->description=$description;
        $projet->genre=$genre;

        if(isset($request->all()['logo'])){
            $data['logo']=$request->all()['logo'];
            $data['instension']=$request->file('logo')->getClientOriginalExtension();
            $path = Storage::putFileAs(
                'images/projet', $request->file('logo'), $libelle.'.'.$request->file('logo')->getClientOriginalExtension()
            );
            $projet->logo=$libelle.'.'.$data['instension'];
        }else{

        }


        $projet->save();

        return redirect()->back()->with('success',"Le projet a été mis à jour");
    }
}
