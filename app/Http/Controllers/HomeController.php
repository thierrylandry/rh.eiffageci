<?php

namespace App\Http\Controllers;

use App\Personne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('home');
    }
    public function tableau_de_bord()
    {
        $tabResultat= [
            1,2,3,4,5,6,7,8,9,10,11,12
        ];

        $groupe_by_societe = DB::table('personne')
                            ->rightJoin('unite','unite.id_unite','=','personne.id_societe')
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
        $tabResultat= [
            1,2,3,4,5,6,7,8,9,10,11,12
        ];

      /*  $effectifglobaux = DB::table('personne')
                            ->rightJoin('unite','unite.id_unite','=','personne.id_societe')
                            ->groupBy('unite.id_unite')
                            ->select('libelleUnite',DB::raw('count(personne.id) as nb'))
                            ->get();
*/

        $effectifglobaux = DB::table('personne')
            ->groupBy('entite')
            ->select('entite',DB::raw('count(personne.id) as nb'))
            ->get();

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


        return view('tableau_de_bord/global',compact('effectifglobaux','json_entite','json_h_f','tabResultat'));
    }
    public function dirci()
    {
        $tabResultat= [
            1,2,3,4,5,6,7,8,9,10,11,12
        ];

        $effectifglobaux = DB::table('personne')
                            ->join('unite','unite.id_unite','=','personne.id_societe')
                            ->where("entite","=",3)
                            ->groupBy('unite.id_unite')
                            ->select('libelleUnite',DB::raw('count(personne.id) as nb'))
                            ->get();
        $repartition_nationalite = DB::table('personne')
            ->join('pays','pays.id','=','personne.nationalite')
            ->where("entite","=",3)
            ->select("pays.nom_fr_fr",DB::raw('count(personne.id) as nb'))
            ->groupBy('personne.nationalite')
            ->get();
        $repartition_homme_femme= DB::table('personne')
            ->where("entite","=",3)
            ->select("personne.sexe",DB::raw('count(personne.id) as nb'))
            ->groupBy('personne.sexe')
            ->get();

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


        return view('tableau_de_bord/dirci',compact('effectifglobaux','repartition_homme_femme','repartition_nationalite','json_entite','json_h_f','tabResultat'));
    }
}
