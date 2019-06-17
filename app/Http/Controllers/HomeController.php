<?php

namespace App\Http\Controllers;

use App\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Vardiag;

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

        $groupe_by_societe = DB::table('personne')
                            ->rightJoin('unite','unite.id_unite','=','personne.id_unite')
                            ->groupBy('unite.id_unite')
                            ->select('libelleUnite',DB::raw('count(personne.id) as nb'))
                            ->get();


        $effectifglobaux= Array();

        foreach ($groupe_by_societe as $group):
            $effectifglobaux[]=$group->nb;
            endforeach;
//dd($groupe_by_societe);
// effectif locaux


        $groupe_by_entite = DB::table('personne')
            ->select(DB::raw('count(personne.id) as nb'))
            ->groupBy('personne.entite')
            ->orderBy('entite', 'desc')
            ->get();

        $effectiflocaux= Array();
        foreach ($groupe_by_entite as $group):
            $effectiflocaux[]=$group->nb;
        endforeach;
        $json_entite=json_encode($effectiflocaux);


        //repartition homme femme
        $groupe_by_h_f = DB::table('personne')
            ->select(DB::raw('count(personne.id) as nb'))
            ->groupBy('personne.sexe')
            ->get();

        $effectif_h_f= Array();
        foreach ($groupe_by_h_f as $group):
            $effectif_h_f[]=$group->nb;
        endforeach;
        $json_h_f=json_encode($effectif_h_f);


        return view('welcome',compact('effectifglobaux','json_entite','json_h_f','tabResultat'));
    }
    public function globale()
    {
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

        if(!is_null($agent_de_maitrise)){
        $vardiag = New Vardiag();
            $vardiag->name=$cadre->libelle;
            $vardiag->y=$cadre->nb;

            $qualification_contractuelle[]=$vardiag;
        }
        if(!is_null($agent_de_maitrise)){
        $vardiag = New Vardiag();
            $vardiag->name=$employe->libelle;
            $vardiag->y=$employe->nb;

            $qualification_contractuelle[]=$vardiag;
        }
        if(!is_null($agent_de_maitrise)) {
            $vardiag = New Vardiag();
            $vardiag->name = $ouvrier->libelle;
            $vardiag->y = $ouvrier->nb + $chauffeur->nb;

            $qualification_contractuelle[] = $vardiag;
        }
        if(!is_null($agent_de_maitrise)) {
            $vardiag = New Vardiag();
            $vardiag->name = $stagiaire->libelle;
            $vardiag->y = $stagiaire->nb;

            $qualification_contractuelle[] = $vardiag;
        }

        return view('tableau_de_bord/global',compact('effectifglobaux','repartition_nationalite','repartition_service','repartition_homme_femme','qualification_contractuelle'));
    }
    public function dirci()
    {

        $effectifglobaux_tab = DB::table('personne')
                            ->join('unite','unite.id_unite','=','personne.id_unite')
                              ->join('contrat','contrat.id_personne','=','personne.id')
                             ->where('contrat.etat','=',1)
                            ->where("entite","=",3)
                            ->groupBy('unite.id_unite')
                            ->select('libelleUnite',DB::raw('count(personne.id) as nb'))
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
            ->where("entite","=",3)
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
            ->where("entite","=",3)
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

        $tranche_age_moin30_ans= DB::table('personne')
            ->where("entite","=",3)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','<',30)
            ->get();
        $tranche_age_de_30_a_39_ans= DB::table('personne')
            ->where("entite","=",3)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','<=',30)
            ->where('personne_age.age','>=',39)
            ->get();
        $tranche_age_de_40_a_49_ans= DB::table('personne')
            ->where("entite","=",3)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','<=',40)
            ->where('personne_age.age','>=',49)
            ->get();
        $tranche_age_de50_ans= DB::table('personne')
            ->where("entite","=",3)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','>',50)
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

        $anciennete_contrat_moins_3_mois_ = DB::table('personne')
            ->where("entite","=",3)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','<',3)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();

        $anciennete_contrat__3_a_6_mois_ = DB::table('personne')
            ->where("entite","=",3)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','>=',3)
            ->where('temps','<=',6)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();

        $anciennete_contrat__7_a_10_mois_ = DB::table('personne')
            ->where("entite","=",3)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','>=',7)
            ->where('temps','<=',10)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();
        $anciennete_contrat__11_a_12_mois_ = DB::table('personne')
            ->where("entite","=",3)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','>=',11)
            ->where('temps','<=',12)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();
        $anciennete_contrat_superieur_a_12_mois_ = DB::table('personne')
            ->where("entite","=",3)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','>',12)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();


       //->join('contrat','contrat.id_personne','=','personne.id')
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

        //repartition par service
        $repartition_service_tab = DB::table('personne')
            ->where("entite","=",3)
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

        //entrée / sortie
$entre_novembre_annee_prec = DB::table('personne')
    ->where("entite","=",3)
    ->join('contrat','contrat.id_personne','=','personne.id')
    ->whereMonth('datedebutc','=',11)
    ->whereYear('datedebutc','=',now()->year-1)
    ->where('contrat.etat','=',1)
    ->select("nom",DB::raw('count(personne.id) as nb'))
    ->groupBy('personne.id')
    ->get();
        $entre_decembre_annee_prec =DB::table('personne')
    ->join('contrat','contrat.id_personne','=','personne.id')
            ->whereMonth('datedebutc','=',12)
            ->whereYear('datedebutc','=',now()->year-1)
            ->where('contrat.etat','=',2)
    ->select(DB::raw('count(personne.id) as nb'))
    ->groupBy('personne.id')
    ->get();
        $entre_janvier_annee =DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->whereMonth('datedebutc','=',1)
            ->whereYear('datedebutc','=',now()->year)
            ->where('contrat.etat','=',2)
            ->select(DB::raw('count(personne.id) as nb'))
            ->groupBy('personne.id')
            ->get();
        $entre_fevrier_annee =DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->whereMonth('datedebutc','=',2)
            ->whereYear('datedebutc','=',now()->year)
            ->where('contrat.etat','=',2)
            ->select(DB::raw('count(personne.id) as nb'))
            ->groupBy('personne.id')
            ->get();
        $entre_mars_annee =DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->whereMonth('datedebutc','=',3)
            ->whereYear('datedebutc','=',now()->year)
            ->where('contrat.etat','=',2)
            ->select(DB::raw('count(personne.id) as nb'))
            ->groupBy('personne.id')
            ->get();
        $entre_avril_annee =DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->whereMonth('datedebutc','=',4)
            ->whereYear('datedebutc','=',now()->year)
            ->where('contrat.etat','=',2)
            ->select(DB::raw('count(personne.id) as nb'))
            ->groupBy('personne.id')
            ->get();
        $entre_mais_annee =DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->whereMonth('datedebutc','=',5)
            ->whereYear('datedebutc','=',now()->year)
            ->where('contrat.etat','=',2)
            ->select(DB::raw('count(personne.id) as nb'))
            ->groupBy('personne.id')
            ->get();
        $entre_juin_annee =DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->whereMonth('datedebutc','=',6)
            ->whereYear('datedebutc','=',now()->year)
            ->where('contrat.etat','=',2)
            ->select(DB::raw('count(personne.id) as nb'))
            ->groupBy('personne.id')
            ->get();
        $entre_juillet_annee =DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->whereMonth('datedebutc','=',7)
            ->whereYear('datedebutc','=',now()->year)
            ->where('contrat.etat','=',2)
            ->select(DB::raw('count(personne.id) as nb'))
            ->groupBy('personne.id')
            ->get();
        $entre_juillet_annee =DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->whereMonth('datedebutc','=',7)
            ->whereYear('datedebutc','=',now()->year)
            ->where('contrat.etat','=',2)
            ->select(DB::raw('count(personne.id) as nb'))
            ->groupBy('personne.id')
            ->get();

     //   dd($entre_decembre_annee_prec);
        return view('tableau_de_bord/dirci',compact('effectifglobaux','repartition_homme_femme','repartition_nationalite','repartition_tranche_age','repartition_ancienete','repartition_service'));
    }

    public function phb()
    {

        $effectifglobaux_tab = DB::table('personne')
                            ->join('unite','unite.id_unite','=','personne.id_unite')
                              ->join('contrat','contrat.id_personne','=','personne.id')
                             ->where('contrat.etat','=',1)
                            ->where("entite","=",1)
                            ->groupBy('unite.id_unite')
                            ->select('libelleUnite',DB::raw('count(personne.id) as nb'))
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
            ->where("entite","=",1)
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
            ->where("entite","=",1)
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

        $tranche_age_moin30_ans= DB::table('personne')
            ->where("entite","=",1)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','<',30)
            ->get();
        $tranche_age_de_30_a_39_ans= DB::table('personne')
            ->where("entite","=",1)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','<=',30)
            ->where('personne_age.age','>=',39)
            ->get();
        $tranche_age_de_40_a_49_ans= DB::table('personne')
            ->where("entite","=",1)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','<=',40)
            ->where('personne_age.age','>=',49)
            ->get();
        $tranche_age_de50_ans= DB::table('personne')
            ->where("entite","=",1)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','>',50)
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

        $anciennete_contrat_moins_3_mois_ = DB::table('personne')
            ->where("entite","=",1)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','<',3)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();

        $anciennete_contrat__3_a_6_mois_ = DB::table('personne')
            ->where("entite","=",1)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','>=',3)
            ->where('temps','<=',6)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();

        $anciennete_contrat__7_a_10_mois_ = DB::table('personne')
            ->where("entite","=",1)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','>=',7)
            ->where('temps','<=',10)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();
        $anciennete_contrat__11_a_12_mois_ = DB::table('personne')
            ->where("entite","=",1)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','>=',11)
            ->where('temps','<=',12)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();
        $anciennete_contrat_superieur_a_12_mois_ = DB::table('personne')
            ->where("entite","=",1)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','>',12)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();


       //->join('contrat','contrat.id_personne','=','personne.id')
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

        //repartition par service
        $repartition_service_tab = DB::table('personne')
            ->where("entite","=",1)
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

        //entrée / sortie



        return view('tableau_de_bord/phb',compact('effectifglobaux','repartition_homme_femme','repartition_nationalite','repartition_tranche_age','repartition_ancienete','repartition_service'));
    }
    public function spie_fondation()
    {

        $effectifglobaux_tab = DB::table('personne')
                            ->join('unite','unite.id_unite','=','personne.id_unite')
                              ->join('contrat','contrat.id_personne','=','personne.id')
                             ->where('contrat.etat','=',1)
                            ->where("entite","=",2)
                            ->groupBy('unite.id_unite')
                            ->select('libelleUnite',DB::raw('count(personne.id) as nb'))
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
            ->where("entite","=",2)
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
            ->where("entite","=",2)
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

        $tranche_age_moin30_ans= DB::table('personne')
            ->where("entite","=",2)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','<',30)
            ->get();
        $tranche_age_de_30_a_39_ans= DB::table('personne')
            ->where("entite","=",2)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','<=',30)
            ->where('personne_age.age','>=',39)
            ->get();
        $tranche_age_de_40_a_49_ans= DB::table('personne')
            ->where("entite","=",2)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','<=',40)
            ->where('personne_age.age','>=',49)
            ->get();
        $tranche_age_de50_ans= DB::table('personne')
            ->where("entite","=",2)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','>',50)
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

        $anciennete_contrat_moins_3_mois_ = DB::table('personne')
            ->where("entite","=",2)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','<',3)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();

        $anciennete_contrat__3_a_6_mois_ = DB::table('personne')
            ->where("entite","=",2)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','>=',3)
            ->where('temps','<=',6)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();

        $anciennete_contrat__7_a_10_mois_ = DB::table('personne')
            ->where("entite","=",2)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','>=',7)
            ->where('temps','<=',10)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();
        $anciennete_contrat__11_a_12_mois_ = DB::table('personne')
            ->where("entite","=",2)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','>=',11)
            ->where('temps','<=',12)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();
        $anciennete_contrat_superieur_a_12_mois_ = DB::table('personne')
            ->where("entite","=",2)
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->join('ancienete','ancienete.id_personne','=','personne.id')
            ->where('temps','>',12)
            ->select("ancienete.id_personne",DB::raw('sum(temps) as temps'))
            ->groupBy('personne.id')
            ->get();


       //->join('contrat','contrat.id_personne','=','personne.id')
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

        //repartition par service
        $repartition_service_tab = DB::table('personne')
            ->where("entite","=",2)
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

        //entrée / sortie



        return view('tableau_de_bord/spie_fondation',compact('effectifglobaux','repartition_homme_femme','repartition_nationalite','repartition_tranche_age','repartition_ancienete','repartition_service'));
    }
}
