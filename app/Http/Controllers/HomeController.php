<?php

namespace App\Http\Controllers;

use App\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
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


        $effectifglobaux_tab3=DB::table('personne')
            ->join('unite','unite.id_unite','=','personne.id_unite')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('entite','=',3)
            ->groupBy('unite.id_unite','entite')
            ->select('libelleUnite','entite',DB::raw('count(personne.id) as nb'));
        $effectifglobaux_tab2=DB::table('personne')
            ->join('unite','unite.id_unite','=','personne.id_unite')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('entite','=',2)
            ->groupBy('unite.id_unite','entite')
            ->select('libelleUnite','entite',DB::raw('count(personne.id) as nb'));

        $soustraitant = DB::table('effectif')
            ->select('nom as libelleUnite','effectif as entite','effectif as nb');
        $effectifglobaux_tabx=DB::table('personne')
            ->join('unite','unite.id_unite','=','personne.id_unite')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('entite','=',1)
            ->groupBy('unite.id_unite','entite')
            ->select('libelleUnite','entite',DB::raw('count(personne.id) as nb'))
            ->union($effectifglobaux_tab3)
            ->union($effectifglobaux_tab2)
            ->union($soustraitant)
            ->get();

//dd($effectifglobaux_tab);
        $effectifglobauxx= Array();
        foreach ($effectifglobaux_tabx as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->libelleUnite;
            $vardiag->entite=$group->entite;
            $vardiag->y=$group->nb;

            $effectifglobauxx[]=$vardiag;
        endforeach;



        $soustraitant = DB::table('effectif')
                        ->select('nom as libelleUnite','effectif as nb');
//dd($soustraitant);
        $effectifglobaux_tab = DB::table('personne')
            ->groupBy('unite.id_unite')
            ->orderBy('unite.id_unite','DESC')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->join('unite','unite.id_unite','=','personne.id_unite')
            ->where('contrat.etat','=',1)
            ->select('unite.libelleUnite',DB::raw('count(personne.id) as nb'))
            ->union($soustraitant)
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

        // qualification contractuelle
        $cadre = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where([
                ['contrat.etat','=',1],
                ['definition.id','=',1],
            ])
            ->orWhere([
                ['entite','=',1],
                ['entite','=',2],
            ])
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $agent_de_maitrise = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where([
                ['contrat.etat','=',1],
                ['definition.id','=',2],
            ])
            ->orWhere([
                ['entite','=',1],
                ['entite','=',2],
            ])
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $employe = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where([
                ['contrat.etat','=',1],
                ['definition.id','=',3],
            ])
            ->orWhere([
                ['entite','=',1],
                ['entite','=',2],
            ])->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $chauffeur = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where([
                ['contrat.etat','=',1],
                ['definition.id','=',5],
            ])
            ->orWhere([
                ['entite','=',1],
                ['entite','=',2],
            ])
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $ouvrier = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where([
                ['contrat.etat','=',1],
                ['definition.id','=',4],
            ])
            ->orWhere([
                ['entite','=',1],
                ['entite','=',2],
                ['definition.id','=',5],
            ])
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $stagiaire = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where([
                ['contrat.etat','=',1],
                ['definition.id','=',6],
            ])
            ->orWhere([
                ['entite','=',1],
                ['entite','=',2],
            ])
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
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


        return view('tableau_de_bord/global',compact('qualification_contractuelle','effectifglobaux','effectifglobauxx','repartition_nationalite','repartition_service','repartition_homme_femme'));
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
            ->where('personne_age.age','>=',30)
            ->where('personne_age.age','<=',39)
            ->get();
        $tranche_age_de_40_a_49_ans= DB::table('personne')
            ->where("entite","=",3)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','>=',40)
            ->where('personne_age.age','<=',49)
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



        $a_mois = array ( '1' => 'Janvier', '2' => 'Fevrier', '3' => 'Mars',
            '4' => 'Avril','5' => 'Mai', '6' => 'Juin','7' => 'Juillet',
            '8' => 'Aout','9' => 'Septembre', '10' => 'Octobre','11' => 'Novembre', '12' => 'Décembre') ;
        $repartition_entrees= Array();
        $repartition_sorties= Array();


//debut entrée
        $entrees= DB::select('call proc_entrees(3)');
        $sorties= DB::select('call proc_sortie(3)');
        $annee_moins1=date('Y')-1;
        $tab_allege= Array();
        foreach ($entrees as $entree):

            $tab_allege[$entree->numeromois.':'.$entree->annee]=$entree->entree;

            endforeach;

       // dd($tab_allege);
        $vardiag = New Vardiag();
        if(isset($tab_allege["11:".$annee_moins1])){


                $vardiag->name=$a_mois[11]."-".$annee_moins1;

                $vardiag->y=$tab_allege["11:".$annee_moins1];
            $repartition_entrees[]=$vardiag;
        }else{
            $vardiag->name="Novembre-".$annee_moins1;

            $vardiag->y=0;
            $repartition_entrees[]=$vardiag;
        }
        $vardiag = New Vardiag();
        if(isset($tab_allege["12:".$annee_moins1])){


                $vardiag->name=$a_mois[12]."-".$annee_moins1;

                $vardiag->y=$tab_allege["12:".$annee_moins1];
            $repartition_entrees[]=$vardiag;
        }else{
            $vardiag->name="Décembre-".$annee_moins1;

            $vardiag->y=0;
            $repartition_entrees[]=$vardiag;
        }


            for( $i=1; $i<=12; $i++){
                $vardiag = New Vardiag();

                if(isset($tab_allege[$i.":".date('Y')])){
                    $vardiag->name=$a_mois[$i]."-".date('Y');

                    $vardiag->y=$tab_allege[$i.":".date('Y')];
                }else{
                    $vardiag->name=$a_mois[$i]."-".date('Y');
                }
                $repartition_entrees[]=$vardiag;
            }


//fin entree
        //debut sorti


        $annee_moins1=date('Y')-1;
        $tab_allege_sorti= Array();
        foreach ($sorties as $sortie):

            $tab_allege_sorti[$sortie->numeromois.':'.$sortie->annee]=$sortie->sortie;

        endforeach;


        $vardiag = New Vardiag();
        if(isset($tab_allege_sorti["11:".$annee_moins1])){


            $vardiag->name=$a_mois[11]."-".$annee_moins1;

            $vardiag->y=$tab_allege_sorti["11:".$annee_moins1];
            $repartition_sorties[]=$vardiag;
        }else{
            $vardiag->name="Novembre-".$annee_moins1;

            $vardiag->y=0;
            $repartition_sorties[]=$vardiag;
        }
        $vardiag = New Vardiag();
        if(isset($tab_allege_sorti["12:".$annee_moins1])){


            $vardiag->name=$a_mois[12]."-".$annee_moins1;

            $vardiag->y=$tab_allege_sorti["12:".$annee_moins1];
            $repartition_sorties[]=$vardiag;
        }else{
            $vardiag->name="Décembre-".$annee_moins1;

            $vardiag->y=0;
            $repartition_sorties[]=$vardiag;
        }


        for( $i=1; $i<=12; $i++){
            $vardiag = New Vardiag();

            if(isset($tab_allege_sorti[$i.":".date('Y')])){
                $vardiag->name=$a_mois[$i]."-".date('Y');

                $vardiag->y=$entree->entree;
            }else{
                $vardiag->name=$a_mois[$i]."-".date('Y');
            }
            $repartition_sorties[]=$vardiag;
        }

        //dd($repartition_sorties);
        $cadre = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',1)
            ->where('entite','=',3)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $agent_de_maitrise = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',2)
            ->where('entite','=',3)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $employe = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',3)
            ->where('entite','=',3)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $chauffeur = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',5)
            ->where('entite','=',3)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $ouvrier = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',4)
            ->orWhere('definition.id','=',5)
            ->where('entite','=',3)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $stagiaire = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',6)
            ->where('entite','=',3)
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

        return view('tableau_de_bord/dirci',compact('effectifglobaux','repartition_homme_femme','repartition_nationalite','repartition_tranche_age','repartition_ancienete','repartition_service','repartition_entrees','repartition_sorties','qualification_contractuelle'));
    }


    public function phb()
    {



        $effectifglobaux_tab3=DB::table('personne')
           ->join('unite','unite.id_unite','=','personne.id_unite')
           ->join('contrat','contrat.id_personne','=','personne.id')
           ->where('contrat.etat','=',1)
            ->where('entite','=',3)
           ->groupBy('unite.id_unite','entite')
           ->select('libelleUnite','entite',DB::raw('count(personne.id) as nb'));
        $effectifglobaux_tab2=DB::table('personne')
           ->join('unite','unite.id_unite','=','personne.id_unite')
           ->join('contrat','contrat.id_personne','=','personne.id')
           ->where('contrat.etat','=',1)
            ->where('entite','=',2)
           ->groupBy('unite.id_unite','entite')
           ->select('libelleUnite','entite',DB::raw('count(personne.id) as nb'));

        $soustraitant = DB::table('effectif')
            ->select('nom as libelleUnite','effectif as entite','effectif as nb');
               $effectifglobaux_tab=DB::table('personne')
                   ->join('unite','unite.id_unite','=','personne.id_unite')
                   ->join('contrat','contrat.id_personne','=','personne.id')
                   ->where('contrat.etat','=',1)
                   ->where('entite','=',1)
                   ->groupBy('unite.id_unite','entite')
                   ->select('libelleUnite','entite',DB::raw('count(personne.id) as nb'))
                  ->union($effectifglobaux_tab3)
                   ->union($effectifglobaux_tab2)
                   ->union($soustraitant)
                    ->get();

//dd($effectifglobaux_tab);
        $effectifglobaux= Array();
        foreach ($effectifglobaux_tab as $group):
            $vardiag = New Vardiag();
            $vardiag->name=$group->libelleUnite;
            $vardiag->entite=$group->entite;
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
            ->where('personne_age.age','>=',30)
            ->where('personne_age.age','<=',39)
            ->get();
        $tranche_age_de_40_a_49_ans= DB::table('personne')
            ->where("entite","=",1)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','>=',40)
            ->where('personne_age.age','<=',49)
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



        $a_mois = array ( '1' => 'Janvier', '2' => 'Fevrier', '3' => 'Mars',
            '4' => 'Avril','5' => 'Mai', '6' => 'Juin','7' => 'Juillet',
            '8' => 'Aout','9' => 'Septembre', '10' => 'Octobre','11' => 'Novembre', '12' => 'Décembre') ;
        $repartition_entrees= Array();
        $repartition_sorties= Array();


//debut entrée
        $entrees= DB::select('call proc_entrees(1)');
        $sorties= DB::select('call proc_sortie(1)');
        $annee_moins1=date('Y')-1;
        $tab_allege= Array();
        foreach ($entrees as $entree):

            $tab_allege[$entree->numeromois.':'.$entree->annee]=$entree->entree;

        endforeach;

        // dd($tab_allege);
        $vardiag = New Vardiag();
        if(isset($tab_allege["11:".$annee_moins1])){


            $vardiag->name=$a_mois[11]."-".$annee_moins1;

            $vardiag->y=$tab_allege["11:".$annee_moins1];
            $repartition_entrees[]=$vardiag;
        }else{
            $vardiag->name="Novembre-".$annee_moins1;

            $vardiag->y=0;
            $repartition_entrees[]=$vardiag;
        }
        $vardiag = New Vardiag();
        if(isset($tab_allege["12:".$annee_moins1])){


            $vardiag->name=$a_mois[12]."-".$annee_moins1;

            $vardiag->y=$tab_allege["12:".$annee_moins1];
            $repartition_entrees[]=$vardiag;
        }else{
            $vardiag->name="Décembre-".$annee_moins1;

            $vardiag->y=0;
            $repartition_entrees[]=$vardiag;
        }


        for( $i=1; $i<=12; $i++){
            $vardiag = New Vardiag();

            if(isset($tab_allege[$i.":".date('Y')])){
                $vardiag->name=$a_mois[$i]."-".date('Y');

                $vardiag->y=$tab_allege[$i.":".date('Y')];
            }else{
                $vardiag->name=$a_mois[$i]."-".date('Y');
            }
            $repartition_entrees[]=$vardiag;
        }


//fin entree
        //debut sorti


        $annee_moins1=date('Y')-1;
        $tab_allege_sorti= Array();
        foreach ($sorties as $sortie):

            $tab_allege_sorti[$sortie->numeromois.':'.$sortie->annee]=$sortie->sortie;

        endforeach;


        $vardiag = New Vardiag();
        if(isset($tab_allege_sorti["11:".$annee_moins1])){


            $vardiag->name=$a_mois[11]."-".$annee_moins1;

            $vardiag->y=$tab_allege_sorti["11:".$annee_moins1];
            $repartition_sorties[]=$vardiag;
        }else{
            $vardiag->name="Novembre-".$annee_moins1;

            $vardiag->y=0;
            $repartition_sorties[]=$vardiag;
        }
        $vardiag = New Vardiag();
        if(isset($tab_allege_sorti["12:".$annee_moins1])){


            $vardiag->name=$a_mois[12]."-".$annee_moins1;

            $vardiag->y=$tab_allege_sorti["12:".$annee_moins1];
            $repartition_sorties[]=$vardiag;
        }else{
            $vardiag->name="Décembre-".$annee_moins1;

            $vardiag->y=0;
            $repartition_sorties[]=$vardiag;
        }


        for( $i=1; $i<=12; $i++){
            $vardiag = New Vardiag();

            if(isset($tab_allege_sorti[$i.":".date('Y')])){
                $vardiag->name=$a_mois[$i]."-".date('Y');

                $vardiag->y=$entree->entree;
            }else{
                $vardiag->name=$a_mois[$i]."-".date('Y');
            }
            $repartition_sorties[]=$vardiag;
        }

        // qualification contractuelle
        $cadre = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.departDefinitif','=',null)
            ->where('contrat.matricule','=','personne.matricule')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',1)
            ->where('entite','=',1)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $agent_de_maitrise = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('contrat.departDefinitif','=',null)
            ->where('contrat.matricule','=','personne.matricule')
            ->where('definition.id','=',2)
            ->where('entite','=',1)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $employe = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('contrat.departDefinitif','=',null)
            ->where('contrat.matricule','=','personne.matricule')
            ->where('definition.id','=',3)

            ->where('entite','=',1)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $chauffeur = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('contrat.departDefinitif','=',null)
            ->where('contrat.matricule','=','personne.matricule')
            ->where('definition.id','=',5)
            ->where('entite','=',1)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $ouvrier = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('contrat.departDefinitif','=',null)
            ->where('contrat.matricule','=','personne.matricule')
            ->where('definition.id','=',4)
            ->orWhere('definition.id','=',5)
            ->where('entite','=',1)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $stagiaire = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('contrat.departDefinitif','=',null)
            ->where('contrat.matricule','=','personne.matricule')
            ->where('definition.id','=',6)
            ->where('entite','=',1)
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

        return view('tableau_de_bord/phb',compact('effectifglobaux','repartition_homme_femme','repartition_nationalite','repartition_tranche_age','repartition_ancienete','repartition_service','repartition_entrees','repartition_sorties','qualification_contractuelle'));
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
            ->where('personne_age.age','>=',30)
            ->where('personne_age.age','<=',39)
            ->get();
        $tranche_age_de_40_a_49_ans= DB::table('personne')
            ->where("entite","=",2)
            ->join('personne_age','personne_age.id','=','personne.id')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('personne_age.age','>=',40)
            ->where('personne_age.age','<=',49)
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
        $a_mois = array ( '1' => 'Janvier', '2' => 'Fevrier', '3' => 'Mars',
            '4' => 'Avril','5' => 'Mai', '6' => 'Juin','7' => 'Juillet',
            '8' => 'Aout','9' => 'Septembre', '10' => 'Octobre','11' => 'Novembre', '12' => 'Décembre') ;
        $repartition_entrees= Array();
        $repartition_sorties= Array();


//debut entrée
        $entrees= DB::select('call proc_entrees(2)');
        $sorties= DB::select('call proc_sortie(2)');
        $annee_moins1=date('Y')-1;
        $tab_allege= Array();
        foreach ($entrees as $entree):

            $tab_allege[$entree->numeromois.':'.$entree->annee]=$entree->entree;

        endforeach;

        // dd($tab_allege);
        $vardiag = New Vardiag();
        if(isset($tab_allege["11:".$annee_moins1])){


            $vardiag->name=$a_mois[11]."-".$annee_moins1;

            $vardiag->y=$tab_allege["11:".$annee_moins1];
            $repartition_entrees[]=$vardiag;
        }else{
            $vardiag->name="Novembre-".$annee_moins1;

            $vardiag->y=0;
            $repartition_entrees[]=$vardiag;
        }
        $vardiag = New Vardiag();
        if(isset($tab_allege["12:".$annee_moins1])){


            $vardiag->name=$a_mois[12]."-".$annee_moins1;

            $vardiag->y=$tab_allege["12:".$annee_moins1];
            $repartition_entrees[]=$vardiag;
        }else{
            $vardiag->name="Décembre-".$annee_moins1;

            $vardiag->y=0;
            $repartition_entrees[]=$vardiag;
        }


        for( $i=1; $i<=12; $i++){
            $vardiag = New Vardiag();

            if(isset($tab_allege[$i.":".date('Y')])){
                $vardiag->name=$a_mois[$i]."-".date('Y');

                $vardiag->y=$tab_allege[$i.":".date('Y')];
            }else{
                $vardiag->name=$a_mois[$i]."-".date('Y');
            }
            $repartition_entrees[]=$vardiag;
        }


//fin entree
        //debut sorti


        $annee_moins1=date('Y')-1;
        $tab_allege_sorti= Array();
        foreach ($sorties as $sortie):

            $tab_allege_sorti[$sortie->numeromois.':'.$sortie->annee]=$sortie->sortie;

        endforeach;


        $vardiag = New Vardiag();
        if(isset($tab_allege_sorti["11:".$annee_moins1])){


            $vardiag->name=$a_mois[11]."-".$annee_moins1;

            $vardiag->y=$tab_allege_sorti["11:".$annee_moins1];
            $repartition_sorties[]=$vardiag;
        }else{
            $vardiag->name="Novembre-".$annee_moins1;

            $vardiag->y=0;
            $repartition_sorties[]=$vardiag;
        }
        $vardiag = New Vardiag();
        if(isset($tab_allege_sorti["12:".$annee_moins1])){


            $vardiag->name=$a_mois[12]."-".$annee_moins1;

            $vardiag->y=$tab_allege_sorti["12:".$annee_moins1];
            $repartition_sorties[]=$vardiag;
        }else{
            $vardiag->name="Décembre-".$annee_moins1;

            $vardiag->y=0;
            $repartition_sorties[]=$vardiag;
        }


        for( $i=1; $i<=12; $i++){
            $vardiag = New Vardiag();

            if(isset($tab_allege_sorti[$i.":".date('Y')])){
                $vardiag->name=$a_mois[$i]."-".date('Y');

                $vardiag->y=$entree->entree;
            }else{
                $vardiag->name=$a_mois[$i]."-".date('Y');
            }
            $repartition_sorties[]=$vardiag;
        }

        $cadre = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',1)
            ->where('entite','=',2)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $agent_de_maitrise = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',2)
            ->where('entite','=',2)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $employe = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',3)
            ->where('entite','=',2)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $chauffeur = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',5)
            ->where('entite','=',2)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $ouvrier = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',4)
            ->orWhere('definition.id','=',5)
            ->where('entite','=',2)
            ->join('definition','definition.id','=','contrat.id_definition')
            ->select("definition.libelle",DB::raw('count(personne.id) as nb'))
            ->groupBy('definition.id')
            ->get()->first();
        $stagiaire = DB::table('personne')
            ->join('contrat','contrat.id_personne','=','personne.id')
            ->where('contrat.etat','=',1)
            ->where('definition.id','=',6)
            ->where('entite','=',2)
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


        return view('tableau_de_bord/spie_fondation',compact('effectifglobaux','repartition_homme_femme','repartition_nationalite','repartition_tranche_age','repartition_ancienete','repartition_service','repartition_entrees','repartition_sorties','qualification_contractuelle'));
    }

    public function printview(){

        return view('tableau_de_bord/printview');

    }
}
