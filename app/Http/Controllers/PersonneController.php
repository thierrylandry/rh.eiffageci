<?php

namespace App\Http\Controllers;

use App\Administratif;
use App\Liste_Administratif;
use App\Metier\Json\Famille;
use App\Pays;
use App\Personne;
use App\Societe;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\UploadHandler;
class PersonneController extends Controller
{
    //
    public function ajouter_personne()
    {
        $societes=Societe::all();
        $payss=Pays::all();
        return view('personne/ajouter_personne',compact('societes','payss'));
    }
    public function lister_personne()
    {
        $personnes= Personne::orderBy('id', 'desc')->get();
        $societes=Societe::all();
        $payss=Pays::all();
        return view('personne/lister_personne',compact('personnes','societes','payss'));
    }
    public function document_administratif($slug)
    {
        $personne= Personne::where('slug','=',$slug)->get()->first();
        $doc_admins= Administratif::where('id_personne','=',$personne->id)->get();
        $list_administratif= Liste_Administratif::all();
        return view('personne/document_administratif',compact('personne','list_administratif','doc_admins'));
    }

    public function enregistrer_personne(Request $request){

        $parameters=$request->except(['_token']);
        $nom=$parameters['nom'];
        $prenom=$parameters['prenom'];
        $datenaissance=$parameters['datenaissance'];
        $sexe=$parameters['sexe'];
        $nationnalite=$parameters['nationnalite'];
        $sit=$parameters['sit'];
        $nb_enf=$parameters['nb_enf'];
        $email=$parameters['email'];
        $contact=$parameters['contact'];
        $cnps=$parameters['cnps'];
        $rib=$parameters['rib'];
        $rh=$parameters['rh'];
        $fonction=$parameters['fonction'];
        $service=$parameters['service'];
        $entite=$parameters['entite'];
        $societe=$parameters['societe'];
        $pointure=$parameters['pointure'];

        $date= new \DateTime(null);


        $personne= new Personne();
        $personne->nom=$nom;
        $personne->prenom=$prenom;
        $personne->datenaissance=$datenaissance;
        $personne->sexe=$sexe;
        $personne->nationalite=$nationnalite;
        $personne->matrimonial=$sit;
        $personne->enfant=$nb_enf;
        $personne->email=$email;
        $personne->contact=$contact;
        $personne->cnps=$cnps;
        $personne->rib=$rib;
        $personne->rh=$rh;
        $personne->fonction=$fonction;
        $personne->service=$service;
        $personne->entite=$entite;
        $personne->id_societe=$societe;
        $personne->pointure=$pointure;
        $personne->slug=Str::slug($nom.$prenom.$date->format('dmYhis'));

        $familles = new Collection();



        for($i = 0; $i <= count($request->input("nom_famille"))-1; $i++ )
        {
            $famille = new Famille();

            if( !empty($request->input("nom_famille")[$i]) || !empty($request->input("num_p")[$i])  ){

                $famille->nom_prenom = $request->input("nom_famille")[$i];
                $famille->lien_parente = $request->input("lien")[$i];
                $famille->type_p = $request->input("type_p")[$i];
                $famille->num_p= $request->input("num_p")[$i];
                $famille->date_exp= $request->input("date_exp")[$i];
                $familles->add($famille);
            }

        }

        $raw = $request->except("_token", "nom_famille", "lien", "type_p","num_p");
        $raw["famille"] = json_encode($familles->toArray());
        $personne->familles=$raw["famille"];
        if($request->file('photo')){
            $personne->image=$personne->slug.'.'.$request->file('photo')->getClientOriginalExtension();

            $path = Storage::putFileAs(
                'images', $request->file('photo'), $personne->slug.'.'.$request->file('photo')->getClientOriginalExtension()
            );
        }else{
            $personne->image="";
        }

        $personne->save();

        return redirect()->route('Ajouter_personne')->with('success',"La personne a été ajoutée avec succès");

    }
    public function supprimer_personne($slug)
    {
        $personne= Personne::where('slug','=',$slug)->get()->first();
        if($personne->delete()){
            return redirect()->route('lister_personne')->with('success',"La suppression a reussi");
        }else{
            return redirect()->route('lister_personne')->with('error',"La suppression a échoué");
        }

    }
    public function detail_personne($slug)
    {
        $societes=Societe::all();
        $personne= Personne::where('slug','=',$slug)->get()->first();
        $familles= json_decode($personne->familles);
        $payss=Pays::all();
        return view('personne/detail_personne',compact('personne','societes','familles','payss'));
    }
    public function modifier_personne(Request $request){

        $parameters=$request->except(['_token']);
        $nom=$parameters['nom'];
        $slug=$parameters['slug'];
        $prenom=$parameters['prenom'];
        $datenaissance=$parameters['datenaissance'];
        $sexe=$parameters['sexe'];
        $nationnalite=$parameters['nationnalite'];
        $sit=$parameters['sit'];
        $nb_enf=$parameters['nb_enf'];
        $email=$parameters['email'];
        $contact=$parameters['contact'];
        $cnps=$parameters['cnps'];
        $rib=$parameters['rib'];
        $rh=$parameters['rh'];
        $fonction=$parameters['fonction'];
        $service=$parameters['service'];
        $entite=$parameters['entite'];
        $societe=$parameters['societe'];
        $pointure=$parameters['pointure'];

        $date= new \DateTime(null);


        $personne= Personne::where('slug','=',$slug)->get()->first();
        $personne->nom=$nom;
        $personne->prenom=$prenom;
        $personne->datenaissance=$datenaissance;
        $personne->sexe=$sexe;
        $personne->nationalite=$nationnalite;
        $personne->matrimonial=$sit;
        $personne->enfant=$nb_enf;
        $personne->email=$email;
        $personne->contact=$contact;
        $personne->cnps=$cnps;
        $personne->rib=$rib;
        $personne->rh=$rh;
        $personne->fonction=$fonction;
        $personne->service=$service;
        $personne->entite=$entite;
        $personne->id_societe=$societe;
        $personne->pointure=$pointure;
        $personne->slug=Str::slug($nom.$prenom.$date->format('dmYhis'));

        $familles = new Collection();



        for($i = 0; $i <= count($request->input("nom_famille"))-1; $i++ )
        {
            $famille = new Famille();

            if( !empty($request->input("nom_famille")[$i]) || !empty($request->input("num_p")[$i])  ){

                $famille->nom_prenom = $request->input("nom_famille")[$i];
                $famille->lien_parente = $request->input("lien")[$i];
                $famille->type_p = $request->input("type_p")[$i];
                $famille->num_p= $request->input("num_p")[$i];
                $famille->date_exp= $request->input("date_exp")[$i];
                $familles->add($famille);
            }

        }

        $raw = $request->except("_token", "nom", "lien", "type_p","num_p");
        $raw["famille"] = json_encode($familles->toArray());
        $personne->familles=$raw["famille"];

        if($request->file('photo')){
            $personne->image=$personne->slug.'.'.$request->file('photo')->getClientOriginalExtension();

            $path = Storage::putFileAs(
                'images', $request->file('photo'), $personne->slug.'.'.$request->file('photo')->getClientOriginalExtension()
            );
        }else{
        }

        $personne->save();

        return redirect()->route('lister_personne')->with('success',"La personne a été mise à jour avec succès");

    }

