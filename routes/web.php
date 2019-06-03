<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('tableau_de_bord');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tableau_de_bord',[
    'as'=>'tableau_de_bord',
    'uses'=>'homeController@tableau_de_bord',

])->middleware('auth');

Route::get('/Ajouter_personne',[
    'as'=>'Ajouter_personne',
    'uses'=>'PersonneController@ajouter_personne',

])->middleware('auth');

Route::get('/Ajouter_personne',[
    'as'=>'Ajouter_personne',
    'uses'=>'PersonneController@ajouter_personne',

])->middleware('auth');
Route::get('/lister_personne',[
    'as'=>'lister_personne',
    'uses'=>'PersonneController@lister_personne',

])->middleware('auth');
Route::post('/enregistrer_personne',[
    'as'=>'enregistrer_personne',
    'uses'=>'PersonneController@enregistrer_personne',

])->middleware('auth');
Route::get('/supprimer_personne/{slug}',[
    'as'=>'supprimer_personne',
    'uses'=>'PersonneController@supprimer_personne',

])->middleware('auth');
Route::get('/detail_personne/{slug}',[
    'as'=>'detail_personne',
    'uses'=>'PersonneController@detail_personne',

])->middleware('auth');
Route::post('/modifier_personne',[
    'as'=>'modifier_personne',
    'uses'=>'PersonneController@modifier_personne',

])->middleware('auth');
Route::get('/fiche_personnel/{slug}',[
    'as'=>'fiche_personnel',
    'uses'=>'PersonneController@fiche_personnel',

])->middleware('auth');
Route::get('/document_administratif/{slug}',[
    'as'=>'document_administratif',
    'uses'=>'PersonneController@document_administratif',

])->middleware('auth');
Route::get('/document_administratif_new_user',[
    'as'=>'document_administratif_new_user',
    'uses'=>'PersonneController@document_administratif_new_user',

])->middleware('auth');
Route::post('/save_document',[
    'as'=>'save_document',
    'uses'=>'PersonneController@save_document',

])->middleware('auth');
Route::post('/save_document_new_user',[
    'as'=>'save_document_new_user',
    'uses'=>'PersonneController@save_document_new_user',

])->middleware('auth');

Route::get('/download_doc/{slug}/{pj}',[
    'as'=>'download_doc',
    'uses'=>'PersonneController@download_doc',

])->middleware('auth');
Route::get('/test/{slug}',[
    'as'=>'test',
    'uses'=>'PersonneController@test',

])->middleware('auth');
Route::get('/contrat_new_user',[
    'as'=>'contrat_new_user',
    'uses'=>'ContratController@contrat_new_user',

])->middleware('auth');
Route::get('/contrat_new_user2/{slug}',[
    'as'=>'contrat_new_user2',
    'uses'=>'ContratController@contrat_new_user2',

])->middleware('auth');
Route::post('/save_contrat',[
    'as'=>'save_contrat',
    'uses'=>'ContratController@save_contrat',

])->middleware('auth');
Route::post('/update_contrat',[
    'as'=>'update_contrat',
    'uses'=>'ContratController@update_contrat',

])->middleware('auth');
Route::get('/affiche_contrat/{id}',[
    'as'=>'affiche_contrat',
    'uses'=>'ContratController@affiche_contrat',

])->middleware('auth');
Route::get('/lister_contrat/{slug}',[
    'as'=>'lister_contrat',
    'uses'=>'ContratController@lister_contrat',

])->middleware('auth');Route::get('/rupture_contrat/{id}',[
    'as'=>'rupture_contrat',
    'uses'=>'ContratController@rupture_contrat',

])->middleware('auth');


Route::get('/Ajouter_partenaire',[
    'as'=>'Ajouter_partenaire',
    'uses'=>'PersonneController@Ajouter_partenaire',

])->middleware('auth');
Route::get('/lister_partenaire',[
    'as'=>'lister_partenaire',
    'uses'=>'PartenaireController@lister_partenaire',

])->middleware('auth');
Route::get('/detail_partenaire/{id}',[
    'as'=>'detail_partenaire',
    'uses'=>'PartenaireController@detail_partenaire',

])->middleware('auth');
Route::post('/modifier_effectif',[
    'as'=>'modifier_effectif',
    'uses'=>'EffectifController@modifier_effectif',

])->middleware('auth');
Route::get('/effectif',[
    'as'=>'effectif',
    'uses'=>'EffectifController@effectif',

])->middleware('auth');
//pour le salaire

Route::get('/salaires',[
    'as'=>'salaires',
    'uses'=>'SalaireController@salaires',

])->middleware('auth');
Route::get('/liste_salaire/{slug}',[
    'as'=>'liste_salaire',
    'uses'=>'SalaireController@liste_salaire',

])->middleware('auth');
Route::get('/Ajouter_salaire/{slug}',[
    'as'=>'Ajouter_salaire',
    'uses'=>'SalaireController@Ajouter_salaire',

])->middleware('auth');
Route::post('/enregistrer_salaire',[
    'as'=>'enregistrer_salaire',
    'uses'=>'SalaireController@enregistrer_salaire',

])->middleware('auth');
//etat

Route::get('/repertoire',[
    'as'=>'repertoire',
    'uses'=>'EtatsController@repertoire',

])->middleware('auth');
//invite

Route::get('/invite',[
    'as'=>'invite',
    'uses'=>'InviterController@invite',

])->middleware('auth');
Route::post('/save_invite',[
    'as'=>'save_invite',
    'uses'=>'InviterController@save_invite',

])->middleware('auth');
//fin contrat
Route::get('/fin_contrat',[
    'as'=>'fin_contrat',
    'uses'=>'EtatsController@fin_contrat',

])->middleware('auth');
 //parametre création des utilisateurs
Route::get('/utilisateur',[
    'as'=>'utilisateur',
    'uses'=>'UserController@utilisateur',

])->middleware('auth');