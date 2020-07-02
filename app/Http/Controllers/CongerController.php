<?php

namespace App\Http\Controllers;

use App\Absconges;
use App\Conges;
use App\Contrat;
use App\Entite;
use App\Jobs\EnvoiesDemandeValidation;
use App\Jobs\EnvoiesDemandeValider;
use App\Jobs\EnvoiesInformationDemandeur;
use App\Personne;
use App\Personne_presente;
use App\Type_conges;
use App\Type_permission;
use App\User;
use App\VarpersonneConges;
use Barryvdh\DomPDF\Facade as PDF;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;

class CongerController extends Controller
{



    //calcul des années bissextiles
    function leap_year($year)
    {
        return date("L", mktime(0, 0, 0, 1, 1, $year));
    }

    function nb_jours( $date1, $date2 )
    {

        $timestamp1    = strtotime($date1);
        $timestamp2    = strtotime($date2);

        $tot = 0; //total de jours entre les 2 dates

        //dates en jours de l'année ( depuis le 1er jan )
        $date1 = date("z", $timestamp1) ; // date de depart
        $date2 = date("z", $timestamp2) ; //date d'arrivée

        $day_stamp = 86400 ; //(3600 * 24 ); // un journée en timestamp

        //années des deux dates
        $year1 = date("Y", $timestamp1) ;
        $year2 = date("Y", $timestamp2) ;

        $num = 0; //nombre de jours feries a compter sur la duree totale
        $counter = 0; // la durée entre deux date par année

        $year = $year1; // l'année en cours ( defaut : $year1 )


//on calcule le nombre de jours de difference entre les deux dates, en tenant
// compte des années
        while ( $year <= $year2 )
        {
            $date3         = date("d-n-Y", mktime(0, 0, 0, 1,  1,  $year));
            $timestamp3 = strtotime($date3);
// date de référence pour l'année en cours
            $counter = 0; // compteur de jours pour chaque année

            //on récupère la date de pâques
            $easterDate   = easter_date($year) ;
            $easterDay    = date('j', $easterDate) ;
            $easterMonth  = date('n', $easterDate) ;
            $easterYear   = date('Y', $easterDate) ;


            //le tableau sort les jours fériés de l'année depuis le premier janvier
            $closed = array
            (
                // dates fixes
                date("z", mktime(0, 0, 0, 1,  1,  $year)),  // 1er janvier
                date("z", mktime(0, 0, 0, 5,  1,  $year)),  // Fête du travail
                date("z", mktime(0, 0, 0, 5,  8,  $year)),  // Victoire des alliés
                date("z", mktime(0, 0, 0, 7,  14, $year)),  // Fête nationale
                date("z", mktime(0, 0, 0, 8,  15, $year)),  // Assomption
                date("z", mktime(0, 0, 0, 11, 1,  $year)),  // Toussaint
                date("z", mktime(0, 0, 0, 11, 11, $year)),  // Armistice
                date("z", mktime(0, 0, 0, 12, 25, $year)),  // Noel

                // Dates basées sur Paques
                date("z", mktime(0, 0, 0, $easterMonth, $easterDay + 1, $easterYear)
                ),  // Lundi de Paques
                date("z", mktime(0, 0, 0, $easterMonth, $easterDay + 39, $easterYear
                )), // Ascension
                date("z", mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear
                ))  // Lundi de Pentecote

            );

            //si c'est la première année -> on commence par la date de depart;
            //le compteur compte les jours jusqu'au 31dec
            if( $year == $year1 && $year < $year2 )
            {
                $i = $date1;
                $counter +=  (364+$this->leap_year($year)) ;
            }


// si c'est ni la première ni la derniere année -> on commence au premier
// janvier;
            //le compteur compte tous les jours de l'année
            if( $year > $year1 && $year < $year2 )
            {
                $i = date("z", mktime(0, 0, 0, 1,  1,  $year));
                $counter += 364+$this->leap_year($year);
            }

            // si c'est la dernière année -> on commence au premier janvier;
            //le compteur va jusqu'a la date d'arrivée
            if( $year == $year2 && $year > $year1 )
            {
                $i = date("z", mktime(0, 0, 0, 1,  1,  $year));
                $counter += $date2 ;
            }

            // si les deux dates sont dans la même année
            if( $year == $year1 && $year == $year2 )
            {
                $i = $date1;
                $counter += $date2 ;
            }

            //on boucle les jours sur la période donnée
            while ( $i <= $counter )
            {
                $tot = $tot +1; // on ajoute 1 pour chaque jour passé en revue

                if( in_array($i, $closed) )
                {
                    $num++; // on ajoute 1 pour chaque jour férié rencontré
                }

                //on compte chaque samedi et chaque dimanche
                if(((date("w", $timestamp3 + $i * $day_stamp) == 6) or (date("w",
                                $timestamp3 + $i * $day_stamp) == 0)) and !in_array($i, $closed))
                {
                    $num++ ;
                }
                $i++;
            }
            $year++ ; // on incremente l'année
        }
        $res = $tot - $num;
// nombre de jours entre les 2 dates fournies - nombre de jours non ouvrés
        return $res;
    }

    //
    public function conges(){

        $personnes= Personne::where('id_entite','=',1)->orwhere('id_entite','=',3)->get();
        //dd($personnes);
         //   dd($personnes->contrat_renouvelles()->where('datedebutc','<>',null)->orderBy('datedebutc','ASC')->first()->datedebutc);

        $personnesConge= Array();
        foreach ($personnes as $personne):



            if(isset($personne->contrat_renouvelles()->where('datedebutc','!=',null)->orderBy('datedebutc','ASC')->first()->datedebutc)){

                $VarpersonneConges= new VarpersonneConges();
                $VarpersonneConges->personne_id=$personne->id;
                $VarpersonneConges->nom_prenom=$personne->nom.' '.$personne->prenom;
                $datedebutc=$personne->contrat_renouvelles()->where('datedebutc','!=',null)->orderBy('datedebutc','ASC')->first()->datedebutc;

                $VarpersonneConges->nb_y=date_diff(new \DateTime($datedebutc),new \DateTime('now'))->y;

                 //   dd(date_diff(new \DateTime($datedebutc),new \DateTime('now')));
                $VarpersonneConges->nb_m=date_diff(new \DateTime($datedebutc),new \DateTime('now'))->m;
                $VarpersonneConges->nb_d=date_diff(new \DateTime($datedebutc),new \DateTime('now'))->d;
                $VarpersonneConges->jours=(($VarpersonneConges->nb_y*12) +$VarpersonneConges->nb_m)*2.5 +$VarpersonneConges->nb_d/30  ;

                if(isset($personne->jours_conges()->select("title","id_personne",DB::raw('sum(nb_days) as nb'))->groupBy('conges.id_personne','title')->get()[0]->nb)){
                         $VarpersonneConges->jour_conges=$personne->jours_conges() ->select("title","id_personne",DB::raw('sum(nb_days) as nb'))->groupBy('conges.id_personne','title')->get()[0]->nb;

                    }

                $personnesConge[]=$VarpersonneConges;

            }



            endforeach;

       
         $colors= [
            "#63b598", "#ce7d78", "#ea9e70", "#a48a9e", "#c6e1e8", "#648177" ,"#0d5ac1" ,
            "#f205e6" ,"#1c0365" ,"#14a9ad" ,"#4ca2f9" ,"#a4e43f" ,"#d298e2" ,"#6119d0",
            "#d2737d" ,"#c0a43c" ,"#f2510e" ,"#651be6" ,"#79806e" ,"#61da5e" ,"#cd2f00" ,
            "#9348af" ,"#01ac53" ,"#c5a4fb" ,"#996635","#b11573" ,"#4bb473" ,"#75d89e" ,
            "#2f3f94" ,"#2f7b99" ,"#da967d" ,"#34891f" ,"#b0d87b" ,"#ca4751" ,"#7e50a8" ,
            "#c4d647" ,"#e0eeb8" ,"#11dec1" ,"#289812" ,"#566ca0" ,"#ffdbe1" ,"#2f1179" ,
            "#935b6d" ,"#916988" ,"#513d98" ,"#aead3a", "#9e6d71", "#4b5bdc", "#0cd36d",
            "#250662", "#cb5bea", "#228916", "#ac3e1b", "#df514a", "#539397", "#880977",
            "#f697c1", "#ba96ce", "#679c9d", "#c6c42c", "#5d2c52", "#48b41b", "#e1cf3b",
            "#5be4f0", "#57c4d8", "#a4d17a", "#085b22", "#be608b", "#96b00c", "#088baf",
            "#f158bf", "#e145ba", "#ee91e3", "#05d371", "#5426e0", "#4834d0", "#802234",
            "#6749e8", "#0971f0", "#8fb413", "#b2b4f0", "#c3c89d", "#c9a941", "#41d158",
            "#fb21a3", "#51aed9", "#5bb32d", "#0b7f80", "#21538e", "#89d534", "#d36647",
            "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
            "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec",
            "#1bb699", "#6b2e5f", "#64820f", "#01271c", "#21538e", "#89d534", "#d36647",
            "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
            "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec",
            "#1bb699", "#6b2e5f", "#64820f", "#01271c", "#9cb64a", "#996c48", "#9ab9b7",
            "#06e052", "#e3a481", "#0eb621", "#fc458e", "#b2db15", "#aa226d", "#792ed8",
            "#73872a", "#520d3a", "#cefcb8", "#a5b3d9", "#7d1d85", "#c4fd57", "#f1ae16",
            "#8fe22a", "#ef6e3c", "#243eeb", "#1dc18", "#dd93fd", "#3f8473", "#e7dbce",
            "#421f79", "#7a3d93", "#635f6d", "#93f2d7", "#9b5c2a", "#15b9ee", "#0f5997",
            "#409188", "#911e20", "#1350ce", "#10e5b1", "#fff4d7", "#cb2582", "#ce00be",
            "#32d5d6", "#17232", "#608572", "#c79bc2", "#00f87c", "#77772a", "#6995ba",
            "#fc6b57", "#f07815", "#8fd883", "#060e27", "#96e591", "#21d52e", "#d00043",
            "#b47162", "#1ec227", "#4f0f6f", "#1d1d58", "#947002", "#bde052", "#e08c56",
            "#28fcfd", "#0b09bb", "#36486a", "#d02e29", "#1ae6db", "#3e464c", "#a84a8f",
            "#911e7e", "#3f16d9", "#0f525f", "#ac7c0a", "#b4c086", "#c9d730", "#30cc49",
            "#3d6751", "#fb4c03", "#640fc1", "#62c03e", "#d3493a", "#88aa0b", "#406df9",
            "#615af0", "#4be47", "#2a3434", "#4a543f", "#79bca0", "#a8b8d4", "#00efd4",
            "#7ad236", "#7260d8", "#1deaa7", "#06f43a", "#823c59", "#e3d94c", "#dc1c06",
            "#f53b2a", "#b46238", "#2dfff6", "#a82b89", "#1a8011", "#436a9f", "#1a806a",
            "#4cf09d", "#c188a2", "#67eb4b", "#b308d3", "#fc7e41", "#af3101", "#ff065",
            "#71b1f4", "#a2f8a5", "#e23dd0", "#d3486d", "#00f7f9", "#474893", "#3cec35",
            "#1c65cb", "#5d1d0c", "#2d7d2a", "#ff3420", "#5cdd87", "#a259a4", "#e4ac44",
            "#1bede6", "#8798a4", "#d7790f", "#b2c24f", "#de73c2", "#d70a9c", "#25b67",
            "#88e9b8", "#c2b0e2", "#86e98f", "#ae90e2", "#1a806b", "#436a9e", "#0ec0ff",
            "#f812b3", "#b17fc9", "#8d6c2f", "#d3277a", "#2ca1ae", "#9685eb", "#8a96c6",
            "#dba2e6", "#76fc1b", "#608fa4", "#20f6ba", "#07d7f6", "#dce77a", "#77ecca"];
        $conges = Conges::all();


        return view('conges/conges',compact('personnesConge','colors','conges'));
    }
    public function conges_mastorise($id){

        $personne= Personne_presente::find($id);
        //dd($personnes);
         //   dd($personnes->contrat_renouvelles()->where('datedebutc','<>',null)->orderBy('datedebutc','ASC')->first()->datedebutc);

        //$personnesConge= Array();


             //   $VarpersonneConges= new VarpersonneConges();


           //     $nb_y=date_diff(new \DateTime($personne->datedebutc),new \DateTime('now'))->y;

                //    dd(date_diff(new \DateTime('2020-01-14'),new \DateTime('now')));
               // $nb_m=date_diff(new \DateTime($personne->datedebutc),new \DateTime('now'))->m;
              //  $nb_d=date_diff(new \DateTime($personne->datedebutc),new \DateTime('now'))->d;
             //   $jours=(($nb_y*12) +$nb_m)*2.5 +$nb_d/30;

                if(isset($personne->jours_conges()->select("id_personne",DB::raw('sum(jour) as nb'))->groupBy('absconges.id_personne')->get()[0]->nb)){
                    $personne->jours_conges()->select("id_personne",DB::raw('sum(jour) as nb'))->groupBy('absconges.id_personne')->get()[0]->nb;

                    }







        return date_diff(new \DateTime($personne->datedebutc),new \DateTime('now'))->days;
    }
    public function conges_save(Request $request){
        $parameters=$request->except(['_token']);
        $variconges= $parameters['variconges'];      //  dd( json_decode($variconges));
      $conges=  json_decode($variconges);

        $supprimer_anciens= Conges::all();
        foreach ($supprimer_anciens as $supprimer_ancien):
            $supprimer_ancien->delete();
            endforeach;

        foreach($conges as $conge):
    $cong = new Conges();

            $personne = Personne::find($conge->numero);

        $cong->title=$personne->id.' '.$personne->nom.' '.$personne->prenom;



            if($conge->EndDate!=''){
                $cong->EndDate=$conge->EndDate;
            } if($conge->startDate!=''){
                $cong->startDate=$conge->startDate;
            }

        $cong->backgroundColor=$conge->backgroundColor;
        $cong->id_personne=$conge->numero;
        $cong->nb_days=$this->nb_jours($conge->startDate,$conge->EndDate);
            $cong->save();

            endforeach;
        return 'ok';
    }

    public function demande_conges()
    {
      //  dd(Auth()->user()->id_chantier_connecte);
        $entites = Entite::all();
        if(Auth::user()->hasRole('Ressource_humaine')){
            $personnes = Personne_presente::where('id_entite','=',Auth()->user()->id_chantier_connecte)->get();
        }else{
            $personnes = Personne_presente::where('service','=',Auth()->user()->id_service)->where('id_entite','=',Auth::user()->id_chantier_connecte)->get();
        }
        $conges = Absconges::where('id_users',Auth()->user()->id)->get();
      //  dd($conges);
        $type_motifs= Type_conges::all();
        return view('conges/ficheConges',compact('entites','personnes','conges','type_motifs'));
    }
    public function modification($id)
    {
        $conge= Absconges::find($id);
        $entites = Entite::all();
        if(Auth::user()->hasRole('Ressource_humaine')){
            $personnes = Personne_presente::where('id_entite','=',Auth::user()->id_chantier_connecte)->get();
        }else{
            $personnes = Personne_presente::where('service','=',Auth::user()->id_service)->where('id_entite','=',Auth::user()->id_chantier_connecte)->get();
        }
        $conges = Absconges::where('id_users',Auth::user()->id)->get();
        // $contrat= Contrat::where('id')
        $contrat=Contrat::where('id_personne','=',$conge->id_personne)->where('etat','=',1)->first();
        $type_motifs= Type_conges::all();

        return view('conges/ficheConges',compact('entites','personnes','conges','conge','contrat','type_motifs'));
    }
    public function information_conges_prec($id)
    {
            $conges= Absconges::where('id_personne','=',$id)
                                ->where('etat','<=',2)
                                ->select('id_personne',DB::raw('sum(jour) as jourconges'))
                                ->groupby('id_personne')
                                ->first();

        $dernierconge = Absconges::where('id_personne','=',$id)
                                    ->orderBy('debut','DESC')
                                    ->first();


        $personne= Personne::find($id);

        $VarpersonneConges= new VarpersonneConges();
        $VarpersonneConges->personne_id=$id;
        $VarpersonneConges->nom_prenom=$personne->nom.' '.$personne->prenom;
        $datedebutc= Personne_presente::find($id)->datedebutc;

        $VarpersonneConges->nb_y=date_diff(new \DateTime($datedebutc),new \DateTime('now'))->y;

        //   dd(date_diff(new \DateTime($datedebutc),new \DateTime('now')));
        $VarpersonneConges->nb_m=date_diff(new \DateTime($datedebutc),new \DateTime('now'))->m;
        $VarpersonneConges->nb_d=date_diff(new \DateTime($datedebutc),new \DateTime('now'))->d;
        $VarpersonneConges->jours=(($VarpersonneConges->nb_y*12) +$VarpersonneConges->nb_m)*2.5 +$VarpersonneConges->nb_d/30  ;

        $tabconges=array();
        if(isset($conges) && isset($dernierconge) && isset($personne)){
            $tabconges['nombrecongesAccorde']=$conges->jourconges;
            $tabconges['dernierconge']=$dernierconge;
            $tabconges['nombrecongesAqui']=number_format($VarpersonneConges->jours, 0, '.', '');
        }else{
            $tabconges['nombrecongesAqui']=number_format($VarpersonneConges->jours, 0, '.', '');
        }



        return $tabconges;

    }
    public function ActionValider($id){
        $conge = Absconges::find($id);

        $conge->etat=2;
        $conge->id_valideur=Auth::user()->id;

        $conge->save();
        $users =User::all();
        $contact=Array();
        $contactdemandeur=Array();
        foreach($users as $user):

            if($user->hasRole('Ressource_humaine')){
                $contact[]=$user->email;

            }

        endforeach;

        if(!empty($contact)){
            $this->dispatch(new EnvoiesDemandeValider(4,$contact));
        }
        $contactdemandeur[]=$conge->user()->first()->email;
        if(!empty($contactdemandeur)){
            $this->dispatch(new EnvoiesInformationDemandeur(4,$contactdemandeur,$conge));
        }


        return redirect()->route('conges.validation')->with('success',"La demande d'absconge a été  validée avec succès");

    }
    public function je_connais_tes_droits_je_te_notifie_pour_la_gestion($les_droits,$email){


        if(in_array('Ressource_humaine',$les_droits)){
            $this->dispatch(new EnvoiesDemandeValider(4,$email));
        }


    }
    public function ActionRejeter(Request $request){
        $parameters=$request->except(['_token']);

        $objet=$parameters['objet'];
        if($objet=="conge"){
            $id_dmd=$parameters['id_dmd'];

            $motif=$parameters['motif'];
            $conge = Absconge::find($id_dmd);

            $conge->etat=4;
            $conge->id_valideur=Auth::user()->id;

            $conge->save();

            try{
                $this->dispatch(new EnvoiesRefus($conge,$motif,$objet));
            }catch(\Exception $exception){
                return redirect()->back()->with('warning',"La demande a été réfusé avec succès mais le mail du motif n'est pas parti .");
            }

            return redirect()->back()->with('success',"La demande a été réfusé");
        }


        return redirect()->back()->with('success',"La demande a été réfusé");

    }

    public function lapersonne_contrat_conges($id){

        $personne = Personne_presente::find($id);

        $resultat[0]= $personne;
        $resultat['leservice']= $personne->leservice()->get();
        $resultat['lafonction']= $personne->lafonction()->get();
        $resultat['lecontrat']= $personne->lecontrat()->get();
        $resultat['Listmodifavenants']=   $Listmodifavenants=Listmodifavenant::all();
        $resultat['congesa']=   $Listmodifavenants=Listmodifavenant::all();

        return $resultat;
    }
    public function enregistrer(Request $request ){


        $parameters=$request->except(['_token']);
       // dd($parameters);


        //les valeurs initiales

        $id_personne=$parameters['id_personne'];
        $debut=$parameters['debut'];
        $fin=$parameters['fin'];
        $jour=$parameters['jour'];

        $reprise=$parameters['reprise'];
        $id_motif_demande=$parameters['id_motif_demande'];
        $adresse_pd_conges=$parameters['adresse_pd_conges'];
        $contact_telephonique=$parameters['contact_telephonique'];


        $conge = new Absconges();
        $conge->debut=$debut;
        $conge->fins=$fin;
        if( isset($parameters['solde'])){
            $conge->solde=1;
        }else{
            $conge->solde=0;
        }

        $conge->reprise=$reprise;
        $conge->id_personne=$id_personne;
        $conge->jour=$jour;
        $conge->id_users=Auth::user()->id;
       // $conge->etat=1;
        $conge->id_motif_demande=$id_motif_demande;
        $conge->adresse_pd_conges=$adresse_pd_conges;
        $conge->contact_telephonique=$contact_telephonique;

        $conge->save();
        $users =User::all();
        $contact=Array();
        $contactdemandeur=Array();
        $personne= Personne::find($id_personne);
      //  dd($personne->contrat()->where('etat','=',1)->first()->id_personne);
        foreach($users as $user):

            //&& $conge->user->id_personne!=$personne->id
            if($conge->user->hasRole('Chef_de_service')  && $user->hasRole('Chef_de_projet')){
                $contact[]=$user->email;
            }
            if($user->hasRole('Chef_de_service') && $personne->contrat()->where('etat','=',1)->first()->id_service==$user->id_service && $personne->id!=Auth::user()->id_personne){
                $contact[]=$user->email;

            }

        endforeach;

        if(!empty($contact)){
         //   $this->dispatch(new EnvoiesDemandeValidation(4,$contact));
        }

        return redirect()->back()->with('success',"La demande d'absconge a été  enregistrée avec succès");

    }

    public function je_connais_tes_droits_je_te_notifie_de_linformation_qui_te_concerne($les_droits,$email){


        if(in_array('Chef_de_service',$les_droits)){
            $this->dispatch(new EnvoiesDemandeValidation(4,$email));
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


        $conge = Absconges::find($id);
        $conge->debut=$debut;
        $conge->fins=$fin;
        $conge->reprise=$reprise;
        $conge->jour=$jour;
        $conge->id_personne=$id_personne;
       // $conge->id_users=Auth::user()->id;
        $conge->etat=1;



        $conge->save();

        return redirect()->back()->with('success',"La demande d'Absconge a été  modifiée avec succès");

    }
    public function type_permission($id){

        $conge= Absconges::find($id);

        return \GuzzleHttp\json_encode($conge);
    }
    public function ajouter_type_permission(Request $request ){


        $parameters=$request->except(['_token']);
        //dd($parameters);


        //les valeurs initiales

        $id=$parameters['id'];
        $id_permission=$parameters['id_permission'];

        $conge = Absconge::find($id);
        $conge->etat=3;
        $conge->id_type_permission=$id_permission;


        $conge->save();

        return redirect()->back()->with('success',"La demande d'Absconge est prête, vous pouvez télécharger le fichier PDF");

    }
    public function supprimer($id){
        $conge= Absconges::find($id);

        $conge->delete();
        $contactdemandeur = Array();
        $contactdemandeur[]=$conge->user()->first()->email;
        if(!empty($contactdemandeur)){
            $this->dispatch(new EnvoiesInformationDemandeur(6,$contactdemandeur,$conge));
        }
        return redirect()->back()->with('success',"La demande d'Absconge a été  supprimée avec succès");
    }
    public function validation_conges(){

        if(Auth::user()->hasRole('Chef_de_projet')){
            $conges = DB::table('absconges')
                ->Join('type_conges','type_conges.id','=','absconges.id_motif_demande')
                ->Join('personne','personne.id','=','absconges.id_personne')
                ->Join('contrat','personne.id','=','contrat.id_personne')
                ->Join('users','users.id','=','absconges.id_users')
                ->leftJoin('user_role','user_role.user_id','=','users.id')
                ->Join('roles','user_role.role_id','=','roles.id')
                ->where('absconges.etat','=',1)
                ->where('personne.id_entite','=',Auth::user()->id_chantier_connecte)
                ->where('roles.name','=','Chef_de_service')
                ->orwhere([['contrat.id_service','=',Auth::user()->id_service],['absconges.etat','=',1]])
            //    ->where('personne.id','!=',Auth::user()->id_personne)
                ->select('absconges.id','jour','solde','debut','fins','reprise','adresse_pd_conges','contact_telephonique','absconges.etat','libelle as libelle_type_conges','users.nom as nom_users','users.prenoms as prenoms_users','personne.slug','personne.service','personne.nom','personne.prenom')->distinct()->get();
//dd($conges);
        }else{
            $conges = DB::table('absconges')
                ->leftJoin('type_conges','type_conges.id','=','absconges.id_motif_demande')
                ->leftJoin('personne','personne.id','=','absconges.id_personne')
                ->leftJoin('contrat','personne.id','=','contrat.id_personne')->where('contrat.etat','=',1)
                ->leftJoin('users','users.id','=','absconges.id_users')->where('absconges.etat','=',1)
                ->where('contrat.id_service','=',Auth::user()->id_service)
                ->where('personne.id','!=',Auth::user()->id_personne)
                ->where('personne.id_entite','=',Auth::user()->id_chantier_connecte)
                ->select('absconges.id','jour','solde','debut','fins','reprise','adresse_pd_conges','contact_telephonique','absconges.etat','libelle as libelle_type_conges','users.nom as nom_users','users.prenoms as prenoms_users','personne.slug','personne.service','personne.nom','personne.prenom')->get();

        }
        // dd($conges);
        //  dd($conges);
        $mode="validation";
        $entites=Entite::all();

        return view('conges/GestionConge',compact('conges','mode','entites'));
    }
    public function telecharger_doc_conge($id){

        $conge = Absconges::find($id);
        $personne= Personne_presente::find($conge->id_personne);

        $conges= Absconges::where('id_personne','=',$id)
            ->where('etat','<=',2)
            ->select('id_personne',DB::raw('sum(jour) as jourconges'))
            ->groupby('id_personne')
            ->first();

        $dernierconge = Absconges::where('id_personne','=',$id)
            ->orderBy('debut','DESC')
            ->first();

        /* */
        $personne= Personne::find($id);

        $VarpersonneConges= new VarpersonneConges();
        $VarpersonneConges->personne_id=$id;
        $VarpersonneConges->nom_prenom=$personne->nom.' '.$personne->prenom;
        $datedebutc= Personne_presente::find($id)->datedebutc;

        $VarpersonneConges->nb_y=date_diff(new \DateTime($datedebutc),new \DateTime('now'))->y;

        //   dd(date_diff(new \DateTime($datedebutc),new \DateTime('now')));
        $VarpersonneConges->nb_m=date_diff(new \DateTime($datedebutc),new \DateTime('now'))->m;
        $VarpersonneConges->nb_d=date_diff(new \DateTime($datedebutc),new \DateTime('now'))->d;
        $VarpersonneConges->jours=(($VarpersonneConges->nb_y*12) +$VarpersonneConges->nb_m)*2.5 +$VarpersonneConges->nb_d/30  ;

        $tabconges=array();
        $tabconges['nombrecongesAccorde']='';
        $tabconges['dernierconge']='';
        $tabconges['nombrecongesAqui']='';
        if(isset($conges) && isset($dernierconge) && isset($personne)){
            $tabconges['nombrecongesAccorde']=$conges->jourconges;
            $tabconges['dernierconge']=$dernierconge;
            $tabconges['nombrecongesAqui']=number_format($VarpersonneConges->jours, 0, '.', '');
        }else{
            $tabconges['nombrecongesAqui']=number_format($VarpersonneConges->jours, 0, '.', '');
        }



        /* */
        // dd($absence->personne);
        $pdf = PDF::loadView('conges.documentConge',compact('conge','personne','conges','tabconges'));
        return $pdf->stream();
        //  return view('conges/documentConge',compact('conge','personne'));
    }
    public function gestion_Absconge(){
        $mode="gestion_Absconge";
        $entites=Entite::all();
        $type_motifs = Type_conges::all();
        $type_permissions= Type_permission::all();
        $conges = DB::table('absconges')
            ->leftJoin('type_conges','type_conges.id','=','absconges.id_motif_demande')
            ->leftJoin('personne','personne.id','=','absconges.id_personne')
            ->leftJoin('users','users.id','=','absconges.id_users')->where('etat','>=',2)
            ->where('personne.id_entite','=',Auth::user()->id_chantier_connecte)
            ->select('absconges.id','jour','solde','debut','fins','reprise','adresse_pd_conges','contact_telephonique','etat','libelle as libelle_type_conges','users.nom as nom_users','users.prenoms as prenoms_users','personne.slug','personne.nom','personne.prenom')->get();
       // dd($conges);
        return view('conges/GestionConge',compact('mode','entites','type_motifs','mode','conges','type_permissions'));
    }
    public function conges_validation_collective(Request $request){

        $parameters=$request->except(['_token']);

        $mavariable=$parameters['mavariable'];

        $tab_id= explode(',',$mavariable);
        //   dd($tab_id);
        foreach($tab_id as $id):
            if($id!=""){
                $conge = Absconges::find($id);

                $conge->etat=2;
                $conge->id_valideur=Auth::user()->id;

                $conge->save();
                $contactdemandeur[]=$conge->user()->first()->email;
                if(!empty($contactdemandeur)){
                    $this->dispatch(new EnvoiesInformationDemandeur(4,$contactdemandeur,$conge));
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
                $this->dispatch(new EnvoiesDemandeValider(4, $contact));
            }
        }


    }
}
