<?php

namespace App\Http\Controllers;

use App\Fin_contrat;
use App\Jobs\EnvoieFincontrat;
use App\Liste_telephonique;
use App\Personne;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EtatsController extends Controller
{
    //
    public function repertoire(){
$repertoires= Liste_telephonique::all();

        return view('etats/repertoire',compact('repertoires'));
    }
    public function fin_contrat(){
        $contrats= Fin_contrat::all();

        return view('etats/fin_contrat',compact('contrats'));
    }

    public function expatrie(){
        $contrats= Fin_contrat::all();

      $expatries= DB::table('expatrie')->get();
       // dd($expatries);
      //  dd($personnes);

        $invites_presents= DB::table('invite')
            ->join('passage', 'invite.id','=','passage.id_invite')
            ->where('dateDepart','>=',DB::raw('CURDATE()'))->get();
      //  dd($expatries);
        return view('etats/expatrie',compact('expatries','invites_presents'));
    }


    public function mailfin_contrat(){


        $contrats= Fin_contrat::all();
        $users = User::all();

        foreach($users as $user):

            if($user->hasRole('Personnes')){
                if($user->email!="admin@eiffage.com" && $user->email!="nicolas.descamps@eiffage.com" && $user->email!="test@eiffage.com" )
                $contact[]=$user->email;
            }

            endforeach;
       // dd($contact);
        $contact[]="cyriaque.kodia@eiffage.com";
        $contact[]="thierry.koffi@eiffage.com";
      //  $this->dispatch(new EnvoieFincontrat($contact,$contrats) );
        Mail::send('mail/mailfincontrat',compact('contrats'),function($message)use ($contact )
        {
            $message->from("noreply@eiffage.com" ,"ROBOT PRO-RH ")
                ->subject("LISTE DES PERSONNES EN FIN DE CONTRAT");
            foreach($contact as $em):
                $message ->to($em);
            endforeach;
        });
        //return view('mail/mailfincontrat',compact('contrats'));
    }
}
