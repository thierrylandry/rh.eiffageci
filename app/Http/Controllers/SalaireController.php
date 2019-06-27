<?php

namespace App\Http\Controllers;

use App\Contrat;
use App\Personne;
use App\Salaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaireController extends Controller
{
    //
    public function salaires()
    {

        $personnes = DB::table('personne')
            ->leftjoin('fonctions', 'fonctions.id', '=', 'personne.fonction')
            ->select('personne.id', 'personne.nom', 'personne.prenom', 'sexe', 'entite', 'id_unite', 'personne.slug', 'fonctions.libelle', 'nationalite')
            ->orderBy('id', 'desc')->get();
        return view('salaires/liste_personnel', compact('personnes'));
    }

    public function liste_salaire($slug)
    {

        $personne = $personne = Personne::where('slug', '=', $slug)->get()->first();
        $salaires = DB::table('salaire')
            ->join('contrat', 'contrat.id', '=', 'salaire.id_contrat')
            ->select('salaire.id', 'sursalaire', 'transport', 'logement', 'salissure', 'tenueTravail', 'retenue', 'dateDebutS', 'dateFin','datedebutc','datefinc')
            ->orderby('salaire.id', 'DESC')->get();

        return view('salaires/liste_salaire', compact('salaires', 'personne'));
    }

    public function Ajouter_salaire($slug)
    {

        $personne = Personne::where('slug', '=', $slug)->get()->first();
        $contrat = Contrat::where([
                                        ['id_personne','=',$personne->id],
                                         ['matricule','=',$personne->matricule],
        ])->get()->first();

        $salaire = Salaire::where('id_contrat','=',$contrat->id)
            ->orderby('id', 'DESC')->get()->first();
        return view('salaires/ajouter_salaire', compact('contrat', 'personne','salaire'));
    }
    public function enregistrer_salaire(Request $request)
    {
        $parameters=$request->except(['_token']);

        $id_contrat=$parameters["id_contrat"];
        $sursalaire=$parameters["sursalaire"];
        $transport=$parameters["transport"];
        $logement=$parameters["logement"];
        $salissure= $parameters["salissure"];
        $retenue= $parameters["retenue"];
        $tenueTravail= $parameters["tenueTravail"];
        $dateDebutS= $parameters["dateDebutS"];

        $contrat= Contrat::find($id_contrat);
        $personne= Personne::find($contrat->id_personne);
        $salaire=  new Salaire();

        $salaire->id_contrat=$id_contrat;
        $salaire->sursalaire=$sursalaire;
        $salaire->transport=$transport;
        $salaire->logement=$logement;
        $salaire->salissure=$salissure;
        $salaire->tenueTravail=$tenueTravail;
        $salaire->retenue=$retenue;
        $salaire->dateDebutS=$dateDebutS;
        $salaire->save();

        return redirect()->route('liste_salaire',['slug'=>$personne->slug])->with('success',"Le salaire  a été mis à jour avec succès");
    }
}
