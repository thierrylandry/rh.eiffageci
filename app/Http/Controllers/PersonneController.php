<?php

namespace App\Http\Controllers;

use App\Administratif;
use App\Commune;
use App\Contrat;
use App\Entite;
use App\Fonction;
use App\Liste_Administratif;
use App\Metier\Json\Famille;
use App\Metier\Json\Piece;
use App\Pays;
use App\Personne;
use App\Personne_presente;
use App\Services;
use App\Societe;
use App\Typecontrat;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
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
        $entites= Entite::all();
        $communes = Commune::all();
        return view('personne/ajouter_personne',compact('societes','payss','fonctions','entites','communes'));
    }
    public function gestion_rh()
    {
        $entites= Entite::all();
        return view('personne/gestion_rh',compact('entites'));
    }
    public function lister_personne()
    {
        $personnes= Personne::with("fonction","pays","societe")
            ->where('id_entite','=',Auth::user()->id_chantier_connecte)
            ->orderBy('id', 'desc')
            ->paginate(300);
        $entites= Entite::all();
            $variable="tout";
//dd($personnes->first()->fonction()->first()->libelle);
        return view('personne/lister_personne',compact('personnes','entites','variable'));
    }
    public function lister_personne_active()
    {
        $variable="active";
        $personnesactives = Personne_presente::where('id_entite','=',Auth::user()->id_chantier_connecte)->get();
        $tab = Array();
        foreach($personnesactives as $pers):
            $tab[]=$pers->id;
            endforeach;
        $personnes= Personne::with("fonction","pays","societe")
            ->where('id_entite','=',Auth::user()->id_chantier_connecte)
            ->whereIn('id',$tab)
            ->orderBy('id', 'desc')
            ->paginate(2000);
        $entites= Entite::all();
//dd($personnes->first()->fonction()->first()->libelle);
        return view('personne/lister_personne',compact('personnes','entites','variable'));
    }
    public function lister_personne_non_active()
    {
        $variable="non_active";
        $personnesactives = Personne_presente::all();
        $tab = Array();
        foreach($personnesactives as $pers):
            $tab[]=$pers->id;
            endforeach;
        $personnes= Personne::with("fonction","pays","societe")
            ->where('id_entite','=',Auth::user()->id_chantier_connecte)
            ->whereNotIn('id',$tab)
            ->orderBy('id', 'desc')
            ->paginate(300);
        $entites= Entite::all();
      //  dd($personnes);

//dd($personnes->first()->fonction()->first()->libelle);
        return view('personne/lister_personne',compact('personnes','entites','variable'));
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
        $entites= Entite::all();
        return view('personne/fiche_personnel',compact('personne','societes','familles','payss','fonctions','pieces','services','typecontrats','contrats','entites'));
    }
    public function document_administratif($slug)
    {
        $personne= Personne::where('slug','=',$slug)->get()->first();
        $doc_admins= Administratif::where('id_personne','=',$personne->id)->get();
        $list_administratif= Liste_Administratif::all();
        $entites= Entite::all();
        return view('personne/document_administratif',compact('personne','list_administratif','doc_admins','entites'));
    }
    public function document_administratif_new_user()
    {

        $personne= Personne::where('personne.id_entite','=',Auth::user()->id_chantier_connecte)->orderBy('id', 'desc')->get()->first();
        $doc_admins= Administratif::where('id_personne','=',$personne->id)->get();
        $list_administratif= Liste_Administratif::all();
        $entites= Entite::all();
        return view('personne/document_administratif_new_user',compact('personne','list_administratif','doc_admins','entites'));
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
        $unite=$parameters['unite'];
        $pointure=$parameters['pointure'];
        $taille=$parameters['taille'];
        $surete=$parameters['surete'];


        $email=$parameters['email'];
        $adresse=$parameters['adresse'];
        $contact=$parameters['contact'];
        $whatsapp=$parameters['whatsapp'];
        $sattelitaire=$parameters['sattelitaire'];
        $id_commune=$parameters['commune'];
        $lieu_naissance=$parameters['lieu_naissance'];
        $noms_pere=$parameters['noms_pere'];
        $noms_mere=$parameters['noms_mere'];

        if(isset($parameters['entretien_cs'])){
            $entretien_cs=$parameters['entretien_cs'];
        }else{
            $entretien_cs=0;
        }
        if(isset($parameters['entretien_rh'])){
            $entretien_rh=$parameters['entretien_rh'];
        }else{
            $entretien_rh=0;
        }

        if(isset($parameters['visite_medicale'])){
            $visite_medicale=$parameters['visite_medicale'];
        }else{
            $visite_medicale=0;
        }

        $date_visite=$parameters['date_visite'];

        $date= new \DateTime(null);


        $personne= new Personne();
        $personne->nom=$nom;
        $personne->prenom=$prenom;
        $personne->datenaissance=$datenaissance;
        $personne->sexe=$sexe;
        $personne->nationalite=$nationnalite;
        $personne->matrimonial=$sit;
        $personne->enfant=$nb_enf;

        if(isset($entretien_cs)){
            $personne->entretien_cs=$entretien_cs;
        }else{
            $personne->entretien_cs=0;
        }

        if(isset($entretien_rh)){
            $personne->entretien_rh=$entretien_rh;
        }else{
            $personne->entretien_rh=0;
        }


        if(isset($visite_medicale)){
            $personne->visite_medicale=$visite_medicale;
        }else{
            $personne->visite_medicale=0;
        }
        $personne->date_visite=$date_visite;

        $personne->cnps=$cnps;
        $personne->rib=$rib;
        $personne->rh=$rh;
        $personne->fonction=$fonction;
        $personne->id_entite=$entite;
        $personne->id_unite=$unite;
        $personne->pointure=$pointure;
        $personne->taille=$taille;
        $personne->surete=$surete;
        $personne->slug=Str::slug($nom.$prenom.$date->format('dmYhis'));

        $personne->email=$email;
        $personne->adresse=$adresse;
        $personne->contact=$contact;
        $personne->whatsapp=$whatsapp;
        $personne->sattelitaire=$sattelitaire;
        $personne->id_commune=$id_commune;
        $personne->lieu_naissance=$lieu_naissance;
        $personne->noms_pere=$noms_pere;
        $personne->noms_mere=$noms_mere;


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
                $famille->presence_effective= $request->input("presence_effective")[$i];
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
            return redirect()->route('lister_personne',$personne->id_entite)->with('success',"La suppression a reussi");
        }else{
            return redirect()->route('lister_personne',$personne->id_entite)->with('error',"La suppression a échoué");
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
        $entites= Entite::all();
        $communes =Commune::all();
        return view('personne/detail_personne',compact('personne','societes','familles','payss','fonctions','pieces','entites','communes'));
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
        $unite=$parameters['unite'];
        $pointure=$parameters['pointure'];
        $taille=$parameters['taille'];
        $surete=$parameters['surete'];

        $email=$parameters['email'];
        $adresse=$parameters['adresse'];
        $contact=$parameters['contact'];
        $whatsapp=$parameters['whatsapp'];
        $sattelitaire=$parameters['sattelitaire'];
        $presenceEff=$parameters['presenceEff'];

        $lieu_naissance=$parameters['lieu_naissance'];
        $noms_pere=$parameters['noms_pere'];
        $noms_mere=$parameters['noms_mere'];

        $id_commune=$parameters['commune'];

        if(isset($parameters['entretien_cs'])){
           $entretien_cs=$parameters['entretien_cs'];
        }else{
            $entretien_cs=0;
        }
        if(isset($parameters['entretien_rh'])){
           $entretien_rh=$parameters['entretien_rh'];
        }else{
            $entretien_rh=0;
        }

        if(isset($parameters['visite_medicale'])){
            $visite_medicale=$parameters['visite_medicale'];
        }else{
            $visite_medicale=0;
        }

        $date_visite=$parameters['date_visite'];

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
        $personne->id_entite=$entite;
        $personne->id_unite=$unite;
        $personne->pointure=$pointure;
        $personne->taille=$taille;
        $personne->surete=$surete;

        $personne->email=$email;
        $personne->adresse=$adresse;
        $personne->contact=$contact;
        $personne->whatsapp=$whatsapp;
        $personne->sattelitaire=$sattelitaire;
        $personne->presenceEff=$presenceEff;
        $personne->id_commune=$id_commune;
        $personne->lieu_naissance=$lieu_naissance;
        $personne->noms_pere=$noms_pere;
        $personne->noms_mere=$noms_mere;


        if(isset($entretien_cs)){
            $personne->entretien_cs=$entretien_cs;
        }else{
            $personne->entretien_cs=0;
        }

        if(isset($entretien_cs)){
            $personne->entretien_rh=$entretien_rh;
        }else{
            $personne->entretien_rh=0;
        }


        if(isset($visite_medicale)){
            $personne->visite_medicale=$visite_medicale;
        }else{
            $personne->visite_medicale=0;
        }
        $personne->date_visite=$date_visite;

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
                $famille->presence_effective= $request->input("presence_effective")[$i];
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

        return redirect()->route('lister_personne',$personne->id_entite)->with('success',"La personne a été mise à jour avec succès");

    }

    public function save_document(Request $request){

        $parameters=$request->except(['_token']);
        $personne= Personne::where('slug','=',$parameters['slug'])->get()->first();
        $liste_administratif=Liste_Administratif::all();
//$lesdoc=Administratif::where('id_personne','=',$personne->id)->delete();

        foreach($liste_administratif as $list):

            $doc=new Administratif();


            if(!empty($parameters['existance_'.$list->id]) || !empty($parameters['pj_'.$list->id])){
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

        return redirect()->route('lister_personne',$personne->id_entite)->with('success',"Les documents ont été ajouté");

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


            if(!empty($parameters['existance_'.$list->id]) || !empty($parameters['pj_'.$list->id])){
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
    public function download_doc_simple($slug,$namefile){
      //  $namefile=str_replace('_','.',$namefile);
        // dd($namefile);
     //   dd('document/'.$slug.'/'.$namefile);
        return Storage::download('document/contrat/'.$slug.'/'. Str::ascii($namefile,'fr'));
    }
    public function supprimer_doc_simple($slug,$namefile,$id){
        $contrat= Contrat::find($id);
        $contrat->scan="";
        $contrat->save();
        $personne =Personne::where('slug','=',$slug)->first();
        //dd($doc);
         Storage::delete('document/contrat/'.$slug.'/'. Str::ascii($namefile,'fr'));

        return redirect()->back()->with('success',"La pj a été supprimé");
    }
    public function supprimer_doc($slug,$namefile,$id){
        $namefile=str_replace('_','.',$namefile);
        $personne =Personne::where('slug','=',$slug)->first();
        $docs = Administratif::where([
            ['type_doc','=',$id],
            ['id_personne', '=', $personne->id],
            ])->get();
        //dd($doc);
        foreach($docs as $doc):
        $doc->delete();
        endforeach;
         Storage::delete('document/'.$slug.'/'. Str::ascii($namefile,'fr'));
     //   dd('document/'.$slug.'/'.$namefile);
     //   $contents = Storage::get('file.jpg');
        return redirect()->back()->with('success',"Le documents été supprimé");
    }
    public function test($test){
        dd($test);
    }


}
