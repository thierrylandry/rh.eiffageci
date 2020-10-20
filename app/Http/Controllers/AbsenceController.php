<?php

namespace App\Http\Controllers;

use App\Absconges;
use App\Absence;
use App\Conges;
use App\Contrat;
use App\Entite;
use App\Fonction;
use App\Jobs\EnvoiesDemandeValidation;
use App\Jobs\EnvoiesDemandeValidation_personnalise;
use App\Jobs\EnvoiesDemandeValider;
use App\Jobs\EnvoiesInformationDemandeur;
use App\Jobs\EnvoiesRefus;
use App\Personne;
use App\Personne_presente;
use App\Services;
use App\Type_permission;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AbsenceController extends Controller
{
    //
    public function demande_absence()
    {
        $entites = Entite::all();
        $personnes= $this->personne_correspondante_role(Auth::user());
        $absences = Absence::where('id_users',Auth::user()->id)->get();
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = gethostname();
        }else{
            $nommachine = $nommachine = gethostname();
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.' ;Demande dabsence', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return view('absences/ficheAbsence',compact('entites','personnes','absences'));
    }
    public function personne_correspondante_role($user){
        $personnes= Array();
        if(Auth::user()->hasRole('Ressource_humaine')){
            $personnes = Personne_presente::where('id_entite','=',Auth::user()->id_chantier_connecte)->orderBy('nom', 'ASC')->orderBy('prenom', 'ASC')->get();
        }elseif(Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_SEMELLES')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_CAISSONS')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_LABORATOIRE')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_MAINTENANCE')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_SOUDEURS')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_CENTRAL_A_BETON')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_NERVURE')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_BETON_PROJETE')){
            foreach($user->roles()->get() as $role):
                $tab_id_sous_service[]= $role->id_sous_service;
            endforeach;
            $personnes = Personne_presente::whereIn('id_sous_service',$tab_id_sous_service)->orderBy('nom', 'ASC')->orderBy('prenom', 'ASC')->get();
        }else{
            $personnes = Personne_presente::where('service','=',Auth::user()->id_service)->where('id_entite','=',Auth::user()->id_chantier_connecte)->orderBy('nom', 'ASC')->orderBy('prenom', 'ASC')->get();
        }

        return $personnes;
    }
    public function en_fonction_de_tes_roles_quel_est_la_force_de_ta_demande($id_personne){
        $etat=0;
        $personne =Personne_presente::find($id_personne);
        if(Auth::user()->hasRole('Ressource_humaine')){
            if(isset($personne) & $personne->id_sous_service==""){
                $etat=1;
            }else{
                $etat=0;
            }
        }elseif(Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_SEMELLES')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_CAISSONS')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_LABORATOIRE')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_MAINTENANCE')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_SOUDEURS')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_CENTRAL_A_BETON')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_NERVURE')||Auth::user()->hasRole('CONDUCTEUR_TRAVEAUX_BETON_PROJETE')){
            $etat=0;
        }else{
            $etat=1;
        }

        return $etat;
    }
    public function contact_a_notifier($absence_ou_conges){
        $contacts = Array();
        $users=User::where('id_chantier_connecte','=',Auth::user()->id_chantier_connecte)->get();
        $personne = Personne_presente::find($absence_ou_conges->id_personne);
        //dd($personne);
        if($absence_ou_conges->etat==0){
//dd($personne->sous_service->role->name);
            $libelle_role=$personne->sous_service->role->name;
            foreach($users as $user):
                if($user->hasRole($libelle_role)){
                    $contacts[]=$user->email;
                }
            endforeach;
        }elseif($absence_ou_conges->etat==1){
            foreach($users as $user):

                if($absence_ou_conges->user->hasRole('Chef_de_service') && $user->hasRole('Chef_de_projet')){
                    $contacts[]=$user->email;
                }
                if($user->hasRole('Chef_de_service') && $personne->lecontrat()->where('etat','=',1)->first()->id_service==$user->id_service){
                    $contacts[]=$user->email;

                }

            endforeach;
        }
        return $contacts;

    }
    public function modification($id)
    {
        $absence= Absence::find($id);
        $entites = Entite::all();
        $personnes= $this->personne_correspondante_role(Auth::user());
        $absences = Absence::where('id_users',Auth::user()->id)->get();
       // $contrat= Contrat::where('id')
        $contrat=Contrat::where('id_personne','=',$absence->id_personne)->where('etat','=',1)->first();

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = gethostname();
        }else{
            $nommachine = $nommachine = gethostname();
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.' ;page de modification de Demande dabsence n°'.$id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return view('absences/ficheAbsence',compact('entites','personnes','absences','absence','contrat'));
    }
    public function ActionValider($id){
        $absence = Absence::find($id);

        if($absence->etat==0){
            $absence->etat=2;
        }else{
            $absence->etat=2;
        }

        $absence->id_valideur=Auth::user()->id;

        $absence->save();
        $users =User::all();
        $contact=Array();
        $contactdemandeur=Array();
        foreach($users as $user):

            if($user->hasRole('Ressource_humaine')){
                $contact[]=$user->email;

            }

        endforeach;

        if(!empty($contact) && $absence->etat==2 ){
            $this->dispatch(new EnvoiesDemandeValider(3,$contact));
        }elseif($absence->etat==1){
            $contact=$this->contact_a_notifier($absence);
            if(!empty($contact)){
                $this->dispatch(new EnvoiesDemandeValidation_personnalise(3,$contact,$absence));
            }
        }
        $contactdemandeur[]=$absence->user()->first()->email;
        if(!empty($contactdemandeur)){
            $this->dispatch(new EnvoiesInformationDemandeur(3,$contactdemandeur,$absence));
        }

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.' ;validation de la Demande dabsence n°'.$id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->route('absence.validation')->with('success',"La demande d'absence a été  validée avec succès");

    }
    public function je_connais_tes_droits_je_te_notifie_pour_la_gestion($les_droits,$email){


        if(in_array('Ressource_humaine',$les_droits)){
            $this->dispatch(new EnvoiesDemandeValider(3,$email));
        }


    }
    public function ActionRejeter(Request $request){
        $parameters=$request->except(['_token']);
//dd($parameters);
        $objet=$parameters['objet'];
        $id_dmd="";
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
        }elseif($objet=="conge"){

            $id_dmd=$parameters['id_dmd'];

            $motif=$parameters['motif'];
            $conge =Absconges::find($id_dmd);

            $conge->etat=4;
            $conge->id_valideur=Auth::user()->id;

            $conge->save();

            try{
                $this->dispatch(new EnvoiesRefus($conge,$motif,$objet));
            }catch(\Exception $exception){
                return redirect()->back()->with('warning',"La demande a été réfusé avec succès mais le mail du motif n'est pas parti .");
            }
            return redirect()->back()->with('success',"La demande de congé a été réfusé");
        }

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.' ;rejet de la Demande dabsence n°'.$id_dmd, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
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
        if(isset($parameters['motif_perso'])){
            $motif=$parameters['motif_perso'];
            $absence->motif_perso=$motif;
        }

        $absence->id_users=Auth::user()->id;
        $absence->etat=$this->en_fonction_de_tes_roles_quel_est_la_force_de_ta_demande($id_personne);

