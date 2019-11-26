<?php

namespace App\Jobs;

use App\Fin_contrat;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EnvoiesRefusRecrutement implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $recrutement;
    private $motif;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recrutement,$motif)
    {
        //
        $this->recrutement=$recrutement;
        $this->motif=$motif;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $recrutement=$this->recrutement;
        $motif=$this->motif;
        Mail::send('mail/refus_recrutement',compact('motif','recrutement'),function($message)use ($recrutement,$motif )
        {
            $message->from("noreply@eiffage.com" ,"ROBOT PRO-RH ")
                ->subject("REFUS DE LA DEMANDE DE RECRUTEMENT N°".$recrutement->id);
            $message ->to($recrutement->user->email);
        });
    }
}
