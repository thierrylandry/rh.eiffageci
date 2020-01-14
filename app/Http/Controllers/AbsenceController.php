<?php

namespace App\Http\Controllers;

use App\Absence;
use App\Contrat;
use App\Entite;
use App\Fonction;
use App\Jobs\EnvoiesRefus;
use App\Personne;
use App\Personne_presente;
use App\Services;
use App\Type_permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    //
    public function demande_absence()
    {
        $entites = Entite::all();
        $personnes = Personne_presente::all();
        $absences = Absence::where('id_users',Auth::user()->id)->get();
        return view('absences/ficheAbsence',compact('entites','personnes','absences'));
    }
    public function modification($id)
    {
        $absence= Absence::find($id);
        $entites = Entite::all();
        $personnes = Personne_presente::all();
        $absences = Absence::where('id_users',Auth::user()->id)->get();
       // $contrat= Contrat::where('id')
        $contrat=Contrat::where('id_personne','=',$absence->id_personne)->where('etat','=',1)->first();


        return view('absences/ficheAbsence',compact('entites','personnes','absences','absence','contrat'));
    }
    public function ActionValider($id){
        $absence = Absence::find($id);

        $absence->etat=2;
        $absence->id_valideur=Auth::user()->id;

        $absence->save();

        return redirect()->route('modification.validation')->with('success',"La demande d'absence a été  validée avec succès");

    }
    public function ActionRejeter(Request $request){
        $parameters=$request->except(['_token']);

        $objet=$parameters['objet'];
        if($objet=="absence"){
            $id_dmd=$parameters['id_dmd'];

            $motif=$parameters['motif'];
            $absence = Absence::find($id_dmd);

            $absence->etat=4;
            $absence->id_valideur=Auth::user()->id;

            $absence->save();

            try{
                $this->dispatch(new EnvoiesRefus($absence,$motif,$objet));
            }catch(\Exception $exception){
                return redirect()->back()->with('warning',"La demande a été réfusé avec succès mais le mail du motif n'est pas parti .");
            }

            return redirect()->back()->with('success',"La demande a été réfusé");
        }


        return redirect()->back()->with('success',"La demande a été réfusé");

    }

    public function enregistrer(Request $request ){


        $parameters=$request->except(['_token']);
        //dd($parameters);


        //les valeurs initiales

        $id_personne=$parameters['id_personne'];
        $debut=$parameters['debut'];
        $fin=$parameters['fin'];
        $jour=$parameters['jour'];
        $reprise=$parameters['reprise'];


        $absence = new Absence();
        $absence->debut=$debut;
        $absence->fin=$fin;
        $absence->reprise=$reprise;
        $absence->id_personne=$id_personne;
        $absence->jour=$jour;
        $absence->id_users=Auth::user()->id;
        $absence->etat=1;



        $absence->save();

        return redirect()->back()->with('success',"La demande d'absence a été  enregistrée avec succès");

    }
    public function modifier(Request $request ){


        $parameters=$request->except(['_token']);
        //dd($parameters);


        //les valeurs initiales

        $id=$parameters['id'];
        $id_personne=$parameters['id_personne'];
        $debut=$parameters['debut'];
        $fin=$parameters['fin'];
        $jour=$parameters['jour'];
        $reprise=$parameters['reprise'];


        $absence = Absence::find($id);
        $absence->debut=$debut;
        $absence->fin=$fin;
        $absence->reprise=$reprise;
        $absence->jour=$jour;
        $absence->id_personne=$id_personne;
        $absence->id_users=Auth::user()->id;
        $absence->etat=1;



        $absence->save();

        return redirect()->back()->with('success',"La demande d'absence a été  modifiée avec succès");

    }
    public function type_permission($id){

        $absence= Absence::find($id);

        return \GuzzleHttp\json_encode($absence);
    }
    public function ajouter_type_permission(Request $request ){


        $parameters=$request->except(['_token']);
        //dd($parameters);


        //les valeurs initiales

        $id=$parameters['id'];
        $id_permission=$parameters['id_permission'];

        $absence = Absence::find($id);
        $absence->etat=3;
        $absence->id_type_permission=$id_permission;


        $absence->save();

        return redirect()->back()->with('success',"La demande d'absence est prête, vous pouvez télécharger le fichier PDF");

    }
    public function supprimer($id){
        $absence= Absence::find($id);

        $absence->delete();
        return redirect()->back()->with('success',"La demande d'absence a été  supprimée avec succès");
    }
    public function validation_absence(){
                $absences= Absence::where('etat','=',1)->get();
                $mode="validation";
        $entites=Entite::all();

                return view('absences/GestionAbsence',compact('absences','mode','entites'));
            }
    public function gestion_absence(){
                $absences= Absence::where('etat','>=',2)->get();
                $mode="gestion_absence";
        $entites=Entite::all();
        $type_permissions = Type_permission::all();
                return view('absences/GestionAbsence',compact('absences','mode','entites','type_permissions'));
            }
}
