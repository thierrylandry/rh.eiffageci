<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class EnvoieFincontrat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $contact=[];
    private $contrats=[];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contact,$contrats)
    {
        //
        $this->contact=$contact;
        $this->contrats=$contrats;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $contact=$this->contact;
        $contrats=$this->contrats;
        Mail::send('mail/mailfincontrat',compact('contrats'),function($message)use ($contact )
        {
            $message->from("noreply@eiffage.com" ,"ROBOT PRO-RH ")
                ->subject("LISTE DES PERSONNES EN FIN DE CONTRAT");
            foreach($contact as $em):
                $message ->to($em);
            endforeach;
        });
    }
}
