<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 17/12/2020
 * Time: 15:19
 */

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EnvoieRufusRenouvellement
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $listes;
    private $contacts;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($listes,$contacts)
    {
        //
        $this->listes=$listes;
        $this->contacts=$contacts;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $listes=$this->listes;
        $contacts=$this->contacts;
        Mail::send('mail/refus_renouvellement_contrat',compact('listes'),function($message)use ($listes,$contacts )
        {
            $message->from("noreply@eiffage.com" ,"ROBOT PRO-RH ")
                ->subject("REFUS DE RENOUVELLMENT DE CONTRAT");
            foreach($contacts as $em):
                $message ->to($em);
            endforeach;
            $message->bcc("cyriaque.kodia@eiffage.com");
            $message->bcc("thierry.koffi@eiffage.com");
        });
    }
}