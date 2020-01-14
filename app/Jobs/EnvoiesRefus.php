<?php

namespace App\Jobs;

use App\Fin_contrat;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EnvoiesRefus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $absence;
    private $motif;
    private $objet;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($absence,$motif,$objet)
    {
        //
        $this->absence=$absence;
        $this->motif=$motif;
        $this->objet=$objet;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $absence=$this->absence;
        $motif=$this->motif;
        Mail::send('mail/refus_demande',compact('motif','absence'),function($message)use ($absence,$motif )
        {
            $message->from("noreply@eiffage.com" ,"ROBOT PRO-RH ")
                ->subject("REFUS DE LA DEMANDE D'ABSENCE  N°".$absence->id);
            $message ->to($absence->user->email);
        });
    }
}
