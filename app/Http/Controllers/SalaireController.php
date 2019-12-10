<?php

namespace App\Http\Controllers;

use App\Contrat;
use App\Entite;
use App\Metier\Json\Rubrique;
use App\Modification;
use App\Personne;
use App\Rubrique_salaire;
use App\Salaire;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaireController extends Controller
{
    //
    public function salaires()
    {

        $personnes = DB::table('personne')
            ->leftjoin('fonctions', 'fonctions.id', '=', 'personne.fonction')
            ->select('personne.id', 'personne.nom', 'personne.prenom', 'sexe', 'id_entite', 'id_unite', 'personne.slug', 'fonctions.libelle', 'nationalite')
            ->orderBy('id', 'desc')->get();
        $entites= Entite::all();
        return view('salaires/liste_personnel', compact('personnes','entites'));
    }

    public function liste_salaire($slug)
    {

         $personne = Personne::where('slug', '=', $slug)->get()->first();

        $contrat=Contrat::where([
            ['id_personne','=',$personne->id],
            ['matricule','=',$personne->matricule],

        ])->orderby('created_at', 'DESC')->get()->first();

        if(isset($contrat)){

            $salaires = DB::table('salaire')
                ->join('contrat', 'contrat.id', '=', 'salaire.id_contrat')
                ->leftJoin('categorie', 'contrat.id_categorie', '=', 'categorie.id')
                ->where('id_contrat','=',$contrat->id)
             //   ->select('categorie.libelle','salCategoriel','salaire.id', 'sursalaire', 'transport', 'logement', 'salissure', 'tenueTravail', 'retenue', 'dateDebutS', 'dateFin','datedebutc','datefinc')
                ->orderby('salaire.id', 'DESC')->get();
           //dd($salaires);
            $entites= Entite::all();
            return view('salaires/liste_salaire', compact('salaires', 'personne','entites'));
        }else{
            $entites= Entite::all();
            return view('salaires/liste_salaire', compact( 'personne','entites'));
        }



    }
public function recsalairecat($id_contrat){

    $categorie= Contrat::find($id_contrat)->categorie;
//dd($categorie);
    return $categorie;

}
    public function Ajouter_salaire($slug)
    {

        $personne = Personne::where('slug', '=', $slug)->get()->first();
        $contrats = Contrat::where([
                                        ['id_personne','=',$personne->id],

        ])->where('etat','=',1)->orderby('datedebutc', 'DESC')->get();
        $entites= Entite::all();
        if(isset($contrats)){
            $salaire = Salaire::where('id_contrat','=',$contrats->first()->id)
                ->orderby('dateDebutS', 'DESC')->get()->first();
            $rubrique_salaires= Rubrique_salaire::all();
            $modification = Modification::where('id_contrat','=',$contrats->first()->id)->first();
            return view('salaires/ajouter_salaire', compact('contrats', 'personne','salaire','entites','rubrique_salaires','modification'));
        }else{
            return view('salaires/ajouter_salaire',compact( 'personne','entites'));
        }


    }
    public function enregistrer_salaire(Request $request)
    {
        $parameters=$request->except(['_token']);

        $id_contrat=$parameters["id_contrat"];
        $dateDebutS= $parameters["dateDebutS"];
        $id_modification= $parameters["id_modification"];

        $contrat= Contrat::find($id_contrat);
        $personne= Personne::find($contrat->id_personne);
        $salaire=  new Salaire();

        $rubriques = new Collection();
        for($i = 0; $i <= count($request->input("rubrique"))-1; $i++ )
        {
            $rubrique = new Rubrique();

            if( !empty($request->input("valeur")[$i])){
                $rubrique->libelle = $request->input("rubrique")[$i];
                $rubrique->valeur= $request->input("valeur")[$i];
                $rubriques->add($rubrique);
            }

        }
        $salaire->valeurSalaire=json_encode($rubriques->toArray());


        $salaire->id_contrat=$id_contrat;
        $salaire->id_modification=$id_modification;
        $salaire->dateDebutS=$dateDebutS;
        $salaire->save();

        return redirect()->route('liste_salaire',['slug'=>$personne->slug])->with('success',"Le salaire  a été mis à jour avec succès");
    }
}
