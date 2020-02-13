<?php

namespace App\Http\Controllers;

use App\Entite;
use App\Fin_contrat;
use App\Jobs\EnvoieFincontrat;
use App\Liste_telephonique;
use App\Personne;
use App\Personne_contrat;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;;
use Illuminate\Http\Request;
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
        $contrats= Fin_contrat::all();
        $entites= Entite::all();
        return view('etats/fin_contrat',compact('contrats','entites'));
    }
    public function personne_contrat(){
        $contrats= Personne_contrat::all();
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
dd($invites_presents);
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

        $contrats= Fin_contrat::all();
        $users = User::all();

        foreach($users as $user):

            if($user->hasRole('Personnes')){
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

        if(isset($contrats[0])){
            Mail::send('mail/mailfincontrat',compact('contrats'),function($message)use ($contact )
            {
                $message->from("noreply@eiffage.com" ,"ROBOT PRO-RH ")
                    ->subject("LISTE DES PERSONNES EN FIN DE CONTRAT");
                foreach($contact as $em):
                    $message ->to($em);
                endforeach;
                $message->bcc("cyriaque.kodia@eiffage.com");
                $message->bcc("thierry.koffi@eiffage.com");
            });
        }

        //return view('mail/mailfincontrat',compact('contrats'));
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
}
