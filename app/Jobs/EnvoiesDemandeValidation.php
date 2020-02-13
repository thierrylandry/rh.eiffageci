<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EnvoiesDemandeValidation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $objet;
    private $lien;
    private $contacts;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($typedemande,$contacts)
    {
        switch ($typedemande){
            case 1: $this->objet="DEMANDE DE RECRUTEMENT";
                    $this->lien=asset('recrutements/validation');
                break;

            case 2: $this->objet="DEMANDE DE MODIFICATION";
                    $this->lien=asset('modifications/validation');
                break;

            case 3: $this->objet="DEMANDE D'ABSENCE";
                    $this->lien=asset('absences/validation');
                break;

            case 4: $this->objet="DEMANDE DE CONGES";
                    $this->lien=asset('conges/validation');
                break;

            case 5: $this->objet="DEMANDE DE BILLET D'AVION";
                    $this->lien=asset('billets/validation');
                break;


        }
        $this->contacts=$contacts;
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

        Mail::send('mail/demande_validation',compact('lien'),function($message)use ($objet,$contacts)
        {
            $message->from("noreply@eiffage.com" ,"ROBOT PRO-RH ")
                ->subject($objet);
            $message ->to($contacts)
                     ->bcc("cyriaque.kodia@eiffage.com")
                     ->bcc("thierry.koffi@eiffage.com");


        });
    }
}
