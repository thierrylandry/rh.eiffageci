<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EnvoiesDemandeCollectif implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $objet;
    private $lien;
    private $contacts;
    private $typedemande;
    private $nb;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($typedemande,$contacts,$nb)
    {
        switch ($typedemande){
            case 1: $this->objet="VALIDATION DE RECRUTEMENT";
                $this->lien=asset('recrutements/gestion');
                break;

            case 2: $this->objet="VALIDATION DE MODIFICATION";
                $this->lien=asset('modifications/gestion');
                break;

            case 3: $this->objet="VALIDATION D'ABSENCE";
                $this->lien=asset('absences/gestion');
                break;

            case 4: $this->objet="VALIDATION DE CONGES";
                $this->lien=asset('conges/gestion');
                break;

            case 5: $this->objet="VALIDATION DE BILLET D'AVION";
                $this->lien=asset('billets/gestion');
                break;
//envoyez au chef de service pour qu'il sache qu'il y a des demandes collectives en cours
            case 6: $this->objet="DEMANDE D'AVENANT COLLECTIF";
                $this->lien=asset('modifications/validation');
                break;


        }
        $this->contacts=$contacts;
        $this->nb=$nb;
        $this->typedemande=$typedemande;
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
        $nb= $this->nb;

        /*  Mail::send('mail/demande_valider',compact('lien'),function($message)use ($objet,$contacts)
          {
              $message->from("noreply@eiffage.com" ,"ROBOT PRO-RH ")
                  ->subject($objet);
              $message ->to($contacts)
                      ->bcc("cyriaque.kodia@eiffage.com")
                       ->bcc("thierry.koffi@eiffage.com");

          });
        */
        if($this->typedemande!=6){
            if(isset($contacts[0])){
                Mail::send('mail/demande_valider',compact('lien'),function($message)use ($objet,$contacts )
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
        }else{
            if(isset($contacts[0])){
                Mail::send('mail/demande_avenant_groupe',compact('lien','nb'),function($message)use ($objet,$contacts )
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
}
