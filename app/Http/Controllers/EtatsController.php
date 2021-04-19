<?php

namespace App\Http\Controllers;

use App\Absconges;
use App\Entite;
use App\Fin_contrat;
use App\Fin_contrat_traite;
use App\Jobs\EnvoieFincontrat;
use App\Jobs\EnvoiesDemandeValidation;
use App\Liste_telephonique;
use App\Metier\Json\Famille;
use App\Metier\Json\Piece;
use App\Personne;
use App\Personne_contrat;
use App\Personne_presente;
use App\Services;
use App\Typecontrat;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;;

use FontLib\TrueType\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EtatsController extends Controller
{
    //
    public function repertoire(){
$repertoires= Liste_telephonique::all();
        $entites= Entite::all();
        return view('etats/repertoire',compact('repertoires','entites'));
    }
    public function fin_contrat(){

      /*
        $entites= Entite::all();
        $typecontrats= Typecontrat::all();
        return view('etats/fin_contrat',compact('contrats','entites','typecontrats'));
*/
        $contrats= Fin_contrat::where('id_entite','=',Auth::user()->id_chantier_connecte)->get();
        $fincontrat_traites = Fin_contrat_traite::where('datefinc','>=',Carbon::now()->format('Y-m-d'))
            ->where('datefinc','<', Carbon::parse( Carbon::now())->addDays(31)->format('Y-m-d'))
            ->get();
            dd($fincontrat_traites);
        //dd(Carbon::parse( Carbon::now())->addDays(31)->format('Y-m-d'));
        $list_traites= Array();
        foreach($fincontrat_traites as $fincontrat_traite):
            $list_traites[$fincontrat_traite->id_personne]=$fincontrat_traite->id_personne;
        endforeach;
        $entites= Entite::all();
        $typecontrats= Typecontrat::all();
        return view('etats/fin_contrat_all_service',compact('contrats','entites','typecontrats','fincontrat_traites','list_traites'));
    }
    public function fin_contrat_service($id_service){
        $service =Services::find($id_service);
        $contrats= DB::select('call fin_contrat_service('.$id_service.','.Auth::user()->id_chantier_connecte.')');
        $fincontrat_traites = Fin_contrat_traite::where('id_service','=',$id_service)
            ->where('datefinc','>=',Carbon::now()->format('Y-m-d'))
            ->where('datefinc','<', Carbon::parse( Carbon::now())->addDays(31)->format('Y-m-d'))
                                                ->get();
        //dd(Carbon::parse( Carbon::now())->addDays(31)->format('Y-m-d'));
        $list_traites= Array();
        foreach($fincontrat_traites as $fincontrat_traite):
            $list_traites[]=$fincontrat_traite->id_personne;
            endforeach;
        $entites= Entite::all();
        $typecontrats= Typecontrat::all();
        return view('etats/fin_contrat_service',compact('contrats','entites','service','typecontrats','fincontrat_traites','list_traites'));
    }
    public function personne_contrat(){
        $contrats= Personne_contrat::all();
        $entites= Entite::all();
        return view('etats/personnecontrat',compact('contrats','entites'));
    }
    public function personne_presente(){
        $contrats= Personne_presente::all();
        $entites= Entite::all();
        return view('etats/personnecontrat',compact('contrats','entites'));
    }

    public function expatrie(){
        $contrats= Fin_contrat::all();
        $entites= Entite::all();
      $expatries= DB::table('expatrie')
          ->where('presenceEff','=','present')->get();
       // dd($expatries);
      //  dd($personnes);

        $invites_presents= DB::table('invite')
            ->leftjoin('passage', 'invite.id','=','passage.id_invite')
            ->leftjoin('pays', 'invite.nationalite','=','pays.id')
            ->where('dateDepart','>=',DB::raw('CURDATE()'))
            ->orWhereNull('dateDepart')->get();
//dd($invites_presents);
        return view('etats/expatrie',compact('expatries','invites_presents','entites'));
    }
    public function expatriepdf(){
        $contrats= Fin_contrat::all();

      $expatries= DB::table('expatrie')->get();
       // dd($expatries);
      //  dd($personnes);

        $invites_presents= DB::table('invite')
            ->join('passage', 'invite.id','=','passage.id_invite')
            ->where('dateDepart','>=',DB::raw('CURDATE()'))->get();
      //  dd($expatries);
        //return view('BC.bon-commande', compact('bc','ligne_bcs','tothtax'));
        $pdf = PDF::loadView('etats.expatriepdf', compact('expatries','invites_presents'));

        /*debut du traçages*/
      return $pdf->download('Liste_des_expatrie°.pdf');
    }


    public function mailfin_contrat(){

        $entites =Entite::all();
        foreach($entites as $entite):
        $contrats= Fin_contrat::where('id_entite','=',$entite->id)->get();
            $users = User::all();

        foreach($users as $user):

            if($user->hasRole('Gestion_rh') && $user->id_entite==$entite->id){
                if($user->email!="admin@eiffage.com" && $user->email!="chamie.diomande@eiffage.com" && $user->email!="nicolas.descamps@eiffage.com" && $user->email!="test@eiffage.com" ){
                    $contact[]=$user->email;
                    }
            }

        endforeach;
        // dd($contact);
       // $contact[]="cyriaque.kodia@eiffage.com";
        //$contact[]="thierry.koffi@eiffage.com";
        //  $this->dispatch(new EnvoieFincontrat($contact,$contrats) );
      //  dd($contrats);
        $adresse="";
        if(isset($contrats[0])){
            Mail::send('mail/mailfincontrat',compact('contrats','adresse'),function($message)use ($contact,$entite )
            {
                $message->from("noreply@eiffage.com" ,"ROBOT PRO-RH ")
                    ->subject("LISTE DES PERSONNES EN FIN DE CONTRAT ".$entite->libelle);
                foreach($contact as $em):
                    $message ->to($em);
                endforeach;
                $message->bcc("cyriaque.kodia@eiffage.com");
                $message->bcc("thierry.koffi@eiffage.com");
            });
        }
        endforeach;

        //return view('mail/mailfincontrat',compact('contrats'));
    }
    public function mailfin_contrat_service(){
        $services=Services::all();

        $entites =Entite::all();
        foreach($entites as $entite):

        foreach($services as $service):
        $contrats= DB::select('call fin_contrat_service('.$service->id.','.$entite->id.')');
        $users = User::where('id_service','=',$service->id)->get();
            $contact = Array();
        foreach($users as $user):

            if($user->hasRole('Chef_de_service') && $user->id_entite==$entite->id){
                if($user->email!="admin@eiffage.com" && $user->email!="chamie.diomande@eiffage.com" && $user->email!="nicolas.descamps@eiffage.com" && $user->email!="test@eiffage.com" ){
                    $contact[]=$user->email;
                    }
            }

        endforeach;

            $adresse="http://172.20.73.3/rh.eiffageci/fin_contrat_service/".$service->id;

        if(isset($contrats[0])){
            Mail::send('mail/mailfincontrat',compact('contrats','adresse'),function($message)use ($contact,$service,$entite)
            {
                $message->from("noreply@eiffage.com" ,"ROBOT PRO-RH ")
                    ->subject("LISTE DES PERSONNES EN FIN DE CONTRAT DU SERVICE ".$service->libelle." ".$entite->libelle);
                foreach($contact as $em):
                    $message ->to($em);
                endforeach;
                $message->bcc("cyriaque.kodia@eiffage.com");
                $message->bcc("thierry.koffi@eiffage.com");
            });
        }

        endforeach;
        endforeach;
 //return $contact;
        return view('mail/mailfincontrat',compact('contrats'));
    }

    public function force_envoie_mail(){
        $users =User::all();
        $contact=Array();
        $contactdemandeur=Array();
       // $personne= Personne::find($id_personne);
        $conges= Absconges::where('etat','=',1)->get();
        $contact[]="sopie.ncho@eiffage.com";
        $contact[]="sylvain.decultieux@eiffage.com";
        foreach($conges as $conge):
        foreach($users as $user):

            if($conge->user->hasRole('Chef_de_service') && !$user->hasRole('Chef_de_projet')){
               // $contact[]=$user->email;
            }


        endforeach;
            endforeach;

        if(!empty($contact)){
            $this->dispatch(new EnvoiesDemandeValidation(4,$contact));
        }
        return "test";
    }
    public function informatique(){

        $lespersonnes= DB::table('personne')
                        ->join('avantages','avantages.id_personne','=','personne.id')
                        ->distinct('personne.id')
                        ->get();
      //  ->tosql();
//return $lespersonnes;
//return json_decode($lespersonnes);
        $entites= Entite::all();
        return view('etats/informatique',compact('lespersonnes','entites'));
    }
    public function liste_personne_piece(){
        $personne_presentes= Personne_presente::all();
        $tabpers = Array();

        foreach($personne_presentes as $personne_presente):
            $tabpers[]=$personne_presente->id;
        endforeach;
        //dd($tabpers);
        $personnes = Personne::whereIn('id',$tabpers)->get();

        $piece_personnes=new \Illuminate\Support\Collection();
        $piece_familles = new \Illuminate\Support\Collection();

        foreach($personnes as $personne):
            $tabs=json_decode($personne->pieces);
           // dd($tabs);
        if(is_array($tabs)){

            foreach($tabs as $tab):
                $piece= new Piece();
                $piece->nom_prenom=$personne->nom.' '.$personne->prenom;
                $piece->matricule=$personne->matricule;
                $piece->num_p_piece=$tab->num_p_piece;
                $piece->type_p_piece=$piece->__get($tab->type_p_piece);
                $piece->date_exp_piece=$tab->date_exp_piece;
                $piece_personnes[]=$piece;
            endforeach;
        }
            endforeach;

        foreach($personnes as $personne):
            $tabs=json_decode($personne->familles);
           // dd($tabs);
        if(is_array($tabs)){

            foreach($tabs as $tab):
                $famille= new Famille();

                $famille->nom_prenom=$personne->nom.' '.$personne->prenom;

                $famille->lien_parente=$tab->lien_parente;
                $famille->type_p=$tab->type_p;
                $famille->num_p=$tab->num_p;
                $famille->date_exp=$tab->date_exp;
                $famille->nom_prenom_parent=$tab->nom_prenom_parent;
                $piece_familles[]=$famille;
            endforeach;
        }
            endforeach;
          //  dd($personne1);
        $entites= Entite::all();
        return view('etats/liste_pieces',compact('piece_personnes','entites'));
    }
}
