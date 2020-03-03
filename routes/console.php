<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');


Artisan::command('rhfincontrat', function () {
    echo (new \App\Http\Controllers\EtatsController())->mailfin_contrat();
    echo (new \App\Http\Controllers\EtatsController())->mailfin_contrat_service();
})->describe('Notifier les RH sur les contrats à terme');