    public function save_document(Request $request){

        $parameters=$request->except(['_token']);
        $personne= Personne::where('slug','=',$parameters['slug'])->get()->first();
        $liste_administratif=Liste_Administratif::all();
//$lesdoc=Administratif::where('id_personne','=',$personne->id)->delete();

        foreach($liste_administratif as $list):

            $test_existe_doc=Administratif::find($list->id);
            if($test_existe_doc!=null){
                $doc=$test_existe_doc;
            }else{
                $doc=new Administratif();
            }


            if(isset($parameters['existance_'.$list->id]) || isset($parameters['pj_'.$list->id])){
                $doc->type_doc=$list->id;
                $doc->id_personne=$personne->id;
                if(isset($parameters['existance_'.$list->id]) && $parameters['existance_'.$list->id]==1){
                    $doc->existance=1;
                }else{
                    $doc->existance=null;
                }
                if(isset($parameters['pj_'.$list->id])){
                    $doc->existance=1;
                    $doc->pj=$personne->slug.'_'.mb_strimwidth($list->libelle,0, 24, "...").$request->file('pj_'.$list->id)->getClientOriginalExtension();

                    $path = Storage::putFileAs(
                        'document'.DIRECTORY_SEPARATOR .$personne->slug,$request->file('pj_'.$list->id), $personne->slug.'_'.mb_strimwidth($list->libelle,0, 24, "...").$request->file('pj_'.$list->id)->getClientOriginalExtension()
                    );
                }else{
                }
                $doc->save();
}
            endforeach;

        return redirect()->route('lister_personne')->with('success',"Les documents ont été ajouté");

    }
    public function download_doc($namefile){
        $slug=explode($namefile,'_');
        dd($slug);
        return Storage::download('document/'.$slug[0].'/'.$namefile);
    }
    public function test($test){
        dd($test);
    }


}
