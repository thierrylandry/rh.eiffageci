<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EnvoiesInformationDemandeur implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $objet;
    private $lien;
    private $contacts;
    private $demande;
    private $typedemande;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($typedemande,$contacts,$demande)
    {
        switch ($typedemande){
            case 1: $this->objet="VOTRE DEMANDE DE RECRUTEMENT A ETE VALIDE";
                    //$this->lien=asset('recrutements/validation');
                break;

            case 2: $this->objet="VOTRE DEMANDE DE MODIFICATION A ETE VALIDE";
                    // $this->lien=asset('modifications/validation');
                break;

            case 3: $this->objet="VOTRE DEMANDE D'ABSENCE A ETE VALIDE ";
                   // $this->lien=asset('absences/validation');
                break;

            case 4: $this->objet="DEMANDE DE CONGE VALIDEE";
                   // $this->lien=asset('conges/validation');
                break;

            case 5: $this->objet="DEMANDE DE BILLET D'AVION";
                    //$this->lien=asset('billets/validation');
                break;
            case 6: $this->objet="DEMANDE DE CONGE ANNULEE";
                    //$this->lien=asset('billets/validation');
                break;


        }
        $this->typedemande=$typedemande;
        $this->contacts=$contacts;
        $this->demande=$demande;
        //

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
         $objet=$this->objet;
         $lien=$this->lien;
         $contacts= $this->contacts;
        $demande= $this->demande;
        $typedemande= $this->typedemande;

       /*
        Mail::send('mail/demande_validation',compact('lien'),function($message)use ($objet,$contacts)
        {
            $message->from("noreply@eiffage.com" ,"ROBOT PRO-RH ")
                ->subject($objet);
            $message ->to($contacts)
                     ->bcc("cyriaque.kodia@eiffage.com")
                     ->bcc("thierry.koffi@eiffage.com");


        });
       */
       //dd($contacts[0]);
        if(isset($contacts[0])){
            Mail::send('mail/information_demandeur',compact('demande','typedemande'),function($message)use ($objet,$contacts )
            {
                $message->from("noreply@eiffage.com" ,"ROBOT PRO-RH ")
                    ->subject($objet);
                foreach($contacts as $em):
                    $message ->to($em);
                endforeach;
                $message->bcc("cyriaque.kodia@eiffage.com");
                $message->bcc("thierry.koffi@eiffage.com");
            });
        }
    }
}
