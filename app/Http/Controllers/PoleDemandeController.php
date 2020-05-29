<?php

namespace App\Http\Controllers;

use App\Entite;
use App\Jobs\EnvoiesDemandeCollectif;
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
            ->whereIn('id',$tab)
            ->where('id_entite','=',Auth::user()->id_entite)

            ->orderBy('id', 'desc')
            ->paginate(300);
        $entites= Entite::all();

//dd($personnes->first()->fonction()->first()->libelle);
        return view('avenant_general/avenant_general',compact('personnes','entites','listmodificationavenants'));
    }

    public function avenant_collectif(Request $request){

        $parameters=$request->except(['_token']);

        $mavariable=$parameters['mavariable'];
        $liste_avenant=$parameters['liste_avenant'];
       // dd($mavariable);
        $tab_id= explode(',',$mavariable);
      //  dd($tab_id);
        //   dd($tab_id);
        $lesServices= Array();
        $nb =0;
        foreach($tab_id as $id):

            if($id!=""){
                $nb++;
                $modification = new  Modification();
//dd($id);
                $varr=Personne_presente_le_service::find($id);
                if(isset($varr)){
                    $id_service =$varr->id_service;
                    //  dd($id_service);
                    if(!in_array($id_service,$lesServices)){
                        $lesServices[]=$id_service;
                    }
                    $modification->id_personne=$id;
                    $modification->etat=1;
                    $modification->id_typeModification=3;
                    $modification->id_service=$id_service;
                    $modification->list_modif=\GuzzleHttp\json_encode($liste_avenant);
                    $modification->id_users=Auth::user()->id;

                    $modification->save();
                    $contactdemandeur[]=$modification->user()->first()->email;
                }



            }
        endforeach;
        if(!empty($lesServices)) {

            foreach($lesServices as $service):
            $users = User::where('id_service','=',$service)->get();
            $contact = Array();
            foreach ($users as $user):

                if ($user->hasRole('Chef_de_projet')) {
                    $contact[] = $user->email;

                }


            endforeach;

               // dd($contact);
            if (!empty($contact)) {
                $this->dispatch(new EnvoiesDemandeCollectif(6, $contact,$nb));
            }
            endforeach;
        }
        return redirect()->back()->with('success',"Les demandes d'avenant générales ont été enregistré avec succès");

    }
}
