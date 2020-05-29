<?php

namespace App\Http\Controllers;

use App\Entite;
use App\Jobs\EnvoiesDemandeValider;
use App\Listmodifavenant;
use App\Modification;
use App\Personne;
use App\Personne_presente;
use App\Personne_presente_le_service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoleDemandeController extends Controller
{
    //
    public function pole_de_demande(){

        $entites = Entite::all();
        return view('PoleDemande.pole_de_demande',compact('entites'));
    }
    public function avenant_general()
    {
        $personnesactives = Personne_presente::all();
        $tab = Array();
        foreach($personnesactives as $pers):
            $tab[]=$pers->id;
        endforeach;
        $listmodificationavenants=Listmodifavenant::all();
        $personnes= Personne::with("fonction","pays","societe")
            ->where('id_entite','=',Auth::user()->id_entite)
            ->whereIn('id',$tab)
            ->orderBy('id', 'desc')
            ->paginate(300);
        $entites= Entite::all();

//dd($personnes->first()->fonction()->first()->libelle);
        return view('avenant_general/avenant_general',compact('personnes','entites','entite','listmodificationavenants'));
    }

    public function avenant_collectif(Request $request){

        $parameters=$request->except(['_token']);

        $mavariable=$parameters['mavariable'];

        $tab_id= explode(',',$mavariable);
        //   dd($tab_id);
        $lesServices= Array();
        foreach($tab_id as $id):
            if($id!=""){
                $modification = new  Modification();

                $id_service =Personne_presente_le_service::find($id)->id_service;
                if(!in_array($id_service,$lesServices)){
                    $lesServices=$id_service;
                }

                $modification->id_personne=$id;
                $modification->etat=1;
                $modification->id_service=$id_service;
                $modification->id_users=Auth::user()->id;

                $modification->save();
                $contactdemandeur[]=$modification->user()->first()->email;
            }
        endforeach;
        if(!empty($lesServices)) {

            foreach($lesServices as $service):
            $users = User::where('id_servie','=',$service)->get();
            $contact = Array();
            foreach ($users as $user):

                if ($user->hasRole('Chef_de_service')) {
                    $contact[] = $user->email;

                }

            endforeach;

            if (!empty($contact)) {
                $this->dispatch(new EnvoiesDemandeValider(6, $contact));
            }
            endforeach;
        }


    }
}
