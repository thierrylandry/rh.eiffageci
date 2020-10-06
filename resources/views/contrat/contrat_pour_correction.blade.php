@extends('layouts.app')
@section('document_administratif')
    active
@endsection
@section('document_administratif_block')
    style="display: block;"
@endsection
@section('page')
    <style>
        .steps-form-2 {
            display: table ;
            width: 100%;
            position: relative; }
        .steps-form-2 .steps-row-2 {
            display: table-row; }
        .steps-form-2 .steps-row-2:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 2px;
            background-color: #7283a7; }
        .steps-form-2 .steps-row-2 .steps-step-2 {
            display: table-cell;
            text-align: center;
            position: relative; }
        .steps-form-2 .steps-row-2 .steps-step-2 p {
            margin-top: 0.5rem; }
        .steps-form-2 .steps-row-2 .steps-step-2 button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important; }
        .steps-form-2 .steps-row-2 .steps-step-2 .btn-circle-2 {
            width: 70px;
            height: 70px;
            border: 2px solid #59698D;
            background-color: white !important;
            color: #59698D !important;
            border-radius: 50%;
            padding: 22px 18px 15px 18px;
            margin-top: -22px; }
        .steps-form-2 .steps-row-2 .steps-step-2 .btn-circle-2:hover {
            border: 2px solid #4285F4;
            color: #4285F4 !important;
            background-color: white !important; }
        .steps-form-2 .steps-row-2 .steps-step-2 .btn-circle-2 .fa {
            font-size: 1.7rem; }
        .modifie{
            background-color: #5aa5f5;
        }


    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">CONTRAT - CORRECTION DU CONTRAT</h2>
            </div>
        </div>
    </div>
    </br>


    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h4 class="title-1">  {{" NOM : ". $personne->nom." ".$personne->prenom}}</h4>
            </div>
            <div class="table-data__tool  pull-right">
                <div class="table-data__tool-right">

                    <a href="{{route('lister_contrat',$personne->id)}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-long-arrow-return"></i>Retour</a>
                </div>&nbsp;
            </div>
        </div>

    </div>


    <div class="card-body">
        <a  href="{{route('fiche_personnel',$personne->slug)}}" class="btn btn-outline-primary">Consulter la fiche</a>
        <a  href="{{route('detail_personne',$personne->slug)}}" class="btn btn-outline-secondary">Modifier les informations</a>
        <a href="{{route('document_administratif',$personne->slug)}}" class="btn btn-outline-success"> gérer les dossiers</a>
        <a href="{{route('lister_contrat',$personne->id)}}" class="btn btn-outline-danger">Gérer les contrats</a>
    </div>
    <form action="{{route('save_correction_contrat')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <input type="hidden" id="text-input" name="slug" placeholder="Nom" value="{{isset($personne)? $personne->slug:''}}" class="form-control" required>
        <input type="hidden" id="text-input" name="id_contrat" placeholder="Nom" value="{{isset($contrat)? $contrat->id:''}}" class="form-control" required>


        <div class="row">
            <div class="col-sm-12">
                <div class="row form-group">

                    <div class="col-sm-9">
                        <input type="hidden" name="id_typeModification"  value="{{isset($id_typeModification)?$id_typeModification:''}}" required/>
                        <input type="hidden" name="id_recrutement_modification"  value="{{isset($modification_recrutement)?$modification_recrutement->id:''}}" required/>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-6 top-campaign ">

                <div class="">
                    <div class="col-sm-9">
                        <input type="hidden" name="id_nature_contrat" id="id_nature_contrat" value="1">
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Définition :</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control {{isset($listmodif) && in_array('La définition',$listmodif)?'modifie':''}} " name="id_definition" id="id_definition3" required>
                                <option value="">SELECTIONNER</option>
                                @foreach($definitions as $definition)
                                    <option {{isset($contrat) && $contrat->id_definition==$definition->id?'selected':''}}  value="{{$definition->id}}">{{$definition->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Catégorie :</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control {{isset($listmodif) && in_array('La catégorie',$listmodif)?'modifie':''}} id_categorie" name="id_categorie" id="id_categorie3">
                                <option value="">SELECTIONNER</option>
                                @if(isset($categories))
                                    @foreach($categories as $categorie)
                                        <option {{isset($contrat) && $contrat->id_categorie==$categorie->libelle?'selected':''}} value="{{$categorie->libelle}}">{{$categorie->libelle}}</option>

                                    @endforeach;
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class=" row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Régime </br>hebdomadaire</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control regime {{isset($listmodif) && in_array('La durée hebdomadaire de travail',$listmodif)?'modifie':''}}" name="regime" id="regime3">
                                <option  {{isset($contrat) && $contrat->regime=="40H"?'selected':''}} value="40H">40H</option>
                                <option {{isset($contrat) && $contrat->regime=="44H"?'selected':''}} value="44H">44H</option>
                            </select>
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Matricule :</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="matricule" name="matricule" placeholder="Matricule" class="form-control" value="{{isset($contrat)?$contrat->matricule:''}}" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Service :</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control {{isset($listmodif) && in_array('Le service',$listmodif)?'modifie':''}}" name="service" id="service" required>
                                <option value="">SELECTIONNER UN SERVICE</option>
                                @foreach($services as $service)
                                    <option {{isset($contrat) && $contrat->id_service==$service->id?'selected':''}} value="{{$service->id}}">{{$service->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Equipe : </label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control {{isset($listmodif) && in_array('Le sous service',$listmodif)?'modifie':''}}" name="id_sous_service" id="id_sous_service" >
                                <option value="">SELECTIONNER UNE EQUIPE</option>
                                @if(isset($sous_services))
                                @foreach($sous_services as $sous_service)
                                    <option {{isset($contrat) && $contrat->id_sous_service==$sous_service->id?'selected':''}} value="{{$sous_service->id}}">{{$sous_service->libelle}}</option>
                                @endforeach
                                    @endif
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="text-input" class=" form-control-label">Couverture maladie:</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="couverture_maladie" id="couverture_maladie">
                                <option value="">SELECTIONNER</option>
                                @foreach($assurance_maladies as $assurance_maladie)
                                    <option value="{{$assurance_maladie->libelle}}" {{isset($contrat) && $contrat->couvertureMaladie==$assurance_maladie->libelle?'selected':''}}>{{$assurance_maladie->libelle}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="text-input" class=" form-control-label">Type de contrat :</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control {{isset($listmodif) && in_array('Le type de contrat',$listmodif)?'modifie':''}}" name="type_de_contrat" id="type_de_contrat1" required>
                                <option value="">SELECTIONNER</option>
                                @foreach($typecontrats as $typecontrat)

                                    <option value="{{$typecontrat->id}}"  {{isset($contrat) && $contrat->id_type_contrat==$typecontrat->id?'selected':''}}>{{$typecontrat->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">E - mail *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="email" id="email" name="email" placeholder="E - mail" class="form-control" value="{{isset($contrat)?$contrat->email:''}}" >

                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Contact *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="contact" name="contact" placeholder="Contact" class="form-control" value="{{isset($contrat)?$contrat->contact:''}}">

                        </div>
                    </div>

                </div>


            </div>
            <div class="col-sm-6 top-campaign ">

                <div class="">
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Date de debut :</label>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="dateDebutC_memoire" class="form-control " value="{{isset($contrat)?$contrat->datedebutc:''}}" />
                            <input type="date" name="dateDebutC" id="dateDebutC" class="form-control" value="{{isset($contrat)?$contrat->datedebutc:''}}"/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Date de debut de la modification:</label>
                        </div>
                        <div class="form-group">
                            <input type="date" name="date_debutc_eff" id="date_debutc_eff" class="form-control" value="{{isset($modification_recrutement->date_debutc_eff)?$modification_recrutement->date_debutc_eff:''}}{{!isset($modification_recrutement->date_debutc_eff) && isset($contrat->date_debutc_eff)?$contrat->date_debutc_eff:''}}"  />
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Date de fin :</label>
                        </div>
                        <div class="form-group">
                            <input type="date" name="dateFinC" class="form-control {{isset($listmodif) && in_array('La date de fin',$listmodif)?'modifie':''}} dateFinC" value="{{isset($contrat)?$contrat->datefinc:''}}" @if(isset($contrat) && $contrat->id_type_contrat==2) readonly @endif/>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Date de fin de la période d'éssai :</label>
                        </div>
                        <div class="form-group">
                            <input type="date" name="periode_essaie" class="form-control" value="{{isset($contrat)?$contrat->periode_essaie:''}}"/>
                        </div>
                    </div>

                    @if(isset($contrat))
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Date de rupture d'essai :</label>
                            </div>
                            <div class="form-group">
                                <input type="date" name="ruptureEssai" value="{{isset($contrat)?$contrat->ruptureEssaie:''}}" class="form-control" />
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="text-input" class=" form-control-label">Date depart définitif :</label>
                            </div>
                            <div class="form-group">
                                <input type="date" name="departdefinitif" class="form-control" value="{{isset($contrat) && $contrat->departDefinitif!=''? $newDate = date("Y-m-d",strtotime($contrat->departDefinitif)):''}}" />
                            </div>
                        </div>
                    @endif
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Date d'induction:</label>
                        </div>
                        <div class="form-group">
                            <input type="date" name="dateInduction" value="{{isset($contrat)?$contrat->dateInduction:''}}" class="form-control"/>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Position:</label>
                        </div>
                        <div class="form-group">
                            <select name="position" class="form-control">
                                <option value="1" {{isset($contrat) && $contrat->position==1 ?'selected':''}}>Chantier</option>
                                <option value="2" {{isset($contrat) && $contrat->position==2 ?'selected':''}}>Bureau</option>
                                <option value="3" {{isset($contrat) && $contrat->position==3 ?'selected':''}}>Femme de ménage</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class=" col-lg-4">
                            <label for="text-input" class=" form-control-label">Logement</label>
                            <input type="hidden" id="dm_logement_initial" name="dm_logement_initial"  value="">
                            <select class="form-control dotation_nature" name="logement" id="logement2">
                                <option value="" {{isset($contrat) && $contrat->logement==""?'selected':''}}>NON</option>
                                <option value="Logement" {{isset($contrat) && $contrat->logement=="Logement"?'selected':''}}>OUI</option>

                            </select>
                        </div>
                        <div class=" col-lg-4">
                            <label for="text-input" class=" form-control-label">Vehicule</label>
                            <input type="hidden" id="vehicule_initial"  name="vehicule_initial" value="">
                            <select class="form-control dotation_nature" name="vehicule" id="vehicule1">
                                <option value="">Sélectionner une dotation en vehicule</option>
                                <option value="véhicule de service" {{isset($contrat) && $contrat->vehicule=="véhicule de service"?'selected':''}}>Véhicule de service</option>
                                <option value="Véhicule de fonction" {{isset($contrat) && $contrat->vehicule=="Véhicule de fonction"?'selected':''}}>Véhicule de fonction</option>
                            </select>
                        </div>
                       <!--
                        <div class=" col-lg-4">
                            <label for="text-input" class=" form-control-label">Gratification</label>
                            <input type="hidden" id="gratification_initial"  name="dm_budgetMensuel_initial" value="">
                            <select class="form-control dotation_nature" name="gratification" id="gratification1">
                                <option value="">Gratification de 75% du salaire brute</option>
                                <option value="Gratification de 100% salaire net" {{isset($contrat) && $contrat->gratification=="Gratification de 100% salaire net"?'selected':''}}>Gratification de 100% salaire net</option>
                            </select>
                        </div>
                        -->
                    </div>

                </div>


            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="card" style="height: 100% !important">
                    <div class="card-header">
                        <strong>Condition de rémunération</strong>
                    </div>
                    <div class="card-body" >
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-6">
                                <div id="rubriques" class="form-inline">
                                    <?php $i=0; ?>
                                    <div class=" form-control-label">
                                        <label for="rubrique[]">Rubrique</label>
                                        <div class="form-group col-sm-12">
                                            <select type="text" name="rubrique[]"  class="  type_c form-control input-field rubrique" readonly="true" style="width: 260px">
                                                @if(isset($rubrique_salaires))
                                                    @foreach($rubrique_salaires as $rubrique_salaire)
                                                        <?php $i++;?>

                                                        @if($i==1)
                                                            <?php $libelle=$rubrique_salaire->libelle;?>
                                                            <option value="{{$rubrique_salaire->libelle}}" {{$i==1?"selected":""}} >{{$rubrique_salaire->libelle}}</option>
                                                            @break
                                                        @endif @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-control-label">
                                        <label for="valeur[]">Valeur</label>
                                        <div class="form-group col-sm-12">
                                            <div class="form-line">
                                                <?php
                                                if(isset($contrat->valeurSalaire) && isset($libelle)){foreach(json_decode($contrat->valeurSalaire) as $valeurSalaire): if($valeurSalaire->libelle==$libelle) {$montant=$valeurSalaire->valeur; break;} endforeach; }
                                                ?>
                                                <input type="text" name="valeur[]" id="Salaire_de_base3" class="valeur_c Salaire_de_base salaire_base3 form-control" placeholder="Valeur" value="{{isset($montant)?$montant:''}}"
                                                       readonly><?php $montant=""; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr width="100%" color="blue">
                                    <div class=" form-control-label">
                                        <label for="rubrique[]">Rubrique</label>
                                        <div class="form-group col-sm-12">
                                            <select type="text" name="rubrique[]"  class="type_c form-control input-field" style="width: 260px">
                                                <?php $i=0; ?>
                                                @if(isset($rubrique_salaires))
                                                    @foreach($rubrique_salaires as $rubrique_salaire)
                                                        <?php $i++?>
                                                        @if($i==2)
                                                            <?php $libelle=$rubrique_salaire->libelle;?>
                                                            <option value="{{$rubrique_salaire->libelle}}" {{$i==2?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    if(isset($contrat->valeurSalaire) && isset($libelle)){foreach(json_decode($contrat->valeurSalaire) as $valeurSalaire): if($valeurSalaire->libelle==$libelle) {$montant=$valeurSalaire->valeur; } endforeach; }
                                    ?>
                                    <div class="form-control-label">
                                        <label for="valeur[]">Valeur {{isset($libelle)?$libelle:''}}</label>
                                        <div class="form-group col-sm-12">
                                            <div class="form-line">
                                                <input type="text" name="valeur[]" id="Sursalaire" class="valeur_c form-control Sursalaire" placeholder="Valeur" value="{{isset($montant)?$montant:''}}">
                                            </div><?php $montant=""; ?>
                                        </div>
                                    </div>
                                    <hr width="100%" color="blue">
                                    <div class=" form-control-label">
                                        <label for="rubrique[]">Rubrique</label>
                                        <div class="form-group col-sm-12">
                                            <select type="text" name="rubrique[]"  class="type_c form-control input-field" style="width: 260px">
                                                <?php $i=0; ?>
                                                @if(isset($rubrique_salaires))
                                                    @foreach($rubrique_salaires as $rubrique_salaire)
                                                        <?php $i++?>
                                                        @if($i==3)
                                                            <?php $libelle=$rubrique_salaire->libelle;?>
                                                            <option value="{{$rubrique_salaire->libelle}}" {{$i==3?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    if(isset($contrat->valeurSalaire) && isset($libelle)){foreach(json_decode($contrat->valeurSalaire) as $valeurSalaire): if($valeurSalaire->libelle==$libelle) {$montant=$valeurSalaire->valeur; } endforeach; }
                                    ?>

                                    <div class="form-control-label">
                                        <label for="valeur[]">Valeur</label>
                                        <div class="form-group col-sm-12">
                                            <div class="form-line">
                                                <input type="text" name="valeur[]" id="Prime_de_salissure" class="valeur_c form-control Prime_de_salissure" placeholder="Valeur" value="{{isset($montant)?$montant:''}}">
                                            </div><?php $montant=""; ?>
                                        </div>
                                    </div>
                                    <hr width="100%" color="blue">
                                    <div class=" form-control-label">
                                        <label for="rubrique[]">Rubrique</label>
                                        <div class="form-group col-sm-12">
                                            <select type="text" name="rubrique[]"  class="type_c form-control input-field" style="width: 260px">
                                                <?php $i=0; ?>
                                                @if(isset($rubrique_salaires))
                                                    @foreach($rubrique_salaires as $rubrique_salaire)
                                                        <?php $i++?>
                                                        @if($i==4)
                                                            <?php $libelle=$rubrique_salaire->libelle;?>
                                                            <option value="{{$rubrique_salaire->libelle}}" {{$i==4?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    if(isset($contrat->valeurSalaire) && isset($libelle)){foreach(json_decode($contrat->valeurSalaire) as $valeurSalaire): if($valeurSalaire->libelle==$libelle) {$montant=$valeurSalaire->valeur; } endforeach; }
                                    ?>

                                    <div class="form-control-label">
                                        <label for="valeur[]">Valeur</label>
                                        <div class="form-group col-sm-12">
                                            <div class="form-line">
                                                <input type="text" name="valeur[]" id="Prime_de_tenue_de_travail" class="valeur_c form-control Prime_de_tenue_de_travail" placeholder="Valeur" value="{{isset($montant)?$montant:''}}">
                                            </div><?php $montant=""; ?>
                                        </div>
                                    </div>
                                    <hr width="100%" color="blue">
                                    <div class=" form-control-label">
                                        <label for="rubrique[]">Rubrique</label>
                                        <div class="form-group col-sm-12">
                                            <select type="text" name="rubrique[]"  class="type_c form-control input-field" style="width: 260px">
                                                <?php $i=0; ?>
                                                @if(isset($rubrique_salaires))
                                                    @foreach($rubrique_salaires as $rubrique_salaire)
                                                        <?php $i++?>
                                                        @if($i==5)
                                                            <?php $libelle=$rubrique_salaire->libelle;?>
                                                            <option value="{{$rubrique_salaire->libelle}}" {{$i==5?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    if(isset($contrat->valeurSalaire) && isset($libelle)){foreach(json_decode($contrat->valeurSalaire) as $valeurSalaire): if($valeurSalaire->libelle==$libelle) {$montant=$valeurSalaire->valeur; } endforeach; }
                                    ?>
                                    <div class="form-control-label">
                                        <label for="valeur[]">Valeur</label>
                                        <div class="form-group col-sm-12">
                                            <div class="form-line">
                                                <input type="text" name="valeur[]" id="Prime_de_transport" class="valeur_c Prime_de_transport form-control" placeholder="Valeur" value="{{isset($montant)?$montant:''}}">
                                            </div><?php $montant=""; ?>
                                        </div>
                                    </div>
                                        <hr width="100%" color="blue">
                                    <div class=" form-control-label">
                                        <label for="rubrique[]">Rubrique</label>
                                        <div class="form-group col-sm-12">
                                            <select type="text" name="rubrique[]"  class="type_c form-control input-field" style="width: 260px">
                                                <?php $i=0; ?>
                                                @if(isset($rubrique_salaires))
                                                    @foreach($rubrique_salaires as $rubrique_salaire)
                                                        <?php $i++?>
                                                        @if($i==11)
                                                            <?php $libelle=$rubrique_salaire->libelle;?>
                                                            <option value="{{$rubrique_salaire->libelle}}" {{$i==5?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    if(isset($contrat->valeurSalaire) && isset($libelle)){foreach(json_decode($contrat->valeurSalaire) as $valeurSalaire): if($valeurSalaire->libelle==$libelle) {$montant=$valeurSalaire->valeur; } endforeach; }
                                    ?>
                                    <div class="form-control-label">
                                        <label for="valeur[]">Valeur</label>
                                        <div class="form-group col-sm-12">
                                            <div class="form-line">
                                                <input type="text" name="valeur[]" id="Prime_de_transport" class="valeur_c Prime_de_transport form-control" placeholder="Valeur" value="{{isset($montant)?$montant:''}}">
                                            </div><?php $montant=""; ?>
                                        </div>
                                    </div>
                                    <hr width="100%" color="blue">
                                    </br>

                                </div>
                                <h5>Rubrique Additionnelle</h5>
                                <div id="rubriques_petit" class="form-inline rubriques_petit" >
                                    @if(isset($resultat))
                                        <?php echo($resultat)?>
                                    @endif

                                </div>
                                Ajouter une rubrique salariale
                                <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float addrubrique" id="addrubrique">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </button>
                                <div id="rubriquetemplate" class="row clearfix rubriquetemplate" style="display: none">

                                    <div class=" form-control-label">
                                        <label for="rubrique[]">Rubrique</label>
                                        <div class="form-group col-sm-12">
                                            <select type="text" name="rubrique[]" class="type_c form-control input-field">
                                                <?php $i=0?>
                                                @if(isset($rubrique_salaires))
                                                    @foreach($rubrique_salaires as $rubrique_salaire)
                                                        <?php $i++;?>
                                                        @if($i>=6 && $i!=11)
                                                            <option value="{{$rubrique_salaire->libelle}}">{{$rubrique_salaire->libelle}}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-control-label">
                                        <label for="valeur[]">Valeur</label>
                                        <div class="form-group col-sm-12">
                                            <div class="form-line">
                                                <input type="text" name="valeur[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
                                            </div><?php $montant=""; ?>
                                        </div>
                                    </div>
                                    <hr width="100%" color="blue">
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
        </br>
        <div class="card-footer pull-right">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="zmdi zmdi-edit"></i> Modifier
            </button>
            <button type="reset" class="btn btn-danger btn-sm" id="reset">
                <i class="fa fa-ban"></i> Réinitialiser
            </button>
        </div>
    </form>
    <script src="{{ asset("js/jquery.min.js") }}"></script>
    <script>
        var typecontrat= $('#type_de_contrat1').val();
        // alert(typecontrat);
        if(typecontrat==1){
            $('.dateFinC').prop('required',true);
            $('.dateFinC').prop('readonly',false);
        }else{
            $('.dateFinC').prop('required',false);
            $('.dateFinC').prop('readonly',true);
        }

        function lister_les_categories(){
            var id_definition=  $("#id_definition3").val();
            var lien="{{URL::asset('')}}";
            $.get(lien+"/listercat/"+id_definition,function(data){
                console.log(data);
                var lesOptions;
                $.each(data, function( index, value ) {
                    lesOptions+="<option value='"+value.libelle+"'>"+value.libelle+"</option>" ;
                });
                $("#id_categorie3").empty();
                $("#id_categorie3").append(lesOptions);
                //  $("#id_categorie").trigger("chosen:updated");
                // pour trouver le salcategorielle
            });
        }
        function trouvezur_de_salaire_cat(){
            var categorieLibelle=  $("#id_categorie3").val();
            var id_definition=  $("#id_definition3").val();
            var regime=  $("#regime3").val();
            var lien="{{URL::asset('')}}";
            $.get(lien+"recrutements/macategorie/"+categorieLibelle+"/"+id_definition+"/"+regime,function(data){
                console.log(data);
                var lesOptions;
                if(data!=""){

                    $("#Salaire_de_base3").val(data.salCategoriel);

                }else{
                    $("#Salaire_de_base3").val("");
                }

                /*  $("#id_categorie").empty();
                 $("#id_categorie").append(lesOptions);*/
                //  $("#id_categorie").trigger("chosen:updated");

            });
        }
        trouvezur_de_salaire_cat();
        $("#id_definition3").change(function (e) {

            var id_definition=  $("#id_definition3").val();
            var lien="{{URL::asset('')}}";
            $.get(lien+"/listercat/"+id_definition,function(data){
                console.log(data);
                var lesOptions;
                $.each(data, function( index, value ) {
                    lesOptions+="<option value='"+value.libelle+"'>"+value.libelle+"</option>" ;
                });
                $("#id_categorie3").empty();
                $("#id_categorie3").append(lesOptions);
                //  $("#id_categorie").trigger("chosen:updated");
                // pour trouver le salcategorielle
                trouvezur_de_salaire_cat();
            });




        });
        $("#id_recrutement").change(function (e) {
            // alert("test");
            var id_recrutement=  $("#id_recrutement").val();
            $("#recrutementSelectionne").empty();
            $.get("../lerecrutement/"+id_recrutement,function(data){
                console.log(data);

                $("#recrutementSelectionne").text(data.posteAPouvoir+" "+data.NbrePersonne+""+data.NbrePersonneEffect+" "+data.assurance_maladie+" "+data.budgetMensuel);
                $("#id_definition3").val(data.id_definition);
                $("#id_categorie3").val(data.id_categorie);
                $("#regime3").val(data.regime);
                lister_les_categories();

                var id_definition=  $("#id_definition3").val();
                $.get("../listercat/"+id_definition,function(data){
                    console.log(data);
                    var lesOptions;
                    $.each(data, function( index, value ) {
                        lesOptions+="<option value='"+value.libelle+"'>"+value.libelle+"</option>" ;
                    });
                    $("#id_categorie3").empty();
                    $("#id_categorie3").append(lesOptions);
                    //  $("#id_categorie").trigger("chosen:updated");
                    // pour trouver le salcategorielle
                    trouvezur_de_salaire_cat();

                    //les condition de rémunérations
                    $(".rubriques_petit").empty();

                    $(".Salaire_de_base").val("");
                    $(".Sursalaire").val("");
                    $(".Prime_de_salissure").val("");
                    $(".Prime_de_tenue_de_travail").val("");
                    $(".Prime_de_transport").val("");

                    $.get("../recrutements/liste_salaire_by_id/"+id_recrutement,function(data){
                        console.log(data[0]);
                        if(typeof data[0][0]!='undefined') {
                            $(".Salaire_de_base").val(data[0][0].valeur);
                        }
                        if(typeof data[0][1]!='undefined') {
                            $(".Sursalaire").val(data[0][1].valeur);
                        }
                        if(typeof data[0][2]!='undefined') {
                            $(".Prime_de_salissure").val(data[0][2].valeur);
                        }
                        if(typeof data[0][3]!='undefined') {
                            $(".Prime_de_tenue_de_travail").val(data[0][3].valeur);
                        }
                        if(typeof data[0][4]!='undefined'){
                            $(".Prime_de_transport").val(data[0][4].valeur);
                        }


                        $(".rubriques_petit").append(data[1]);

                    });
                    //fin de la liste
                });



            });


        });

        $("#id_categorie3").change(function (e) {
            trouvezur_de_salaire_cat();
        })      ;
        $("#regime3").change(function (e) {
            // alert("test");
            trouvezur_de_salaire_cat();
            //  alert("ddd");
        })
        //rendre la date de fin de contrat obligatoire en fonction du type de contrat
        $('#type_de_contrat1').change(function (e){

            var typecontrat= $('#type_de_contrat1').val();
            // alert(typecontrat);
            if(typecontrat==1 || typecontrat==3){
                $('.dateFinC').prop('required',true);
                $('.dateFinC').prop('readonly',false);
            }else{
                $('.dateFinC').prop('required',false);
                $('.dateFinC').prop('readonly',true);
            }

        });

    </script>
    <script type="application/javascript">
        $(".addrubrique").click(function (e) {
            $($(".rubriquetemplate").html()).appendTo($(".rubriques_petit"));
        });

    </script>
@endsection
