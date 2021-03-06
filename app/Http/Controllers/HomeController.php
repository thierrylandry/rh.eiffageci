<?php

namespace App\Http\Controllers;

use App\Entite;
use App\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use App\Vardiag;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('/');
    }
    public function tableau_de_bord()
    {

        if(isset(Auth()->user()->id_chantier_connecte) && Auth()->user()->id_chantier_connecte!=0 && Auth()->user()->id_chantier_connecte!=null){
            $id_entite_connecter=Auth()->user()->id_chantier_connecte;
        }else{
            $id_entite_connecter=1;
        }

       // dd($id_entite_connecter);
        $soustraitant = DB::table('partenaire')
            ->select('nom as libelleUnite','effectif as entite','effectif as nb');
        $effectifglobaux_tab=DB::table('personne_presente')
            ->leftJoin('unite','unite.id_unite','=','personne_presente.id_unite')
            ->leftJoin('entite','personne_presente.id_entite','=','entite.id')
        //       ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->where('id_entite','=',$id_entite_connecter)
            ->groupBy('unite.id_unite','id_entite')
            ->select(DB::raw("CONCAT(libelleUnite,' ',entite.libelle)  as libelleUnite"),'id_entite',DB::raw('count(personne_presente.id) as nb'))
           // ->union($soustraitant)
            ->get();
     //   dd($effectifglobaux_tab);
        $effectifglobaux= Array();
        foreach ($effectifglobaux_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->libelleUnite;
            $vardiag->entite=$group->id_entite;
            $vardiag->y=$group->nb;

            $effectifglobaux[]=$vardiag;
        endforeach;

        //tableau sur le nombre de cdd et cdi

        $camanbert_tab=DB::table('personne_presente')
                    ->select('libelle',DB::raw('count(*) as nb'))
                    ->where('id_entite','=',$id_entite_connecter)
                     ->groupBy('libelle')->get();
       // dd($camanbert_tab);
        $camanberts= Array();
        foreach ($camanbert_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->libelle;
            $vardiag->y=$group->nb;

            $camanberts[]=$vardiag;
        endforeach;

        $commune_tab=DB::table('personne_presente')
                    ->select(DB::raw('commune.libelle as commune'),DB::raw('count(*) as nb'))
                    ->leftJoin('commune','commune.id','=','personne_presente.id_commune')
                    ->where('id_entite','=',$id_entite_connecter)
                     ->groupBy('id_commune','commune.libelle')->get();
       // dd($commune_tab);
        $communes= Array();
        foreach ($commune_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->commune;
            $vardiag->y=$group->nb;

            $communes[]=$vardiag;
        endforeach;

        //fin tableau sur le nombre de CDD CDI
        $repartition_nationalite_tab = DB::table('personne_presente')
            ->join('pays','pays.id','=','personne_presente.nationalite')
            ->where("id_entite","=",$id_entite_connecter)
            //  ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->select("pays.nom_fr_fr",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('personne_presente.nationalite')
            ->get();

        $repartition_nationalite= Array();
        foreach ($repartition_nationalite_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->nom_fr_fr;
            $vardiag->y=$group->nb;

            $repartition_nationalite[]=$vardiag;
        endforeach;


        $repartition_homme_femme_tab= DB::table('personne_presente')
            ->where("id_entite","=",$id_entite_connecter)
            ->select("personne_presente.sexe",DB::raw('count(personne_presente.id) as nb'),"position")
            //   ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->groupBy('position','personne_presente.sexe')
            ->get();
//dd($repartition_homme_femme_tab);
        $repartition_homme_femme= Array();
        foreach ($repartition_homme_femme_tab as $group):
            $vardiag = New Vardiag();
            if($group->sexe=="M" && $group->position==1){
                $vardiag->name="CHANTIER HOMME";
                $vardiag->entite=$group->position;
                $vardiag->y=$group->nb;
                $repartition_homme_femme[]=$vardiag;
            }elseif($group->sexe=="F" && $group->position==1) {
                $vardiag->name = "CHANTIER FEMME";
                $vardiag->entite=$group->position;
                $vardiag->y=$group->nb;
                $repartition_homme_femme[]=$vardiag;
            }elseif($group->sexe=="M" && $group->position==2) {
                $vardiag->name = "BUREAU HOMME";
                $vardiag->entite=$group->position;
                $vardiag->y=$group->nb;
                $repartition_homme_femme[]=$vardiag;
            }elseif($group->sexe=="F" && $group->position==2) {
                $vardiag->name = "BUREAU FEMME";
                $vardiag->entite=$group->position;
                $vardiag->y=$group->nb;
                $repartition_homme_femme[]=$vardiag;
            }
            elseif($group->sexe=="M" && $group->position==3) {
                $vardiag->name = "HOMME DE MENAGES";
                $vardiag->entite=$group->position;
                $vardiag->y=$group->nb;
                $repartition_homme_femme[]=$vardiag;
            }elseif($group->sexe=="F" && $group->position==3) {
                $vardiag->name = "FEMME DE MENAGES";
                $vardiag->entite=$group->position;
                $vardiag->y=$group->nb;
                $repartition_homme_femme[]=$vardiag;
            }




        endforeach;
        $tranche_age_moin30_ans= DB::table('personne_presente')
            ->where("id_entite","=",$id_entite_connecter)
            ->join('personne_age','personne_age.id','=','personne_presente.id')
            //  ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->where('personne_age.age','<',30)
            ->get();
     //   dd($tranche_age_moin30_ans);
        $tranche_age_de_30_a_39_ans= DB::table('personne_presente')
            ->where("id_entite","=",$id_entite_connecter)
            ->join('personne_age','personne_age.id','=','personne_presente.id')
            //  ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->where('personne_age.age','>=',30)
            ->where('personne_age.age','<=',39)
            ->get();
        $tranche_age_de_40_a_49_ans= DB::table('personne_presente')
            ->where("id_entite","=",$id_entite_connecter)
            ->join('personne_age','personne_age.id','=','personne_presente.id')
            //   ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->where('personne_age.age','>=',40)
            ->where('personne_age.age','<=',49)
            ->get();
        $tranche_age_de50_ans= DB::table('personne_presente')
            ->where("id_entite","=",$id_entite_connecter)
            ->join('personne_age','personne_age.id','=','personne_presente.id')
            // ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->where('personne_age.age','>=',50)
            ->get();
        $repartition_tranche_age= Array();
        $vardiag = New Vardiag();
        $vardiag->name="Moins de 30 ans";
        $vardiag->y=sizeof($tranche_age_moin30_ans);

        $repartition_tranche_age[]=$vardiag;

        $vardiag = New Vardiag();
        $vardiag->name="30-39 ans";
        $vardiag->y=sizeof($tranche_age_de_30_a_39_ans);

        $repartition_tranche_age[]=$vardiag;

        $vardiag = New Vardiag();
        $vardiag->name="40-49 ans";
        $vardiag->y=sizeof($tranche_age_de_40_a_49_ans);

        $repartition_tranche_age[]=$vardiag;

        $vardiag = New Vardiag();
        $vardiag->name="50 ans et +";
        $vardiag->y=sizeof($tranche_age_de50_ans);

        $repartition_tranche_age[]=$vardiag;
        //dd($repartition_tranche_age);
        $anciennete_contrat_moins_6_mois_ = DB::table('ancienete')
            ->where("id_entite","=",$id_entite_connecter)
            ->where('temps','<',6)
            ->select("ancienete.id_personne","temps")
            ->get();
        $anciennete_contrat__6_a_12_mois_ = DB::table('ancienete')
            ->where("id_entite","=",$id_entite_connecter)
            ->where('temps','>=',6)
            ->where('temps','<=',12)
            ->select("ancienete.id_personne","temps")
            ->get();
        $anciennete_contrat__12_a_24_mois_ = DB::table('ancienete')
            ->where("id_entite","=",$id_entite_connecter)
            ->where('temps','>=',12)
            ->where('temps','<=',24)
            ->select("ancienete.id_personne","temps")
            ->get();

             $anciennete_contrat__24_a_36_mois_ = DB::table('ancienete')
            ->where("id_entite","=",$id_entite_connecter)
            ->where('temps','>=',24)
            ->where('temps','<=',36)
            ->select("ancienete.id_personne","temps")
            ->get();
             $anciennete_contrat_superieur_a_36_mois_ = DB::table('ancienete')
                        ->where("id_entite","=",$id_entite_connecter)
                        ->where('temps','>',36)
                        ->select("ancienete.id_personne","temps")
                        ->get();
         $repartition_ancienete= Array();
                $vardiag = New Vardiag();
                $vardiag->name="< 6 mois";
                $vardiag->y=sizeof($anciennete_contrat_moins_6_mois_);

                $repartition_ancienete[]=$vardiag;

                $vardiag = New Vardiag();
                $vardiag->name="6 à 12 mois";
                $vardiag->y=sizeof($anciennete_contrat__6_a_12_mois_);

                $repartition_ancienete[]=$vardiag;

                $vardiag = New Vardiag();
                $vardiag->name="12 à 24 mois";
                $vardiag->y=sizeof($anciennete_contrat__12_a_24_mois_);

                $repartition_ancienete[]=$vardiag;

                $vardiag = New Vardiag();
                $vardiag->name="24 à 36 mois";
                $vardiag->y=sizeof($anciennete_contrat__24_a_36_mois_);

                $repartition_ancienete[]=$vardiag;

                $vardiag = New Vardiag();
                $vardiag->name="> 36 mois";
                $vardiag->y=sizeof($anciennete_contrat_superieur_a_36_mois_);

                $repartition_ancienete[]=$vardiag;
/*
        $anciennete_contrat_moins_3_mois_ = DB::table('ancienete')
            ->where("id_entite","=",$id_entite_connecter)
            ->where('temps','<',3)
            ->select("ancienete.id_personne","temps")
            ->get();
        //dd($anciennete_contrat_moins_3_mois_);
        $anciennete_contrat__3_a_6_mois_ = DB::table('ancienete')
            ->where("id_entite","=",$id_entite_connecter)
            ->where('temps','>=',3)
            ->where('temps','<=',6)
            ->select("ancienete.id_personne","temps")
            ->get();

        $anciennete_contrat__7_a_10_mois_ = DB::table('ancienete')
            ->where("id_entite","=",$id_entite_connecter)
            ->where('temps','>=',7)
            ->where('temps','<=',10)
            ->select("ancienete.id_personne","temps")
            ->get();
        $anciennete_contrat__11_a_12_mois_ = DB::table('ancienete')
            ->where("id_entite","=",$id_entite_connecter)
            ->where('temps','>=',11)
            ->where('temps','<=',12)
            ->select("ancienete.id_personne","temps")
            ->get();
        $anciennete_contrat_superieur_a_12_mois_ = DB::table('ancienete')
            ->where("id_entite","=",$id_entite_connecter)
            ->where('temps','>',12)
            ->select("ancienete.id_personne","temps")
            ->get();

        $repartition_ancienete= Array();
        $vardiag = New Vardiag();
        $vardiag->name="< 3 mois";
        $vardiag->y=sizeof($anciennete_contrat_moins_3_mois_);

        $repartition_ancienete[]=$vardiag;

        $vardiag = New Vardiag();
        $vardiag->name="3 à 6 mois";
        $vardiag->y=sizeof($anciennete_contrat__3_a_6_mois_);

        $repartition_ancienete[]=$vardiag;

        $vardiag = New Vardiag();
        $vardiag->name="7 à 10 mois";
        $vardiag->y=sizeof($anciennete_contrat__7_a_10_mois_);

        $repartition_ancienete[]=$vardiag;

        $vardiag = New Vardiag();
        $vardiag->name="11 à 12 mois";
        $vardiag->y=sizeof($anciennete_contrat__11_a_12_mois_);

        $repartition_ancienete[]=$vardiag;

        $vardiag = New Vardiag();
        $vardiag->name="> 12 mois";
        $vardiag->y=sizeof($anciennete_contrat_superieur_a_12_mois_);

        $repartition_ancienete[]=$vardiag;
*/
        //repartition par service
        $repartition_service_tab = DB::table('personne_presente')
            ->where("id_entite","=",$id_entite_connecter)
            //    ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->join('services','services.id','=','personne_presente.service')
            ->select("services.libelle",DB::raw('count(personne_presente.id) as nb'))

            ->groupBy('services.id')
            ->get();
        $repartition_service= Array();
        foreach ($repartition_service_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->libelle;
            $vardiag->y=$group->nb;

            $repartition_service[]=$vardiag;
        endforeach;

        //entrée / sortie



        $a_mois = array ( '1' => 'Janvier', '2' => 'Fevrier', '3' => 'Mars',
            '4' => 'Avril','5' => 'Mai', '6' => 'Juin','7' => 'Juillet',
            '8' => 'Aout','9' => 'Septembre', '10' => 'Octobre','11' => 'Novembre', '12' => 'Décembre') ;
        $repartition_entrees= Array();
        $repartition_sorties= Array();

        // qualification contractuelle
        $cadre = DB::table('personne_presente')
            // ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->where([['definition.id','=',1],['id_entite','=',$id_entite_connecter]])
            ->join('definition','definition.id','=','personne_presente.id_definition')
            ->select("definition.libelle",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $agent_de_maitrise = DB::table('personne_presente')
            //    ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->where('definition.id','=',2)
            ->where('id_entite','=',$id_entite_connecter)
            ->join('definition','definition.id','=','personne_presente.id_definition')
            ->select("definition.libelle",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        //dd($agent_de_maitrise);
        //
        $employe = DB::table('personne_presente')
            //    ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->where('definition.id','=',3)
            ->where('id_entite','=',$id_entite_connecter)
            ->join('definition','definition.id','=','personne_presente.id_definition')
            ->select("definition.libelle",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $chauffeur = DB::table('personne_presente')
            //   ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->where('definition.id','=',5)
            ->where('id_entite','=',$id_entite_connecter)
            ->join('definition','definition.id','=','personne_presente.id_definition')
            ->select("definition.libelle",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
     /*   $ouvrier = DB::table('personne_presente')
            //  ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->where('id_entite','=',$id)
            ->where('definition.id','=',5)
            ->orWhere('definition.id','=',4)
            ->join('definition','definition.id','=','personne_presente.id_definition')
            ->select("definition.libelle",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('definition.id')*/
         //   ->tosql();
     //   dd($ouvrier);
        $ouvrier=DB::select('call proc_ouvrier('.$id_entite_connecter.')');

           // ->get()->first();
       // dd($ouvrier);
        $stagiaire = DB::table('personne_presente')
            //  ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->where('definition.id','=',6)
            ->where('id_entite','=',$id_entite_connecter)
            ->join('definition','definition.id','=','personne_presente.id_definition')
            ->select("definition.libelle",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        // ->toSql();

      //  dd("les stagiaires :".$stagiaire." les ouvriers ".$ouvrier."les chauffeurs ".$chauffeur."les employers ".$employe." les agents de maitrise ".$agent_de_maitrise." les cadres ".$cadre);

        $qualification_contractuelle= Array();

        if(!is_null($agent_de_maitrise)){
            $vardiag = New Vardiag();
            $vardiag->name=$agent_de_maitrise->libelle;
            $vardiag->y=$agent_de_maitrise->nb;

            $qualification_contractuelle[]=$vardiag;
        }

        if(!is_null($cadre)){
            $vardiag = New Vardiag();
            $vardiag->name=$cadre->libelle;
            $vardiag->y=$cadre->nb;

            $qualification_contractuelle[]=$vardiag;
        }
        if(!is_null($employe)){
            $vardiag = New Vardiag();
            $vardiag->name=$employe->libelle;
            $vardiag->y=$employe->nb;

            $qualification_contractuelle[]=$vardiag;
        }
        if(isset($ouvrier[0])) {
            $vardiag = New Vardiag();
            $vardiag->name = $ouvrier[0]->libelle;

                $vardiag->y = $ouvrier[0]->nb;
           if(isset($ouvrier[1])){
               $vardiag->y+=$ouvrier[1]->nb;
           }


            $qualification_contractuelle[] = $vardiag;
        }
        if(!is_null($stagiaire)) {
            $vardiag = New Vardiag();
            $vardiag->name = $stagiaire->libelle;
            $vardiag->y = $stagiaire->nb;

            $qualification_contractuelle[] = $vardiag;
        }

//debut entrée
        $entrees= DB::select('call proc_entrees('.$id_entite_connecter.')');
      //  $entrees= [];
        $personne_sortie= DB::select('call personne_sortie('.$id_entite_connecter.')');
        $personne_sortie_unique= Array();
        foreach($personne_sortie as $pers):

            if($pers->departDefinitif!=""){
                $personne_sortie_unique[$pers->id]=$pers;
            }


            endforeach;

        //dd($personne_sortie_unique);
       // $sorties= [];
        $annee_moins1=date('Y')-1;
        $tab_allege= Array();
        foreach ($entrees as $entree):

            $tab_allege[$entree->numeromois.':'.$entree->annee]=$entree->entree;

        endforeach;

//fin entree
        //debut sorti


        $annee_moins1=date('Y')-1;
//dd($tab_allege_sorti);
        //tableau des effectif par mois
//cumules des entrees
        $runningSum = 0;
        $cumule_entrees= Array();
        foreach ($entrees as $vardiag) {
            if($vardiag->mois!="" || !is_null($vardiag->mois)) {
                $runningSum = $vardiag->entree;

                $vardiagCumul = New Vardiag();
                $vardiagCumul->name = $vardiag->mois;
                $vardiagCumul->y = $vardiag->entree;
                $cumule_entrees[] = $vardiagCumul;
            }
        }
       // dd($cumule_entrees);
        //dd($cumule_sortis);
        $months = array();


      //  dd($entrees[0]->numeromois);
        $liste_name= array();
        $currentMonth = $entrees[0]->numeromois;
        $quand_on_sort=true;
        for ($y = $entrees[0]->annee; $y <= date('Y'); $y++) {


            for ($x = $currentMonth; $x <= $currentMonth + (12-$currentMonth); $x++) {

                $liste_name[] = date('F', mktime(0, 0, 0, $x, 1)).'-'.$y;
                if(date('F', mktime(0, 0, 0, $x, 1)).'-'.$y==date('F').'-'.date('Y')){
                    break;
                    $quand_on_sort=false;

                }

            }
            $currentMonth=1;
            if ($quand_on_sort==false){
                break;
            }
        }
    //    dd($liste_name);
        $effectif_par_mois= Array();

$tab = Array();
        $valeur=0;
        foreach($liste_name as $lelibelle) {
            $vardiagEffectif1 = New Vardiag();
            $valeur+=$this->donne_moi_une_date_je_te_dis_qui_est_venu($cumule_entrees,$lelibelle)-$this->compte_sortie($personne_sortie_unique,$lelibelle);
            $vardiagEffectif1->name=$lelibelle;
            $vardiagEffectif1->y=$valeur;
            $effectif_par_mois[]=$vardiagEffectif1;
            $tab[][$lelibelle.' venu']="arrivé ".$this->donne_moi_une_date_je_te_dis_qui_est_venu($cumule_entrees,$lelibelle)."; sorti=".$this->compte_sortie($personne_sortie_unique,$lelibelle)." cumule :".$valeur;
           // $tab[][$lelibelle.' sortie']=$this->compte_sortie($personne_sortie_unique,$lelibelle);
          //  $tab[][$lelibelle.' valeur']=$valeur;
        }
      //  dd($tab);
        $effectif_par_mois_le_plus_ressent =Array();
        $i=11;
        while($i>=0){
            $effectif_par_mois_le_plus_ressent[]=$effectif_par_mois[sizeof($effectif_par_mois)-1-$i];
            $i--;
        }
       // $effectif_par_mois[sizeof($effectif_par_mois)-1]->y=$effectif_par_mois[sizeof($effectif_par_mois)-1]->y -1;
       // dd($effectif_par_mois);


        $entites=Entite::all();
        $lentite=Entite::find($id_entite_connecter);
        return view('tableau_de_bord/entiteTD',compact('effectifglobaux','repartition_homme_femme','repartition_nationalite','repartition_tranche_age','repartition_ancienete','repartition_service','repartition_entrees','repartition_sorties','qualification_contractuelle','entites','lentite','camanberts','effectif_par_mois','repartition_homme_femme_tab','communes','effectif_par_mois_le_plus_ressent'));

    }
    public function compte_sortie($personne_sortie_unique,$mois){
        $res=0;
        foreach($personne_sortie_unique as $pers):

            if($pers->mois ==$mois){
                $res++;
            }
            endforeach;
        return $res;
    }
    public function donne_moi_une_date_je_te_dis_qui_est_venu($cumule_entrees,$date_libelle){
        $resultat=0;
        for ($j = 0; $j < sizeof($cumule_entrees); $j++) {
            if($date_libelle==$cumule_entrees[$j]->name){
                $vardiagEffectif = New Vardiag();

                $vardiagEffectif->name = $date_libelle;
                $vardiagEffectif->y =$cumule_entrees[$j]->y;
               // $effectif_par_mois[$i] = $vardiagEffectif;
                $resultat= $vardiagEffectif->y;
                break;
            }
        }
        return $resultat;
    }
    public function donne_moi_une_date_je_te_dis_qui_est_parti($cumule_sortis,$date_libelle){
        $resultat=0;
        for ($j = 0; $j < sizeof($cumule_sortis); $j++) {
            if($date_libelle==$cumule_sortis[$j]->name){
                $vardiagEffectif = New Vardiag();

                $vardiagEffectif->name = $date_libelle;
                $vardiagEffectif->y =$cumule_sortis[$j]->y;
               // $effectif_par_mois[$i] = $vardiagEffectif;
                $resultat= $vardiagEffectif->y;
                break;
            }
        }
        return $resultat;
    }
    public function globale()
    {


        $soustraitant = DB::table('partenaire')
            ->select('nom as libelleUnite','effectif as entite','effectif as nb');
//dd($soustraitant);
        $effectifglobaux_tabx = DB::table('personne_presente')
            ->join('unite','unite.id_unite','=','personne_presente.id_unite')
            ->join('entite','entite.id','=','personne_presente.id_entite')
            ->groupBy('unite.id_unite','id_entite')
            ->select(DB::raw("CONCAT(libelleUnite,' ',entite.libelle)  as libelleUnite"),'id_entite',DB::raw('count(personne_presente.id) as nb'))
            // ->union($effectifglobaux_tab3)
            //  ->union($effectifglobaux_tab2)
            ->union($soustraitant)
            ->get();

        $effectifglobaux= Array();
        foreach ($effectifglobaux_tabx as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->libelleUnite;
            $vardiag->entite=$group->id_entite;
            $vardiag->y=$group->nb;

            $effectifglobaux[]=$vardiag;
        endforeach;
        $soustraitant = DB::table('partenaire')
            ->select('nom as libelleUnite','effectif as nb');
        $effectifglobaux_tab=DB::table('personne_presente')
            ->join('unite','unite.id_unite','=','personne_presente.id_unite')
         //   ->where('contrat.etat','=',1)
        //    ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->groupBy('unite.id_unite')
            ->select('libelleUnite',DB::raw('count(personne_presente.id) as nb'))
           // ->union($effectifglobaux_tab3)
          //  ->union($effectifglobaux_tab2)
            ->union($soustraitant)
            ->get();

//dd($effectifglobaux_tab);
        $effectifglobauxx= Array();
        foreach ($effectifglobaux_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->libelleUnite;
            $vardiag->y=$group->nb;

            $effectifglobauxx[]=$vardiag;
        endforeach;




        $repartition_nationalite_tab = DB::table('personne_presente')
            ->join('pays','pays.id','=','personne_presente.nationalite')
       //     ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))

            ->select("pays.nom_fr_fr",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('personne_presente.nationalite')
            ->get();

        $repartition_nationalite= Array();
        foreach ($repartition_nationalite_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->nom_fr_fr;
            $vardiag->y=$group->nb;

            $repartition_nationalite[]=$vardiag;
        endforeach;


        $repartition_homme_femme_tab= DB::table('personne_presente')
            ->select("personne_presente.sexe",DB::raw('count(personne_presente.id) as nb'))
      //      ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
            ->groupBy('personne_presente.sexe')
            ->get();
//dd($repartition_homme_femme_tab);
        $repartition_homme_femme_partenaire= DB::table('partenaire')
            ->select(DB::raw('sum(homme) as homme'),DB::raw('sum(femme) as femme'))
            ->first();
//dd($repartition_homme_femme_partenaire);
        $repartition_homme_femme= Array();
        foreach ($repartition_homme_femme_tab as $group):
            $vardiag = New Vardiag();
            if($group->sexe=="M"){
                $vardiag->name="HOMME";
                $vardiag->y=$group->nb;
            }elseif($group->sexe=="F") {
                $vardiag->name = "FEMME";
                $vardiag->y=$group->nb;
            }


            $repartition_homme_femme[]=$vardiag;
        endforeach;

    //    dd($repartition_homme_femme);
        //repartition par service
        $repartition_service_tab = DB::table('personne_presente')
          //  ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))

            ->join('services','services.id','=','personne_presente.service')
            ->select("services.libelle",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('services.id')
            ->get();

        $repartition_service= Array();
        foreach ($repartition_service_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->libelle;
            $vardiag->y=$group->nb;

            $repartition_service[]=$vardiag;
        endforeach;

        // qualification contractuelle
        $cadre = DB::table('personne_presente')
          //  ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))

            ->where([
                ['definition.id','=',1],
            ])
            ->join('definition','definition.id','=','personne_presente.id_definition')
            ->select("definition.libelle",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $agent_de_maitrise = DB::table('personne_presente')
         //   ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))

            ->where([
                ['definition.id','=',2],
            ])
            ->join('definition','definition.id','=','personne_presente.id_definition')
            ->select("definition.libelle",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $employe = DB::table('personne_presente')
        //    ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))

            ->where([
                ['definition.id','=',3],
            ])
            ->join('definition','definition.id','=','personne_presente.id_definition')
            ->select("definition.libelle",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $chauffeur = DB::table('personne_presente')
        //    ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
        ->join('definition','definition.id','=','personne_presente.id_definition')
            ->where([
                ['definition.id','=',5],
            ])
            ->select("definition.libelle",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $ouvrier = DB::table('personne_presente')
          //  ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))
          ->join('definition','definition.id','=','personne_presente.id_definition')
            ->where([
                ['definition.id','=',4],
            ])
            ->orWhere([
                ['definition.id','=',5],
            ])
            ->select("definition.libelle",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        //->tosql();
        //dd($ouvrier);
        $stagiaire = DB::table('personne_presente')
           // ->whereBetween(DB::raw('CAST(NOW() AS DATE)'), array(DB::raw('contrat.datedebutc'), DB::raw('contrat.datefinc')))

            ->where([
                ['definition.id','=',6],
            ])
            ->join('definition','definition.id','=','personne_presente.id_definition')
            ->select("definition.libelle",DB::raw('count(personne_presente.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();


        $qualification_contractuelle= Array();



        if(!is_null($cadre)){
            $vardiag = New Vardiag();
            $vardiag->name=$cadre->libelle;
            $vardiag->y=$cadre->nb;

            $qualification_contractuelle[]=$vardiag;
        }
        if(!is_null($agent_de_maitrise)){
            $vardiag = New Vardiag();
            $vardiag->name=$agent_de_maitrise->libelle;
            $vardiag->y=$agent_de_maitrise->nb;

            $qualification_contractuelle[]=$vardiag;
        }
        if(!is_null($employe)){
            $vardiag = New Vardiag();
            $vardiag->name=$employe->libelle;
            $vardiag->y=$employe->nb;

            $qualification_contractuelle[]=$vardiag;
        }
        if(!is_null($ouvrier)) {
            $vardiag = New Vardiag();
            $vardiag->name = $ouvrier->libelle;
            if(is_null($chauffeur)){
                $vardiag->y = $ouvrier->nb ;
            }else{
                $vardiag->y = $ouvrier->nb + $chauffeur->nb;
            }


            $qualification_contractuelle[] = $vardiag;
        }
        if(!is_null($stagiaire)) {
            $vardiag = New Vardiag();
            $vardiag->name = $stagiaire->libelle;
            $vardiag->y = $stagiaire->nb;

            $qualification_contractuelle[] = $vardiag;
        }

        $entites =Entite::all();
        /*debut du traçages*/
        $ip			= $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['REMOTE_HOST'])){
            $nommachine = $_SERVER['REMOTE_HOST'];
        }else{
            $nommachine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }
        Log::info('ip :'.$ip.'; Machine: '.$nommachine.' ; Affichage du tableau de bord ', ['nom et prenom' => Auth::user()->nom.' '.Auth::user()->prenom]);
        return view('tableau_de_bord/global',compact('qualification_contractuelle','effectifglobaux','effectifglobauxx','repartition_nationalite','repartition_service','repartition_homme_femme','entites'));
    }
    public function globalExport(){
        $effectifglobaux_tab = DB::table('personne')
            ->groupBy('unite.id_unite')
            ->orderBy('unite.id_unite','DESC')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->join('unite','unite.id_unite','=','personne.id_unite')
            ->where('contrat.etat','=',1)
            ->select('unite.libelleUnite',DB::raw('count(personne.id) as nb'))
            ->get();

        $effectifglobaux= Array();
        foreach ($effectifglobaux_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->libelleUnite;
            $vardiag->y=$group->nb;

            $effectifglobaux[]=$vardiag;
        endforeach;

        $repartition_nationalite_tab = DB::table('personne')
            ->join('pays','pays.id','=','personne.nationalite')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->select("pays.nom_fr_fr",DB::raw('count(personne.id) as nb'))
            ->groupBy('personne.nationalite')
            ->get();

        $repartition_nationalite= Array();
        foreach ($repartition_nationalite_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->nom_fr_fr;
            $vardiag->y=$group->nb;

            $repartition_nationalite[]=$vardiag;
        endforeach;


        $repartition_homme_femme_tab= DB::table('personne')
            ->select("personne.sexe",DB::raw('count(personne.id) as nb'))
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->groupBy('personne.sexe')
            ->get();

        $repartition_homme_femme= Array();
        foreach ($repartition_homme_femme_tab as $group):
            $vardiag = New Vardiag();
            if($group->sexe=="M"){
                $vardiag->name="HOMME";
            }elseif($group->sexe=="F") {
                $vardiag->name = "FEMME";
            }

            $vardiag->y=$group->nb;

            $repartition_homme_femme[]=$vardiag;
        endforeach;

        //dd($repartition_tranche_age);
        //repartition par service
        $repartition_service_tab = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('services','services.id','=','personne.service')
            ->select("services.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('services.id')
            ->get();

        $repartition_service= Array();
        foreach ($repartition_service_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->libelle;
            $vardiag->y=$group->nb;

            $repartition_service[]=$vardiag;
        endforeach;

        $cadre = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',1)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $agent_de_maitrise = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',2)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $employe = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',3)
            ->where('definition.id','=',5)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $chauffeur = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',3)
            ->where('definition.id','=',5)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $ouvrier = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',4)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $stagiaire = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',6)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();


        $qualification_contractuelle= Array();

        if(!is_null($agent_de_maitrise)){
            $vardiag = New Vardiag();
            $vardiag->name=$agent_de_maitrise->libelle;
            $vardiag->y=$agent_de_maitrise->nb;

            $qualification_contractuelle[]=$vardiag;
        }

        if(!is_null($cadre)){
            $vardiag = New Vardiag();
            $vardiag->name=$cadre->libelle;
            $vardiag->y=$cadre->nb;

            $qualification_contractuelle[]=$vardiag;
        }
        if(!is_null($employe)){
            $vardiag = New Vardiag();
            $vardiag->name=$employe->libelle;
            $vardiag->y=$employe->nb;

            $qualification_contractuelle[]=$vardiag;
        }
        if(!is_null($ouvrier)) {
            $vardiag = New Vardiag();
            $vardiag->name = $ouvrier->libelle;
            if(is_null($chauffeur)){
                $vardiag->y = $ouvrier->nb ;
            }else{
                $vardiag->y = $ouvrier->nb + $chauffeur->nb;
            }


            $qualification_contractuelle[] = $vardiag;
        }
        if(!is_null($stagiaire)) {
            $vardiag = New Vardiag();
            $vardiag->name = $stagiaire->libelle;
            $vardiag->y = $stagiaire->nb;

            $qualification_contractuelle[] = $vardiag;
        }

        return view('tableau_de_bord/globalExport',compact('effectifglobaux','repartition_nationalite','repartition_service','repartition_homme_femme','qualification_contractuelle'));
       // $pdf = PDF::loadView('tableau_de_bord/globalExport', compact('effectifglobaux','repartition_nationalite','repartition_service','repartition_homme_femme','qualification_contractuelle'));
      //  return $pdf->download('Global_'.date('d-m-Y').'.pdf');
    }

    public function printview(){

        return view('tableau_de_bord/printview');

    }
}
