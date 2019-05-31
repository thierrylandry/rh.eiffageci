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

]);

Route::get('/Ajouter_personne',[
    'as'=>'Ajouter_personne',
    'uses'=>'PersonneController@ajouter_personne',

]);

Route::get('/Ajouter_personne',[
    'as'=>'Ajouter_personne',
    'uses'=>'PersonneController@ajouter_personne',

]);
Route::get('/lister_personne',[
    'as'=>'lister_personne',
    'uses'=>'PersonneController@lister_personne',

]);
Route::post('/enregistrer_personne',[
    'as'=>'enregistrer_personne',
    'uses'=>'PersonneController@enregistrer_personne',

]);
Route::get('/supprimer_personne/{slug}',[
    'as'=>'supprimer_personne',
    'uses'=>'PersonneController@supprimer_personne',

]);
Route::get('/detail_personne/{slug}',[
    'as'=>'detail_personne',
    'uses'=>'PersonneController@detail_personne',

]);
Route::post('/modifier_personne',[
    'as'=>'modifier_personne',
    'uses'=>'PersonneController@modifier_personne',

]);
Route::get('/fiche_personnel/{slug}',[
    'as'=>'fiche_personnel',
    'uses'=>'PersonneController@fiche_personnel',

]);
Route::get('/document_administratif/{slug}',[
    'as'=>'document_administratif',
    'uses'=>'PersonneController@document_administratif',

]);
Route::get('/document_administratif_new_user',[
    'as'=>'document_administratif_new_user',
    'uses'=>'PersonneController@document_administratif_new_user',

]);
Route::post('/save_document',[
    'as'=>'save_document',
    'uses'=>'PersonneController@save_document',

]);
Route::post('/save_document_new_user',[
    'as'=>'save_document_new_user',
    'uses'=>'PersonneController@save_document_new_user',

]);

Route::get('/download_doc/{slug}/{pj}',[
    'as'=>'download_doc',
    'uses'=>'PersonneController@download_doc',

]);
Route::get('/test/{slug}',[
    'as'=>'test',
    'uses'=>'PersonneController@test',

]);
Route::get('/contrat_new_user',[
    'as'=>'contrat_new_user',
    'uses'=>'ContratController@contrat_new_user',

]);
Route::get('/contrat_new_user2/{slug}',[
    'as'=>'contrat_new_user2',
    'uses'=>'ContratController@contrat_new_user2',

]);
Route::post('/save_contrat',[
    'as'=>'save_contrat',
    'uses'=>'ContratController@save_contrat',

]);
Route::post('/update_contrat',[
    'as'=>'update_contrat',
    'uses'=>'ContratController@update_contrat',

]);
Route::get('/affiche_contrat/{id}',[
    'as'=>'affiche_contrat',
    'uses'=>'ContratController@affiche_contrat',

]);
Route::get('/lister_contrat/{slug}',[
    'as'=>'lister_contrat',
    'uses'=>'ContratController@lister_contrat',

]);Route::get('/rupture_contrat/{id}',[
    'as'=>'rupture_contrat',
    'uses'=>'ContratController@rupture_contrat',

]);


Route::get('/Ajouter_partenaire',[
    'as'=>'Ajouter_partenaire',
    'uses'=>'PersonneController@Ajouter_partenaire',

]);
Route::get('/lister_partenaire',[
    'as'=>'lister_partenaire',
    'uses'=>'PartenaireController@lister_partenaire',

]);
Route::get('/detail_partenaire/{id}',[
    'as'=>'detail_partenaire',
    'uses'=>'PartenaireController@detail_partenaire',

]);
Route::post('/modifier_effectif',[
    'as'=>'modifier_effectif',
    'uses'=>'EffectifController@modifier_effectif',

]);
Route::get('/effectif',[
    'as'=>'effectif',
    'uses'=>'EffectifController@effectif',

]);
//pour le salaire

Route::get('/salaires',[
    'as'=>'salaires',
    'uses'=>'SalaireController@salaires',

]);
Route::get('/liste_salaire/{slug}',[
    'as'=>'liste_salaire',
    'uses'=>'SalaireController@liste_salaire',

]);
Route::get('/Ajouter_salaire/{slug}',[
    'as'=>'Ajouter_salaire',
    'uses'=>'SalaireController@Ajouter_salaire',

]);
Route::post('/enregistrer_salaire',[
    'as'=>'enregistrer_salaire',
    'uses'=>'SalaireController@enregistrer_salaire',

]);
//etat

Route::get('/repertoire',[
    'as'=>'repertoire',
    'uses'=>'EtatsController@repertoire',

]);
//invite

Route::get('/invite',[
    'as'=>'invite',
    'uses'=>'InviterController@invite',

]);
//fin contrat
Route::get('/fin_contrat',[
    'as'=>'fin_contrat',
    'uses'=>'EtatsController@fin_contrat',

]);