<?php

namespace App\Http\Controllers;

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

        $groupe_by_societe = DB::table('personne')
                            ->rightJoin('societe','societe.id','=','personne.id_societe')
                            ->groupBy('societe.id')
                            ->select('libellesoc',DB::raw('count(personne.id) as nb'))
                            ->get();


        $effectifglobaux= Array();

        foreach ($groupe_by_societe as $group):
            $effectifglobaux[]=$group->nb;
            endforeach;
        $json_eff_globaux=json_encode($effectifglobaux);

// effectif locaux


        $groupe_by_entite = DB::table('personne')
            ->select(DB::raw('count(personne.id) as nb'))
            ->groupBy('personne.entite')
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


        return view('welcome',compact('json_eff_globaux','json_entite','json_h_f'));
    }
}
