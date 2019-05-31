<?php

namespace App\Http\Controllers;

use App\Administratif;
use App\Contrat;
use App\Fonction;
use App\Liste_Administratif;
use App\Metier\Json\Famille;
use App\Metier\Json\Piece;
use App\Pays;
use App\Personne;
use App\Services;
use App\Societe;
use App\Typecontrat;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
        $fonctions =Fonction::orderBy('id', 'ASC')->get();
        return view('personne/ajouter_personne',compact('societes','payss','fonctions'));
    }
    public function lister_personne()
    {
        $personnes= DB::table('personne')
            ->leftjoin('fonctions','fonctions.id','=','personne.fonction')
            ->select('personne.id','personne.nom','personne.prenom','sexe','entite','id_societe','personne.slug','fonctions.libelle','nationalite')
            ->orderBy('id', 'desc')->get();
        $societes=Societe::all();
        $payss=Pays::all();
        return view('personne/lister_personne',compact('personnes','societes','payss'));
    }
    public function fiche_personnel($slug)
    {
        $societes=Societe::all();
        $personne= Personne::where('slug','=',$slug)->get()->first();
        $familles= json_decode($personne->familles);
        $pieces= json_decode($personne->pieces);
        $payss=Pays::all();
        $fonctions =Fonction::orderBy('id', 'ASC')->get();
        $services = Services::all();
        $typecontrats= Typecontrat::all();
        $contrats = Contrat::where('id_personne','=',$personne->id)->get();
        return view('personne/fiche_personnel',compact('personne','societes','familles','payss','fonctions','pieces','services','typecontrats','contrats'));
    }
    public function document_administratif($slug)
    {
        $personne= Personne::where('slug','=',$slug)->get()->first();
        $doc_admins= Administratif::where('id_personne','=',$personne->id)->get();
        $list_administratif= Liste_Administratif::all();
        return view('personne/document_administratif',compact('personne','list_administratif','doc_admins'));
    }
    public function document_administratif_new_user()
    {

        $personne= Personne::orderBy('id', 'desc')->get()->first();
        $doc_admins= Administratif::where('id_personne','=',$personne->id)->get();
        $list_administratif= Liste_Administratif::all();

        return view('personne/document_administratif_new_user',compact('personne','list_administratif','doc_admins'));
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
       // $email=$parameters['email'];
        //$contact=$parameters['contact'];
        $cnps=$parameters['cnps'];
        $rib=$parameters['rib'];
        $rh=$parameters['rh'];
        $fonction=$parameters['fonction'];
        $entite=$parameters['entite'];
        $societe=$parameters['societe'];
        $pointure=$parameters['pointure'];
        $taille=$parameters['taille'];
        $surete=$parameters['surete'];

        $date= new \DateTime(null);


        $personne= new Personne();
        $personne->nom=$nom;
        $personne->prenom=$prenom;
        $personne->datenaissance=$datenaissance;
        $personne->sexe=$sexe;
        $personne->nationalite=$nationnalite;
        $personne->matrimonial=$sit;
        $personne->enfant=$nb_enf;

        $personne->cnps=$cnps;
        $personne->rib=$rib;
        $personne->rh=$rh;
        $personne->fonction=$fonction;
        $personne->entite=$entite;
        $personne->id_societe=$societe;
        $personne->pointure=$pointure;
        $personne->taille=$taille;
        $personne->surete=$surete;
        $personne->slug=Str::slug($nom.$prenom.$date->format('dmYhis'));



//les pieces jointes _piece
        $pieces = new Collection();
        for($i = 0; $i <= count($request->input("num_p_piece"))-1; $i++ )
        {
            $piece = new Piece();

            if( !empty($request->input("date_exp_piece")[$i]) || !empty($request->input("num_p_piece")[$i])  ){
                $piece->type_p_piece = $request->input("type_p_piece")[$i];
                $piece->num_p_piece= $request->input("num_p_piece")[$i];
                $piece->date_exp_piece= $request->input("date_exp_piece")[$i];
                $pieces->add($piece);
            }

        }

        $raw = $request->except("_token", "type_p","num_p",'date_exp');
      //  dd($raw);
        $var["piece"] = json_encode($pieces->toArray());
        $personne->pieces=$var["piece"];

        //les familles

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

        return redirect()->route('document_administratif_new_user')->with('success',"La personne a été ajoutée avec succès");

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
        $pieces= json_decode($personne->pieces);
        $payss=Pays::all();
        $fonctions =Fonction::orderBy('id', 'ASC')->get();
        return view('personne/detail_personne',compact('personne','societes','familles','payss','fonctions','pieces'));
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
        $cnps=$parameters['cnps'];
        $rib=$parameters['rib'];
        $rh=$parameters['rh'];
        $fonction=$parameters['fonction'];
        $entite=$parameters['entite'];
        $societe=$parameters['societe'];
        $pointure=$parameters['pointure'];
        $taille=$parameters['taille'];
        $surete=$parameters['surete'];

        $date= new \DateTime(null);


        $personne= Personne::where('slug','=',$slug)->get()->first();
        $personne->nom=$nom;
        $personne->prenom=$prenom;
        $personne->datenaissance=$datenaissance;
        $personne->sexe=$sexe;
        $personne->nationalite=$nationnalite;
        $personne->matrimonial=$sit;
        $personne->enfant=$nb_enf;
        $personne->cnps=$cnps;
        $personne->rib=$rib;
        $personne->rh=$rh;
        $personne->fonction=$fonction;
        $personne->entite=$entite;
        $personne->id_societe=$societe;
        $personne->pointure=$pointure;
        $personne->taille=$taille;
        $personne->surete=$surete;

        $familles = new Collection();

//les pieces jointes _piece
        $pieces = new Collection();
        for($i = 0; $i <= count($request->input("num_p_piece"))-1; $i++ )
        {
            $piece = new Piece();

            if( !empty($request->input("date_exp_piece")[$i]) || !empty($request->input("num_p_piece")[$i])  ){
                $piece->type_p_piece = $request->input("type_p_piece")[$i];
                $piece->num_p_piece= $request->input("num_p_piece")[$i];
                $piece->date_exp_piece= $request->input("date_exp_piece")[$i];
                $pieces->add($piece);
            }

        }

        $raw = $request->except("_token", "type_p","num_p",'date_exp');
        //  dd($raw);
        $var["piece"] = json_encode($pieces->toArray());
        $personne->pieces=$var["piece"];
//les familles
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
                    $doc->pj=Str::ascii($list->libelle.'.'.$request->file('pj_'.$list->id)->getClientOriginalExtension());

                    $path = Storage::putFileAs(
                        'document'.DIRECTORY_SEPARATOR .$personne->slug,$request->file('pj_'.$list->id),Str::ascii( $list->libelle.'.'.$request->file('pj_'.$list->id)->getClientOriginalExtension())
                    );
                }else{
                }
                $doc->save();
}
            endforeach;

        return redirect()->route('lister_personne')->with('success',"Les documents ont été ajouté");

    }
    public function save_document_new_user(Request $request){

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
                    $doc->pj=Str::ascii($list->libelle.'.'.$request->file('pj_'.$list->id)->getClientOriginalExtension());

                    $path = Storage::putFileAs(
                        'document'.DIRECTORY_SEPARATOR .$personne->slug,$request->file('pj_'.$list->id), Str::ascii($list->libelle.'.'.$request->file('pj_'.$list->id)->getClientOriginalExtension())
                    );
                }else{
                }
                $doc->save();
            }
        endforeach;

        return redirect()->route('contrat_new_user')->with('success',"Les documents ont été ajouté");

    }

    public function download_doc($slug,$namefile){
        $namefile=str_replace('_','.',$namefile);
        // dd($namefile);
     //   dd('document/'.$slug.'/'.$namefile);
        return Storage::download('document/'.$slug.'/'. Str::ascii($namefile,'fr'));
    }
    public function test($test){
        dd($test);
    }


}