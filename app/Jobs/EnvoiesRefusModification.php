<?php

namespace App\Jobs;

use App\Fin_contrat;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EnvoiesRefusModification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $modification;
    private $motif;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($modification,$motif)
    {
        //
        $this->modification=$modification;
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
        $modification=$this->modification;
        $motif=$this->motif;
        Mail::send('mail/refus_modification',compact('motif','modification'),function($message)use ($modification,$motif )
        {
            $message->from("noreply@eiffage.com" ,"ROBOT PRO-RH ")
                ->subject("REFUS DE LA DEMANDE DE MODIFICATION N°".$modification->id);
            $message ->to($modification->user->email);
        });
    }
}
