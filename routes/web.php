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
    return redirect()->route('tableau_de_bord',1);
});

Auth::routes();
Route::get('erreur', [
    'as'=>'erreur',
    'uses'=>'erreurController@erreur'

]);


Route::get('/tableau_de_bord/{id}',[
    'as'=>'tableau_de_bord',
    'uses'=>'HomeController@tableau_de_bord',
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




Route::get('/Ajouter_personne/{entite}',[
    'as'=>'Ajouter_personne',
    'uses'=>'PersonneController@ajouter_personne',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/lister_personne/{entite}',[
    'as'=>'lister_personne',
    'uses'=>'PersonneController@lister_personne',
    'roles' => ['Personnes','Gestion_expatrie']
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
    'roles' => ['Personnes','Gestion_expatrie']
])->middleware('auth')->middleware('roles');
Route::post('/modifier_personne',[
    'as'=>'modifier_personne',
    'uses'=>'PersonneController@modifier_personne',
    'roles' => ['Personnes','Gestion_expatrie']
])->middleware('auth')->middleware('roles');
Route::get('/fiche_personnel/{slug}',[
    'as'=>'fiche_personnel',
    'uses'=>'PersonneController@fiche_personnel',
    'roles' => ['Personnes','Gestion_expatrie']
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

Route::get('/contrat_new_user2/{id}/{id_typeModification}',[
    'as'=>'contrat_new_user2',
    'uses'=>'ContratController@contrat_new_user2',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/creer_contrat/{id}',[
    'as'=>'creer_contrat',
    'uses'=>'ContratController@creer_contrat',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/contrat_embauche/{id}',[
    'as'=>'contrat_embauche',
    'uses'=>'ContratController@contrat_embauche',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::get('/listercat/{id_definition}',[
    'as'=>'listercat',
    'uses'=>'ContratController@listercat'
])->middleware('roles');

Route::get('/lerecrutement/{id_recrutement}',[
    'as'=>'lerecrutement',
    'uses'=>'ContratController@lerecrutement',
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
Route::post('/save_correction_contrat',[
    'as'=>'save_correction_contrat',
    'uses'=>'ContratController@save_correction_contrat',
    'roles' => ['RRH']
])->middleware('auth')->middleware('roles');
Route::post('/save_contrat_creer_contrat',[
    'as'=>'save_contrat_creer_contrat',
    'uses'=>'ContratController@save_contrat_creer_contrat',
    'roles' => ['Personnes']
])->middleware('auth')->middleware('roles');
Route::post('/save_contrat_recrutement',[
    'as'=>'save_contrat_recrutement',
    'uses'=>'ContratController@save_contrat_recrutement',
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
])->middleware('auth')->middleware('roles');
Route::get('/information_contrat/{id}',[
    'as'=>'information_contrat',
    'uses'=>'ContratController@information_contrat',
    'roles' => ['Personnes']
])->middleware('auth');
Route::get('/information_modification/{id}',[
    'as'=>'information_modification',
    'uses'=>'ModificationController@information_modification',
    'roles' => ['Personnes']
])->middleware('auth');
Route::post('/save_renouvellezment_avenant',[
    'as'=>'save_renouvellezment_avenant',
    'uses'=>'ContratController@save_renouvellezment_avenant',
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

Route::get('/contratcddpdf/{id}',[
    'as'=>'contratcddpdf',
    'uses'=>'ContratController@contratcddpdf',
    'roles' => ['Personnes']
])->middleware('auth');
Route::get('/contratpdf/{id}',[
    'as'=>'contratpdf',
    'uses'=>'ContratController@contratpdf',
    'roles' => ['Personnes']
])->middleware('auth');
Route::get('/contratcdipdf',[
    'as'=>'contratcdipdf',
    'uses'=>'ContratController@contratcdipdf',
    'roles' => ['Personnes']
])->middleware('auth');
Route::get('/renouvellement_contratpdf/{id}',[
    'as'=>'renouvellement_contratpdf',
    'uses'=>'ContratController@renouvellement_contratpdf',
    'roles' => ['Personnes']
])->middleware('auth');
Route::get('/avenant_type_contratpdf/{id}',[
    'as'=>'avenant_type_contratpdf',
    'uses'=>'ContratController@avenant_type_contratpdf',
    'roles' => ['Personnes']
])->middleware('auth');
Route::get('/avenant/{id}',[
    'as'=>'avenant',
    'uses'=>'ContratController@avenant',
    'roles' => ['Personnes']
])->middleware('auth');
Route::get('/avenant_renum_contratpdf/{id}',[
    'as'=>'avenant_renum_contratpdf',
    'uses'=>'ContratController@avenant_renum_contratpdf',
    'roles' => ['Personnes']
])->middleware('auth');

Route::get('/Ajouter_partenaire',[
    'as'=>'Ajouter_partenaire',
    'uses'=>'PersonneController@Ajouter_partenaire',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/lister_partenaire',[
    'as'=>'lister_partenaire',
    'uses'=>'PartenaireController@lister_partenaire',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/detail_partenaire/{id}',[
    'as'=>'detail_partenaire',
    'uses'=>'PartenaireController@detail_partenaire',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::post('/modifier_partenaire',[
    'as'=>'modifier_partenaire',
    'uses'=>'PartenaireController@modifier_partenaire',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::post('/enregistrer_partenaire',[
    'as'=>'enregistrer_partenaire',
    'uses'=>'PartenaireController@enregistrer_partenaire',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/supprimer_partenaire',[
    'as'=>'supprimer_partenaire',
    'uses'=>'PartenaireController@supprimer_partenaire',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');


Route::get('/Ajouter_entite',[
    'as'=>'Ajouter_entite',
    'uses'=>'EntiteController@Ajouter_partenaire',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/lister_entite',[
    'as'=>'lister_entite',
    'uses'=>'EntiteController@lister_entite',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/detail_entite/{id}',[
    'as'=>'detail_entite',
    'uses'=>'EntiteController@detail_entite',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::post('/modifier_entite',[
    'as'=>'modifier_entite',
    'uses'=>'EntiteController@modifier_entite',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::post('/enregistrer_entite',[
    'as'=>'enregistrer_entite',
    'uses'=>'EntiteController@enregistrer_entite',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/supprimer_entite',[
    'as'=>'supprimer_entite',
    'uses'=>'EntiteController@supprimer_entite',
    'roles' => ['Parametrage']
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
    'roles' => ['Ressource_humaine']
])->middleware('auth')->middleware('roles');
//fin contrat par service
Route::get('/fin_contrat_service/{id_service}',[
    'as'=>'fin_contrat_service',
    'uses'=>'EtatsController@fin_contrat_service',
    'roles' => ['Chef_de_service']
])->middleware('auth')->middleware('roles');
Route::get('/mailfin_contrat',[
    'as'=>'mailfin_contrat',
    'uses'=>'EtatsController@mailfin_contrat',
]);
Route::get('/mailfin_contrat_service',[
    'as'=>'mailfin_contrat_service',
    'uses'=>'EtatsController@mailfin_contrat_service',
]);
 //parametre création des utilisateurs
Route::get('/utilisateur',[
    'as'=>'utilisateur',
    'uses'=>'UserController@utilisateur',
    'roles' => ['Gestion_utilisateur']
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
    'roles' => ['Gestion_utilisateur']
])->middleware('auth')->middleware('roles');
Route::get('/supprimer_utilisateur',[
    'as'=>'supprimer_utilisateur',
    'uses'=>'UserController@supprimer_utilisateur',
    'roles' => ['Gestion_utilisateur']
])->middleware('auth')->middleware('roles');
Route::post('/save_user',[
    'as'=>'save_user',
    'uses'=>'UserController@save_user',
    'roles' => ['Parametrage']
])->middleware('auth')->middleware('roles');
Route::get('/modifier_utilisateur/{id}',[
    'as'=>'modifier_utilisateur',
    'uses'=>'UserController@modifier_utilisateur',
    'roles' => ['Gestion_utilisateur']
])->middleware('auth')->middleware('roles');
Route::get('/supprimer_utilisateur/{id}',[
    'as'=>'supprimer_utilisateur',
    'uses'=>'UserController@supprimer_utilisateur',
    'roles' => ['Gestion_utilisateur']
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

Route::get('/personne_contrat',[
    'as'=>'personne_contrat',
    'uses'=>'EtatsController@personne_contrat',

])->middleware('auth');

//recrutement
Route::group(['prefix' => 'recrutements', 'as' => 'recrutement.'], function () {

    Route::get('/demande',[
        'as'=>'demande',
        'uses'=>'RecrutementController@ajouter_recrutement',
        'roles'=>['Chef_de_service']
    ])->middleware('roles')->middleware('auth');

    Route::post('/enregistrer',[
        'as'=>'enregistrer',
        'uses'=>'RecrutementController@enregistrer_recrutement',
        'roles'=>['Chef_de_service']
    ])->middleware('roles')->middleware('auth');

    Route::get('/gestion',[
        'as'=>'gestion',
        'uses'=>'RecrutementController@lister_recrutement',
        'roles' => ['Ressource_humaine']
    ])->middleware('roles')->middleware('auth');

    Route::get('/validation',[
        'as'=>'validation',
        'uses'=>'RecrutementController@valider_recrutement',
        'roles' => ['Chef_de_projet']
    ])->middleware('roles')->middleware('auth');

    Route::get('/ActionValider/{slug}',[
        'as'=>'ActionValider',
        'uses'=>'RecrutementController@ActionValider',
        'roles' => ['Chef_de_projet']
    ])->middleware('roles')->middleware('auth');

    Route::post('/ActionRejeter',[
        'as'=>'ActionRejeter',
        'uses'=>'RecrutementController@ActionRejeter',
        'roles' => ['Chef_de_projet']
    ])->middleware('roles')->middleware('auth');

    Route::get('/modification/{slug}',[
        'as'=>'modification',
        'uses'=>'RecrutementController@modification',
        'roles' => ['Chef_de_service']
    ])->middleware('roles')->middleware('auth');

    Route::get('/consulter/{slug}',[
        'as'=>'consulter',
        'uses'=>'RecrutementController@afficher',
        'roles' => ['Gestion_recrutement']
    ])->middleware('auth');

    Route::get('/supprimer/{slug}',[
        'as'=>'supprimer',
        'uses'=>'RecrutementController@supprimer',
        'roles' => ['Chef_de_service']
    ])->middleware('roles')->middleware('auth');

    Route::post('/modifier',[
        'as'=>'modifier',
        'uses'=>'RecrutementController@modifier_recrutement',
        'roles' => ['Chef_de_service']
    ])->middleware('roles')->middleware('auth');

    Route::post('/ConditionRemuneration',[
        'as'=>'ConditionRemuneration',
        'uses'=>'RecrutementController@ConditionRemuneration',
        'roles' => ['Ressource_humaine']
    ])->middleware('roles')->middleware('auth');

    Route::get('/liste_salaire/{slug}',[
        'as'=>'liste_salaire',
        'uses'=>'RecrutementController@liste_salaire',
        'roles' => ['Ressource_humaine']
    ])->middleware('roles')->middleware('auth');
    Route::get('/liste_salaire_by_id/{id}',[
        'as'=>'liste_salaire_by_id',
        'uses'=>'RecrutementController@liste_salaire_by_id',
        'roles' => ['Ressource_humaine']
    ])->middleware('roles')->middleware('auth');

    Route::get('/monrecrutement/{slug}',[
        'as'=>'monrecrutement',
        'uses'=>'RecrutementController@monrecrutement',
    ])->middleware('auth');

    Route::get('/macategorie/{categorieLibelle}/{id_definition}/{regime}',[
        'as'=>'macategorie',
        'uses'=>'RecrutementController@macategorie',
    ])->middleware('auth');


});

//demande de modification de contrat
Route::group(['prefix' => 'modifications', 'as' => 'modification.'], function () {

    Route::get('/demande',[
        'as'=>'demande',
        'uses'=>'ModificationController@demande_modification',
        'roles'=>['Chef_de_service']
    ])->middleware('roles')->middleware('auth');

    Route::get('/validation',[
        'as'=>'validation',
        'uses'=>'ModificationController@valider_modification',
        'roles' => ['Chef_de_projet']
    ])->middleware('roles')->middleware('auth');

    Route::get('/gestion',[
        'as'=>'gestion',
        'uses'=>'ModificationController@lister_modification',
        'roles' => ['Ressource_humaine']

    ])->middleware('roles')->middleware('auth');
    Route::get('/lapersonne_contrat/{id}',[
        'as'=>'lapersonne_contrat',
        'uses'=>'ModificationController@lapersonne_contrat'

    ])->middleware('roles')->middleware('auth');


    Route::post('/enregistrer',[
        'as'=>'enregistrer',
        'uses'=>'ModificationController@enregistrer_modification',
        'roles'=>['Chef_de_service']
    ])->middleware('roles')->middleware('auth');
    Route::post('/modifier',[
        'as'=>'modifier',
        'uses'=>'ModificationController@modifier_modification',
        'roles'=>['Chef_de_service']
    ])->middleware('roles')->middleware('auth');

    Route::get('/ActionValider/{slug}',[
        'as'=>'ActionValider',
        'uses'=>'ModificationController@ActionValider',
        'roles' => ['Validation_recrutement']
    ])->middleware('auth');

    Route::post('/ActionRejeter',[
        'as'=>'ActionRejeter',
        'uses'=>'ModificationController@ActionRejeter',
        'roles' => ['Validation_recrutement']
    ])->middleware('auth');
    Route::get('/consulter/{id}',[
        'as'=>'consulter',
        'uses'=>'ModificationController@afficher',
    ])->middleware('roles')->middleware('auth');
    Route::get('/modification/{id}',[
        'as'=>'modification',
        'uses'=>'ModificationController@modification',
        'roles'=>['Chef_de_service']
    ])->middleware('roles')->middleware('auth');
    Route::get('/supprimer/{id}',[
        'as'=>'supprimer',
        'uses'=>'ModificationController@enregistrer_modification',
        'roles'=>['Chef_de_service']
    ])->middleware('roles')->middleware('auth');
});

//Absences
Route::post('/ActionRejeter',[
    'as'=>'ActionRejeter',
    'uses'=>'AbsenceController@ActionRejeter',
])->middleware('auth');
//Absences
Route::group(['prefix' => 'absences', 'as' => 'absence.','roles' =>'Ressource_humaine'], function () {
    Route::get('/demande', [
        'as' => 'demande',
        'uses' => 'AbsenceController@demande_absence',
    ])->middleware('auth');
    Route::get('/ActionValider/{id}',[
        'as'=>'ActionValider',
        'uses'=>'AbsenceController@ActionValider',
        'roles'=>['Chef_de_service']
        ])->middleware('auth');
    Route::get('/validation', [
        'as' => 'validation',
        'uses' => 'AbsenceController@validation_absence',
        'roles'=>['Chef_de_service']
    ])->middleware('roles')->middleware('auth');
    Route::get('/modification/{id}',[
        'as'=>'modification',
        'uses'=>'AbsenceController@modification',
    ])->middleware('roles')->middleware('auth');
    Route::get('/supprimer/{id}',[
        'as'=>'supprimer',
        'uses'=>'AbsenceController@supprimer',

    ])->middleware('roles')->middleware('auth');

    Route::get('/gestion', [
        'as' => 'gestion',
        'uses' => 'AbsenceController@gestion_absence',
        'roles'=>['Ressource_humaine']
    ])->middleware('auth');

    Route::post('/enregistrer',[
        'as'=>'enregistrer',
        'uses'=>'AbsenceController@enregistrer',
    ])->middleware('roles')->middleware('auth');
    Route::post('/modifier',[
        'as'=>'modifier',
        'uses'=>'AbsenceController@modifier',
    ])->middleware('roles')->middleware('auth');
    Route::post('/ajouter_type_permission',[
        'as'=>'ajouter_type_permission',
        'uses'=>'AbsenceController@ajouter_type_permission',
        'roles'=>['Ressource_humaine']
    ])->middleware('roles')->middleware('auth');
    Route::get('/type_permission/{id}', [
        'as' => 'type_permission',
        'uses' => 'AbsenceController@type_permission',
        'roles'=>['Ressource_humaine']
    ])->middleware('auth');
});
//conges
Route::group(['prefix' => 'conges', 'as' => 'conges.'], function () {
    Route::get('/demande', [
        'as' => 'demande',
        'uses' => 'CongerController@demande_conges',
    ])->middleware('auth');
    Route::get('/ActionValider/{id}',[
        'as'=>'ActionValider',
        'uses'=>'CongerController@ActionValider',
        'roles'=>['Chef_de_service']
        ])->middleware('auth');
    Route::get('/validation', [
        'as' => 'validation',
        'uses' => 'CongerController@validation_conges',
        'roles' => ['Chef_de_service'],
    ])->middleware('roles')->middleware('auth');
    Route::get('/modification/{id}',[
        'as'=>'modification',
        'uses'=>'CongerController@modification',
    ])->middleware('roles')->middleware('auth');
    Route::get('/information_conges_prec/{id}',[
        'as'=>'information_conges_prec',
        'uses'=>'CongerController@information_conges_prec',
    ])->middleware('roles')->middleware('auth');
    Route::get('/supprimer/{id}',[
        'as'=>'supprimer',
        'uses'=>'CongerController@supprimer',
    ])->middleware('roles')->middleware('auth');

    Route::get('/gestion', [
        'as' => 'gestion',
        'uses' => 'CongerController@gestion_Absconge',
        'roles'=>['Ressource_humaine'],
    ])->middleware('roles')->middleware('auth');

    Route::post('/enregistrer',[
        'as'=>'enregistrer',
        'uses'=>'CongerController@enregistrer',
    ])->middleware('roles')->middleware('auth');
    Route::post('/modifier',[
        'as'=>'modifier',
        'uses'=>'CongerController@modifier',
    ])->middleware('roles')->middleware('auth');
    Route::post('/ajouter_type_permission',[
        'as'=>'ajouter_type_permission',
        'uses'=>'CongerController@ajouter_type_permission',
        'roles'=>['Ressource_humaine']
    ])->middleware('roles')->middleware('auth');
    Route::get('/type_permission/{id}', [
        'as' => 'type_permission',
        'uses' => 'CongerController@type_permission',
        'roles'=>['Ressource_humaine']
    ])->middleware('roles')->middleware('auth');
    Route::get('/lapersonne_contrat_conges/{id}', [
        'as' => 'type_permission',
        'uses' => 'CongerController@type_permission',
    ])->middleware('auth');
    Route::get('/conges_mastorise/{id}', [
        'as' => 'conges_mastorise',
        'uses' => 'CongerController@conges_mastorise',
    ])->middleware('auth');
});

//billet d'avion

Route::group(['prefix' => 'billet_avion', 'as' => 'billet_avions.'], function () {
    Route::get('/demande', [
        'as' => 'demande',
        'uses' => 'Billet_avionController@demande_billet_avion',
    ])->middleware('auth');
    Route::get('/ActionValider/{id}',[
        'as'=>'ActionValider',
        'uses'=>'Billet_avionController@ActionValider',
        'roles'=>['Chef_de_service']
        ])->middleware('auth');
    Route::get('/validation', [
        'as' => 'validation',
        'uses' => 'Billet_avionController@validation_billet_avion',
        'roles' => ['Chef_de_service'],
    ])->middleware('roles')->middleware('auth');
    Route::get('/modification/{id}',[
        'as'=>'modification',
        'uses'=>'Billet_avionController@modification',
    ])->middleware('roles')->middleware('auth');
    Route::get('/information_conges_prec/{id}',[
        'as'=>'information_conges_prec',
        'uses'=>'Billet_avionController@information_billet_avion_prec',
    ])->middleware('roles')->middleware('auth');
    Route::get('/supprimer/{id}',[
        'as'=>'supprimer',
        'uses'=>'Billet_avionController@supprimer',
    ])->middleware('roles')->middleware('auth');

    Route::get('/gestion', [
        'as' => 'gestion',
        'uses' => 'Billet_avionController@gestion_billet_avion',
        'roles'=>['Ressource_humaine'],
    ])->middleware('roles')->middleware('auth');

    Route::post('/enregistrer',[
        'as'=>'enregistrer',
        'uses'=>'Billet_avionController@enregistrer',
    ])->middleware('roles')->middleware('auth');
    Route::post('/modifier',[
        'as'=>'modifier',
        'uses'=>'Billet_avionController@modifier',
    ])->middleware('roles')->middleware('auth');
});

//pole de demande
Route::get('/pole_de_demande', [
    'as' => 'pole_de_demande',
    'uses' => 'PoleDemandeController@pole_de_demande',
])->middleware('auth');
Route::get('/lapersonne/{id}',[
    'as'=>'lapersonne',
    'uses'=>'UserController@lapersonne'

])->middleware('roles')->middleware('auth');