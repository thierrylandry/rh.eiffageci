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
Route::get('/document_administratif/{slug}',[
    'as'=>'document_administratif',
    'uses'=>'PersonneController@document_administratif',

]);
Route::post('/import_fichier',[
    'as'=>'import_fichier',
    'uses'=>'PersonneController@import_fichier',

]);