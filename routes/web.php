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
Route::get('erreur', [
    'as'=>'erreur',
    'uses'=>'erreurController@erreur'

]);


Route::get('/tableau_de_bord',[
    'as'=>'tableau_de_bord',
    'uses'=>'HomeController@globale',
])->middleware('auth')->middleware('roles');
Route::get('/dirci',[
    'as'=>'dirci',
    'uses'=>'HomeController@dirci',
])->middleware('auth')->middleware('roles');
Route::get('/phb',[
    'as'=>'phb',
    'uses'=>'HomeController@phb',
])->middleware('auth')->middleware('roles');

Route::get('/spie_fondation',[
    'as'=>'spie_fondation',
    'uses'=>'HomeController@spie_fondation',
])->middleware('auth')->middleware('roles');

Route::get('/global',[
    'as'=>'global',
    'uses'=>'HomeController@globale',
])->middleware('auth')->middleware('roles');

Route::get('/globalExport',[
    'as'=>'globalExport',
    'uses'=>'HomeController@globalExport',
])->middleware('auth')->middleware('roles');


Route::get('/Ajouter_personne',[
    'as'=>'Ajouter_personne',
    'uses'=>'PersonneController@ajouter_personne',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');

Route::get('/Ajouter_personne/{entite}',[
    'as'=>'Ajouter_personne',
    'uses'=>'PersonneController@ajouter_personne',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/lister_personne/{entite}',[
    'as'=>'lister_personne',
    'uses'=>'PersonneController@lister_personne',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::post('/enregistrer_personne',[
    'as'=>'enregistrer_personne',
    'uses'=>'PersonneController@enregistrer_personne',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/supprimer_personne/{slug}',[
    'as'=>'supprimer_personne',
    'uses'=>'PersonneController@supprimer_personne',
    'roles' => ['sdd','dfsd']
])->middleware('auth')->middleware('roles');
Route::get('/detail_personne/{slug}',[
    'as'=>'detail_personne',
    'uses'=>'PersonneController@detail_personne',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::post('/modifier_personne',[
    'as'=>'modifier_personne',
    'uses'=>'PersonneController@modifier_personne',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/fiche_personnel/{slug}',[
    'as'=>'fiche_personnel',
    'uses'=>'PersonneController@fiche_personnel',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/document_administratif/{slug}',[
    'as'=>'document_administratif',
    'uses'=>'PersonneController@document_administratif',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/document_administratif_new_user',[
    'as'=>'document_administratif_new_user',
    'uses'=>'PersonneController@document_administratif_new_user',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::post('/save_document',[
    'as'=>'save_document',
    'uses'=>'PersonneController@save_document',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::post('/save_document_new_user',[
    'as'=>'save_document_new_user',
    'uses'=>'PersonneController@save_document_new_user',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');

Route::get('/download_doc/{slug}/{pj}',[
    'as'=>'download_doc',
    'uses'=>'PersonneController@download_doc',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/supprimer_doc/{slug}/{pj}{id}',[
    'as'=>'supprimer_doc',
    'uses'=>'PersonneController@supprimer_doc',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/test/{slug}',[
    'as'=>'test',
    'uses'=>'PersonneController@test',
    'roles' => ['sdd','dfsd']
])->middleware('auth')->middleware('roles');
Route::get('/contrat_new_user',[
    'as'=>'contrat_new_user',
    'uses'=>'ContratController@contrat_new_user',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');

Route::get('/contrat_new_user2/{slug}',[
    'as'=>'contrat_new_user2',
    'uses'=>'ContratController@contrat_new_user2',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/listercat/{id_definition}',[
    'as'=>'listercat',
    'uses'=>'ContratController@listercat',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/recsalairecat/{id_contrat}',[
    'as'=>'recsalairecat',
    'uses'=>'SalaireController@recsalairecat',
    'roles' => ['Salaires']
])->middleware('auth')->middleware('roles');
Route::post('/save_contrat',[
    'as'=>'save_contrat',
    'uses'=>'ContratController@save_contrat',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::post('/update_contrat',[
    'as'=>'update_contrat',
    'uses'=>'ContratController@update_contrat',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/affiche_contrat/{id}',[
    'as'=>'affiche_contrat',
    'uses'=>'ContratController@affiche_contrat',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/lister_contrat/{slug}',[
    'as'=>'lister_contrat',
    'uses'=>'ContratController@lister_contrat',
    'roles' => ['Personnes']
])->middleware('auth');

Route::get('/rupture_contrat/{id}',[
    'as'=>'rupture_contrat',
    'uses'=>'ContratController@rupture_contrat',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::post('/rompre',[
    'as'=>'rompre',
    'uses'=>'ContratController@rompre',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');


Route::get('/Ajouter_partenaire',[
    'as'=>'Ajouter_partenaire',
    'uses'=>'PersonneController@Ajouter_partenaire',
    'roles' => ['Effectifs']
])->middleware('auth')->middleware('roles');
Route::get('/lister_partenaire',[
    'as'=>'lister_partenaire',
    'uses'=>'PartenaireController@lister_partenaire',
    'roles' => ['Effectifs']
])->middleware('auth')->middleware('roles');
Route::get('/detail_partenaire/{id}',[
    'as'=>'detail_partenaire',
    'uses'=>'PartenaireController@detail_partenaire',
    'roles' => ['Effectifs']
])->middleware('auth')->middleware('roles');
Route::post('/modifier_effectif',[
    'as'=>'modifier_effectif',
    'uses'=>'EffectifController@modifier_effectif',
    'roles' => ['Effectifs']
])->middleware('auth')->middleware('roles');
Route::get('/effectif',[
    'as'=>'effectif',
    'uses'=>'EffectifController@effectif',
    'roles' => ['Effectifs']
])->middleware('auth')->middleware('roles');
//pour le salaire

Route::get('/salaires',[
    'as'=>'salaires',
    'uses'=>'SalaireController@salaires',
    'roles' => ['Salaires']
])->middleware('auth')->middleware('roles');
Route::get('/liste_salaire/{slug}',[
    'as'=>'liste_salaire',
    'uses'=>'SalaireController@liste_salaire',
    'roles' => ['Salaires']
])->middleware('auth')->middleware('roles');
Route::get('/Ajouter_salaire/{slug}',[
    'as'=>'Ajouter_salaire',
    'uses'=>'SalaireController@Ajouter_salaire',
    'roles' => ['Salaires']
])->middleware('auth')->middleware('roles');
Route::post('/enregistrer_salaire',[
    'as'=>'enregistrer_salaire',
    'uses'=>'SalaireController@enregistrer_salaire',
    'roles' => ['Salaires']
])->middleware('auth')->middleware('roles');
//etat

Route::get('/repertoire',[
    'as'=>'repertoire',
    'uses'=>'EtatsController@repertoire',
    'roles' => ['Etats']
])->middleware('auth')->middleware('roles');

Route::get('/expatrie',[
    'as'=>'expatrie',
    'uses'=>'EtatsController@expatrie',
    'roles' => ['Etats']
])->middleware('auth')->middleware('roles');
Route::get('/expatriepdf',[
    'as'=>'expatriepdf',
    'uses'=>'EtatsController@expatriepdf',
    'roles' => ['Etats']
])->middleware('auth')->middleware('roles');
//invite

Route::get('/invite',[
    'as'=>'invite',
    'uses'=>'InviterController@invite',
    'roles' => ['Invites']
])->middleware('auth')->middleware('roles');
Route::get('/pmodifier_invite/{id}',[
    'as'=>'pmodifier_invite',
    'uses'=>'InviterController@pmodifier_invite',
    'roles' => ['Invites']
])->middleware('auth')->middleware('roles');
Route::get('/supprimer_invite/{id}',[
    'as'=>'supprimer_invite',
    'uses'=>'InviterController@supprimer_invite',
    'roles' => ['Invites']
])->middleware('auth')->middleware('roles');
Route::post('/save_invite',[
    'as'=>'save_invite',
    'uses'=>'InviterController@save_invite',
    'roles' => ['Invites']
])->middleware('auth')->middleware('roles');
Route::post('/modifier_invite',[
    'as'=>'modifier_invite',
    'uses'=>'InviterController@modifier_invite',
    'roles' => ['Invites']
])->middleware('auth')->middleware('roles');
Route::get('/passage_invite/{id}',[
    'as'=>'passage_invite',
    'uses'=>'InviterController@passage_invite',
    'roles' => ['Invites']
])->middleware('auth')->middleware('roles');
Route::post('/enregistrer_passage',[
    'as'=>'enregistrer_passage',
    'uses'=>'InviterController@enregistrer_passage',
    'roles' => ['Invites']
])->middleware('auth')->middleware('roles');
Route::get('/pmodifier_passage/{id}',[
    'as'=>'pmodifier_passage',
    'uses'=>'InviterController@pmodifier_passage',
    'roles' => ['Invites']
])->middleware('auth')->middleware('roles');
Route::post('/modifier_passage',[
    'as'=>'modifier_passage',
    'uses'=>'InviterController@modifier_passage',
    'roles' => ['Invites']
])->middleware('auth')->middleware('roles');
Route::get('/supprimer_passage/{id}',[
    'as'=>'supprimer_passage',
    'uses'=>'InviterController@supprimer_passage',
    'roles' => ['Invites']
])->middleware('auth')->middleware('roles');
//fin contrat
Route::get('/fin_contrat',[
    'as'=>'fin_contrat',
    'uses'=>'EtatsController@fin_contrat',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/mailfin_contrat',[
    'as'=>'mailfin_contrat',
    'uses'=>'EtatsController@mailfin_contrat',
]);
 //parametre création des utilisateurs
Route::get('/utilisateur',[
    'as'=>'utilisateur',
    'uses'=>'UserController@utilisateur',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/fonctions',[
    'as'=>'fonctions',
    'uses'=>'FonctionsController@fonctions',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::post('/save_fonction',[
    'as'=>'save_fonction',
    'uses'=>'FonctionsController@save_fonction',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/pmodifier_fonction/{id}',[
    'as'=>'pmodifier_fonction',
    'uses'=>'FonctionsController@pmodifier_fonction',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::post('/modifier_fonction',[
    'as'=>'modifier_fonction',
    'uses'=>'FonctionsController@modifier_fonction',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/supprimer_fonction/{id}',[
    'as'=>'supprimer_fonction',
    'uses'=>'FonctionsController@supprimer_fonction',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/voir_utilisateur',[
    'as'=>'voir_utilisateur',
    'uses'=>'UserController@voir_utilisateur',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/supprimer_utilisateur',[
    'as'=>'supprimer_utilisateur',
    'uses'=>'UserController@supprimer_utilisateur',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::post('/save_user',[
    'as'=>'save_user',
    'uses'=>'UserController@save_user',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/modifier_utilisateur/{id}',[
    'as'=>'modifier_utilisateur',
    'uses'=>'UserController@modifier_utilisateur',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/supprimer_utilisateur/{id}',[
    'as'=>'supprimer_utilisateur',
    'uses'=>'UserController@supprimer_utilisateur',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::post('/modifier_user',[
    'as'=>'modifier_user',
    'uses'=>'UserController@modifier_user',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');

Route::get('/conges',[
    'as'=>'conges',
    'uses'=>'CongerController@conges',
    'roles' => ['Conges']
])->middleware('auth')->middleware('roles');


Route::post('/conges_save',[
    'as'=>'conges_save',
    'uses'=>'CongerController@conges_save',
    'roles' => ['Conges']
])->middleware('auth')->middleware('roles');

Route::get('/avantages',[
    'as'=>'avantages',
    'uses'=>'AvantagesController@avantages',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/gestionmateriel',[
    'as'=>'gestionmateriel',
    'uses'=>'AvantagesController@gestionmateriel',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');

Route::post('/save_materiel',[
    'as'=>'save_materiel',
    'uses'=>'AvantagesController@save_materiel',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::post('/save_avantage',[
    'as'=>'save_avantage',
    'uses'=>'AvantagesController@save_avantage',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/updateMateriel/{id}',[
    'as'=>'updateMateriel',
    'uses'=>'AvantagesController@updateMateriel',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/updateAvantage/{id}',[
    'as'=>'updateAvantage',
    'uses'=>'AvantagesController@updateAvantage',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::post('/modifier_equipement/',[
    'as'=>'modifier_equipement',
    'uses'=>'AvantagesController@modifier_equipement',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::post('/modifier_avantage/',[
    'as'=>'modifier_avantage',
    'uses'=>'AvantagesController@modifier_avantage',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::post('/retourner_avantage/',[
    'as'=>'retourner_avantage',
    'uses'=>'AvantagesController@retourner_avantage',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/supprimer_equipement/{id}',[
    'as'=>'supprimer_equipement',
    'uses'=>'AvantagesController@supprimer_equipement',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');

Route::get('/supprimer_avantage/{id}',[
    'as'=>'supprimer_avantage',
    'uses'=>'AvantagesController@supprimer_avantage',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');

Route::get('/historique_passages/{id}',[
    'as'=>'historique_passages',
    'uses'=>'AvantagesController@historique_passages',
    'roles' => ['Parametrage']

])->middleware('auth');

//gestion des epi
Route::get('/gestion_epi',[
    'as'=>'gestion_epi',
    'uses'=>'EpiController@gestion_epi',
    'roles' => ['Parametrage']

])->middleware('auth');
//gestion des epi
Route::post('/save_epi',[
    'as'=>'save_epi',
    'uses'=>'EpiController@save_epi',
    'roles' => ['Parametrage']

])->middleware('auth');
Route::get('/informatique',[
    'as'=>'informatique',
    'uses'=>'EtatsController@informatique',

])->middleware('auth');