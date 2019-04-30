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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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