//dd($absence->etat);
        $contact=$this->contact_a_notifier($absence);
        //dd($contact);
        $absence->save();

        if(!empty($contact)){
            $this->dispatch(new EnvoiesDemandeValidation_personnalise(3,$contact,$absence));
        }
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.' ;création de Demande dabsence n°'.$absence->id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->back()->with('success',"La demande d'absence a été  enregistrée avec succès");

    }
    public function je_connais_tes_droits_je_te_notifie_de_linformation_qui_te_concerne($les_droits,$email){


        if(in_array('Chef_de_service',$les_droits)){
            $this->dispatch(new EnvoiesDemandeValidation(3,$email));
        }


    }
    public function dit_moi_qui_tu_es_je_te_dirai_tes_droits($id_users){

        $roles=DB::table('user_role')
            ->join('roles', 'roles.id', '=', 'user_role.role_id')
            ->where('user_role.user_id','=',$id_users)
            ->select('roles.name')->get();
        $tab_roles= Array();
        foreach($roles as $rol):
            $tab_roles[]=$rol->name;
        endforeach;

        return $tab_roles;
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
        if(isset($parameters['motif_perso'])){
            $motif=$parameters['motif_perso'];
            $absence->motif_perso=$motif;
        }




        $absence->save();
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = gethostname();
        }else{
            $nommachine = $nommachine = gethostname();
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.' ;modification de Demande dabsence n°'.$absence->id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
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

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.' ;précision de type de modification pour la demande dabsence n°'.$absence->id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

        return redirect()->back()->with('success',"La demande d'absence est prête, vous pouvez télécharger le fichier PDF");

    }
    public function supprimer($id){
        $absence= Absence::find($id);

        $absence->delete();
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.' ;Suppression de demande dabsence n°'.$absence->id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return redirect()->back()->with('success',"La demande d'absence a été  supprimée avec succès");
    }
    public function validation_absence(){


        if(Auth::user()->hasRole('Chef_de_projet')){
            $absences = DB::table('absence')
                ->leftJoin('type_permission','type_permission.id','=','absence.id_personne')
                ->leftJoin('personne','personne.id','=','absence.id_personne')
                ->leftJoin('users','users.id','=','absence.id_users')
                ->leftJoin('user_role','user_role.user_id','=','users.id')
                ->leftJoin('roles','user_role.role_id','=','roles.id')
                ->leftJoin('contrat','personne.id','=','contrat.id_personne')
                ->where('absence.etat','=',1)->where('personne.id_entite','=',Auth::user()->id_chantier_connecte)
                ->where('roles.name','=','Chef_de_service')
                ->orwhere([['contrat.id_service','=',Auth::user()->id_service],['absence.etat','=',1]])
                ->groupBy('absence.id')
                ->select('absence.id','jour','debut','fin','reprise','absence.etat','users.nom as nom_users','users.prenoms as prenoms_users','personne.slug','personne.nom','personne.prenom')->get();
            $absences_valides_par_mois = DB::table('absence')
                ->leftJoin('type_permission','type_permission.id','=','absence.id_personne')
                ->leftJoin('personne','personne.id','=','absence.id_personne')
                ->leftJoin('users','users.id','=','absence.id_users')
                ->leftJoin('user_role','user_role.user_id','=','users.id')
                ->leftJoin('roles','user_role.role_id','=','roles.id')
                ->leftJoin('contrat','personne.id','=','contrat.id_personne')

                ->whereIn('absence.etat',[2,3,4])
                ->where('absence.id_valideur','=',Auth::user()->id)
                ->where('personne.id_entite','=',Auth::user()->id_chantier_connecte)
                ->groupBy('absence.id')
                ->select('absence.id','jour','debut','fin','reprise','absence.etat','users.nom as nom_users','users.prenoms as prenoms_users','personne.slug','personne.nom','personne.prenom')->get();
        }elseif(Auth::user()->hasRole('Chef_de_service')){
            //  dd('ici');
            $absences = DB::table('absence')
                ->leftJoin('type_permission','type_permission.id','=','absence.id_personne')
                ->leftJoin('personne','personne.id','=','absence.id_personne')
                ->leftJoin('users','users.id','=','absence.id_users')->where('absence.etat','=',1)
                ->where('personne.service','=',Auth::user()->id_service)
                ->where('personne.id','!=',Auth::user()->id_personne)
                ->where('personne.id_entite','=',Auth::user()->id_chantier_connecte)
                ->select('absence.id','jour','debut','fin','reprise','etat','users.nom as nom_users','users.prenoms as prenoms_users','personne.slug','personne.nom','personne.prenom')->get();
            $absences_valides_par_mois = DB::table('absence')
                ->leftJoin('type_permission','type_permission.id','=','absence.id_personne')
                ->leftJoin('personne','personne.id','=','absence.id_personne')
                ->leftJoin('users','users.id','=','absence.id_users')->WhereIn('absence.etat',[2,3,4])
                ->where('personne.service','=',Auth::user()->id_service)
                ->where('personne.id','!=',Auth::user()->id_personne)
                ->where('personne.id_entite','=',Auth::user()->id_chantier_connecte)
                ->select('absence.id','jour','debut','fin','reprise','etat','users.nom as nom_users','users.prenoms as prenoms_users','personne.slug','personne.nom','personne.prenom')->get();

        }else{
            //  dd('ici');
            $les_sous_service= array();
            foreach(Auth::user()->roles()->get() as $role):
                if($role->id_sous_service!=""){
                    $les_sous_service[]=$role->id_sous_service;
                }
            endforeach;
            $absences = DB::table('absence')
                ->leftJoin('type_permission','type_permission.id','=','absence.id_personne')
                ->leftJoin('personne_presente','personne_presente.id','=','absence.id_personne')
                ->leftJoin('users','users.id','=','absence.id_users')->where('absence.etat','=',0)
                ->where('personne_presente.service','=',Auth::user()->id_service)
                ->where('personne_presente.id_entite','=',Auth::user()->id_chantier_connecte)
                ->WhereIn('personne_presente.id_sous_service',$les_sous_service)
                ->select('absence.id','jour','debut','fin','reprise','etat','users.nom as nom_users','users.prenoms as prenoms_users','personne_presente.slug','personne_presente.nom','personne_presente.prenom')->get();
            $absences_valides_par_mois = DB::table('absence')
                ->leftJoin('type_permission','type_permission.id','=','absence.id_personne')
                ->leftJoin('personne','personne.id','=','absence.id_personne')
                ->leftJoin('users','users.id','=','absence.id_users')->whereIn('absence.etat',[0,4])
                ->where('personne.service','=',Auth::user()->id_service)
                ->where('personne.id','!=',Auth::user()->id_personne)
                ->where('personne.id_entite','=',Auth::user()->id_chantier_connecte)
                ->select('absence.id','jour','debut','fin','reprise','etat','users.nom as nom_users','users.prenoms as prenoms_users','personne.slug','personne.nom','personne.prenom')->get();

        }


                //$absences= Absence::where('etat','=',1)->get();
                $mode="validation";
        $entites=Entite::all();
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.' ;Page de validation des demandes dabsences ', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
                return view('absences/GestionAbsence',compact('absences','mode','entites','absences_valides_par_mois'));
            }
    public function gestion_absence(){
        $absences = DB::table('absence')
            ->leftJoin('type_permission','type_permission.id','=','absence.id_personne')
            ->leftJoin('personne','personne.id','=','absence.id_personne')
            ->leftJoin('users','users.id','=','absence.id_users')->where('etat','>=',2)
            ->where('personne.id_entite','=',Auth::user()->id_chantier_connecte)
            ->select('absence.id','jour','debut','fin','reprise','etat','users.nom as nom_users','users.prenoms as prenoms_users','personne.slug','personne.nom','personne.prenom')->get();

             //  $absences= Absence::where('etat','>=',2)->get();
                $mode="gestion_absence";
        $entites=Entite::all();
        $type_permissions = Type_permission::all();
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST']) && gethostbyaddr($_SERVER['REMOTE_ADDR'])!=""){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.' ;Page de gestion de demandes dabsences ', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
                return view('absences/GestionAbsence',compact('absences','mode','entites','type_permissions'));
            }
    public function absences_validation_collective(Request $request){

        $parameters=$request->except(['_token']);

        $mavariable=$parameters['mavariable'];

        $tab_id= explode(',',$mavariable);
     //   dd($tab_id);
        foreach($tab_id as $id):
            if($id!=""){
        $absence = Absence::find($id);

            $absence->etat=2;
            $absence->id_valideur=Auth::user()->id;

            $absence->save();
        $contactdemandeur[]=$absence->user()->first()->email;
        if(!empty($contactdemandeur)){
            $this->dispatch(new EnvoiesInformationDemandeur(3,$contactdemandeur,$absence));
        }
            }
        endforeach;
        if($id!="") {
            $users = User::all();
            $contact = Array();
            $contactdemandeur = Array();
            foreach ($users as $user):

                if ($user->hasRole('Ressource_humaine')) {
                    $contact[] = $user->email;

                }

            endforeach;

            if (!empty($contact)) {
                $this->dispatch(new EnvoiesDemandeValider(3, $contact));
            }
        }

        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.' ;validation collective de demande dabsence '.$mavariable, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);

    }
    public function telecharger_doc_absence($id){

        $absence = Absence::find($id);
        $personne= Personne_presente::find($absence->id_personne);
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.' ;téléchargement de demande dabsence n°'.$id, ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
       // dd($absence->personne);
        $pdf = PDF::loadView('absences.documentAbs',compact('absence','personne'));
        return $pdf->stream();
      //  return view('absences/documentAbs',compact('absence','personne'));
    }
}
