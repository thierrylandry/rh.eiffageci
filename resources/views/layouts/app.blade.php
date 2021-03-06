<!DOCTYPE html>
<html lang="en" >

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ URL::asset('images/Eiffage_2400_02_black_RGB1.png') }}" type="image/png" sizes="66x66">
    <!-- Fontfaces CSS-->
    <link href="{{  URL::asset("css/font-face.css") }}" rel="stylesheet" media="all">
    <link href="{{  URL::asset("vendor/font-awesome-4.7/css/font-awesome.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/font-awesome-5/css/fontawesome-all.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/mdi-font/css/material-design-iconic-font.min.css") }}" rel="stylesheet" media="screen">

    <!-- Bootstrap CSS-->
    <link href="{{  URL::asset("vendor/bootstrap-4.1/bootstrap.min.css") }}" rel="stylesheet" media="screen">

    <!-- Vendor CSS-->
    <link href="{{  URL::asset("vendor/animsition/animsition.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/wow/animate.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/css-hamburgers/hamburgers.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/slick/slick.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/select2/select2.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("css/select2.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/perfect-scrollbar/perfect-scrollbar.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("css/buttons.dataTables.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("css/style.css") }}" rel="stylesheet" media="screen">

    <!-- Main CSS-->
    <link href="{{ asset("css/theme.css") }}" rel="stylesheet" media="screen">
    <link href="{{ asset("css/jquery.dataTables.min.css") }}" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/impression.css') }}" media="print">

</head>

<body class="animsition" >
<!-- modal small -->
<div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="smallmodalLabel">Préciser la date de retour</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('retourner_avantage')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="text-input" class=" form-control-label"></label>
                        <input type="hidden" id="id_avantages" name="id" />
                        <input class="form-control" name="retour" id="retour" type="date" value="{{date('Y-m-d')}}"required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal small -->
<div class="modal fade" id="polerecrutement" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <i class="fas fa-user-plus fa-2x"></i>
                <h5 class="modal-title" id="smallmodalLabel"> Recrutement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <a href="{{route('recrutement.demande')}}" class="card col-sm-4">
                    <div  style="color: green">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-plus fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Demande</h4>
                        </div>
                    </div>
                        </a>
                    <a href="{{route('recrutement.validation')}}" class="card col-sm-4">
                    <div    style="color: green">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-clipboard-check fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Validation</h4>
                        </div>

                    </div>
                        </a>
                    <a href="{{route('recrutement.gestion')}}" class="card col-sm-4">
                    <div    style="color: green">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-list-ol fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Gestion</h4>
                        </div>

                    </div>
                        </a>


                </div>
            </div>

        </div>
    </div>
</div>
<!-- modal small -->
<div class="modal fade" id="polemodification" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-user fa-2x"></i>
                <h5 class="modal-title" id="smallmodalLabel"> Renouvellement & avenant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <a href="{{route('modification.demande')}}" class="card col-sm-4">
                    <div style="color: deepskyblue">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-plus fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Demande</h4>
                        </div>
                    </div>
                        </a>
                    <a href="{{route('modification.validation')}}" class="card col-sm-4">
                    <div    style="color: deepskyblue">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-clipboard-check fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Validation</h4>
                        </div>

                    </div>
                        </a>
                    <a href="{{route('modification.gestion')}}" class="card col-sm-4">
                    <div    style="color: deepskyblue">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-list-ol fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Gestion</h4>
                        </div>

                    </div>
                        </a>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- modal small -->
<div class="modal fade" id="poleabsence" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-calendar fa-2x"></i>
                <h5 class="modal-title" id="smallmodalLabel"> Absence</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <a href="{{route('absence.demande')}}" class="card col-sm-4">
                    <div style="color: yellow">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-plus fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Demande</h4>
                        </div>
                    </div>
                        </a>
                    <a href="{{route('absence.validation')}}" class="card col-sm-4">
                    <div   style="color: yellow">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-clipboard-check fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Validation</h4>
                        </div>

                    </div>
                        </a>
                    <a href="{{route('absence.gestion')}}" class="card col-sm-4" >
                    <div   style="color: yellow">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-list-ol fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Gestion</h4>
                        </div>

                    </div>
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- modal small -->
<div class="modal fade" id="poleconges" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modapolecongesl-lg modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-calendar fa-2x"></i>
                <h5 class="modal-title" id="smallmodalLabel"> Absence</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <a href="{{route('conges.demande')}}" class="card col-sm-4">
                    <div style="color: orange">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-plus fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Demande</h4>
                        </div>
                    </div>
                        </a>
                    <a href="{{route('conges.validation')}}" class="card col-sm-4">
                    <div   style="color: orange">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-clipboard-check fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Validation</h4>
                        </div>

                    </div>
                        </a>
                    <a href="{{route('conges.gestion')}}" class="card col-sm-4" >
                    <div   style="color: orange">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-list-ol fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Gestion</h4>
                        </div>

                    </div>
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- modal small -->
<div class="modal fade" id="poleavion" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fab fa-avianex fa-2x"></i>
                <h5 class="modal-title" id="smallmodalLabel"> Billet d'avion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="card col-sm-4" style="color: red">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-plus fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Demande</h4>
                        </div>
                    </div>
                    <div class="card col-sm-4"   style="color: red">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-clipboard-check fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Validation</h4>
                        </div>

                    </div>
                    <div class="card col-sm-4"   style="color: red">
                        <div class="card-body" style="text-align: center;">
                            <i class="fas fa-list-ol fa-6x"></i>
                            </br></br>
                            <h4 class="card-title mb-3">Gestion</h4>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- modal small -->
<div class="modal fade" id="RVmodal1" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titre_contrat">Renouvellement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('save_renouvellezment_avenant')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <input type="hidden" id="id_personne" name="id_personne" placeholder="Nom" value="" class="form-control" required>
                    <input type="hidden" id="id_nature_contrat" name="id_nature_contrat" placeholder="Nom" value="" class="form-control" required>
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <label for="text-input" class=" form-control-label">Joindre une demande de modification</label>
                        </div>
                        <div class="col-sm-12">
                            <select class="form-control" name="id_modification" id="id_modification1" required>
                                <option value="">SELECTIONNER</option>
                                @if(isset($modifications))
                                    @foreach($modifications as $modification)
                                        <option  value="{{$modification->id}}">@if(isset($modification->id_typeModification) && $modification->id_typeModification==2)
                                                <span style="background-color:#57b846; color:white">Renouvellement</span>
                                            @elseif(isset($modification->id_typeModification) && $modification->id_typeModification==3)
                                                <span style="background-color:#00b5e9;  color:white">Avenant</span>
                                            @endif  @foreach(json_decode($modification->list_modif) as $modif)
                                                <span  class="btn btn-outline-primary" disabled>{{$modif}}
                                                </span>
                                            @endforeach</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 top-campaign ">
                            <div class="">
                                <div class="row form-group">
                                    <div class="col-sm-5">
                                        <label for="text-input" class=" form-control-label">Définition* :</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="id_definition" id="id_definition1" required>
                                            <option value="">SELECTIONNER</option>
                                            @if(isset($definitions))
                                                @foreach($definitions as $definition)
                                                    <option  value="{{$definition->id}}">{{$definition->libelle}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-5">
                                        <label for="text-input" class=" form-control-label">Catégorie :</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="id_categorie" id="id_categorie1" required>
                                            <option value="">SELECTIONNER</option>
                                            @if(isset($categories))
                                                @foreach($categories as $categorie)
                                                    <option  value="{{$categorie->id}}">{{$categorie->libelle}}</option>

                                                @endforeach;
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class=" row form-group">
                                    <div class="col-sm-5">
                                        <label for="text-input" class=" form-control-label">Régime hebdomadaire</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <select class="form-control regime" name="regime" id="raregime">
                                            <option value="40H">40H</option>
                                            <option value="44H">44H</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-5">
                                        <label for="text-input" class=" form-control-label">Matricule* :</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="text" id="matricule" name="matricule" placeholder="Matricule" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-5">
                                        <label for="text-input" class=" form-control-label">Service* :</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select class="form-control" name="service" id="raservice" required>
                                            <option value="">SELECTIONNER UN SERVICE</option>
                                            @if(isset($services))
                                                @foreach($services as $service)
                                                    <option value="{{$service->id}}">{{$service->libelle}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-5">
                                        <label for="text-input" class=" form-control-label">Couverture maladie:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select class="form-control" name="couverture_maladie" id="couverture_maladie">
                                            <option value="80">80</option>
                                            <option value="80R">80R</option>
                                            <option value="100">100</option>
                                            <option value="100M">100M</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-5">
                                        <label for="text-input" class=" form-control-label">Type de contrat* :</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select class="form-control" name="type_de_contrat" id="type_contrat" required>
                                            <option value="">SELECTIONNER</option>
                                            @if(isset($typecontrats))
                                                @foreach($typecontrats as $typecontrat)
                                                    <option value="{{$typecontrat->id}}">{{$typecontrat->libelle}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="col-sm-6 top-campaign ">
                            <div class="">
                                <div class="row form-group">
                                    <div class="col col-md-5">
                                        <label for="text-input" class=" form-control-label">Date de debut* :</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="dateDebutC" id="dateDebutC" class="form-control" required/>
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <div class="col col-md-5">
                                        <label for="text-input" class=" form-control-label">Date de fin :</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="dateFinC" id="dateFinC" class="form-control"/>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="card-footer pull-right">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="zmdi zmdi-edit"></i> Enregistrer
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm" id="rareset">
                            <i class="fa fa-ban"></i> Réinitialiser
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="RVmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titre_contrat">Renouvellement</h5>
                <button type="button" class="close" data-dismiss="modal" id="closebtn" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('save_renouvellement_multiple')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <input type="hidden" id="id_personnetype_contratrenouvellement" name="id_personnetype_contratrenouvellement" placeholder="" value="" class="form-control" required>
                    <div class="row">
                        <div class="col-sm-12"></div>
                        <div class="col-sm-6 top-campaign ">
                            <div class="">
                                <div class="row form-group">
                                    <div class="col-md-5">
                                        <label for="text-input" class=" form-control-label">Renouveller le type de contrat ?:</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select class="form-control" name="type_de_contrat" id="type_contratrenouvellement">
                                            <option value="">SELECTIONNER</option>
                                            @if(isset($typecontrats))
                                                @foreach($typecontrats as $typecontrat)
                                                    <option value="{{$typecontrat->id}}" >{{$typecontrat->libelle}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="col-sm-6 top-campaign ">
                            <div class="">
                                <div class="row form-group">
                                    <div class="col col-md-5">
                                        <label for="text-input" class=" form-control-label">Renouveller la date de fin de contrat?:</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="date" name="dateFinC" id="dateFinCrenouvellement" class="form-control"/>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="card-footer pull-right">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="zmdi zmdi-edit"></i> Enregistrer
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm" id="rareset">
                            <i class="fa fa-ban"></i> Réinitialiser
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="RVmodalcoisir" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titre_contrat">Liste des modifications de l'avenant</h5>
                <button type="button" class="close" data-dismiss="modal" id="closebtn" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('avenant_collectif')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <input type="hidden" id="id_personnetype_contratrenouvellement" name="id_personnetype_contratrenouvellement" placeholder="" value="" class="form-control" required>
                    <div class="row">
                        <div class="col-sm-12"></div>
                        <div class="col-sm-12 top-campaign ">
                            <div class="">
                                <div class="row form-group">
                                    <div class="col-md-5">
                                        <label for="text-input" class=" form-control-label">Choisir les axes du renouvellement général ?:</label>
                                    </div>
                                    <input type="hidden" id="mavariable" name="mavariable" value="" required/>
                                    <div class="col-md-7">
                                        <select class="form-control" name="liste_avenant[]" multiple id="liste_avenant">
                                            <option value="">SELECTIONNER</option>
                                            @if(isset($listmodificationavenants))
                                                @foreach($listmodificationavenants as $liste)
                                                    <option value="{{$liste->libelle}}" >{{$liste->libelle}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="checkbox" id="checkboxlisteavenant" >Selectionner Tout
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="card-footer pull-right">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="zmdi zmdi-edit"></i> Enregistrer
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm" id="rareset">
                            <i class="fa fa-ban"></i> Réinitialiser
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- modal small -->
<div class="modal fade" id="modalhistorique" tabindex="-1" role="dialog" aria-labelledby="modalhistoriqueLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalhistoriqueLabel">Historique</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <table id="table_historique">
                <thead>
                <tr>
                    <td>Matricule</td>
                    <td>Nom</td>
                    <td>Prenom</td>
                    <td>Date d'attribution</td>
                    <td>Date retour</td>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- modal small -->
<div class="modal fade" id="modalrefusdemande" tabindex="-1" role="dialog" aria-labelledby="modalrefusdmdLaale" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalhistoriqueLabel">Refus de la demande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{route("ActionRejeter")}}">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id_dmd" id="id_dmd" />
                        <input type="hidden" name="objet" id="objet" />
                        <div class="col-sm-12">
                            <label>Motif de refus</label>
                            <textarea class="form-control" name="motif">

                        </textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card-footer pull-right">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Réjeter la demande
                            </button>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

<!-- modal small -->
<div class="modal fade" id="modalrefusdmd" tabindex="-1" role="dialog" aria-labelledby="modalrefusdmdLaale" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalhistoriqueLabel">Refus de demande de recrutement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{route("recrutement.ActionRejeter")}}">
                    @csrf
                <div class="row">
                    <input type="hidden" name="slug" id="slugrecrutement" />
                    <div class="col-sm-12">
                        <label>Motif de refus</label>
                        <textarea class="form-control" name="motif">

                        </textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="card-footer pull-right">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Réjeter la demande
                        </button>
                    </div>
                </div>
                </form>
            </div>


        </div>
    </div>
</div>
<!-- modal small -->
<div class="modal fade" id="modalrefusdmd_modif" tabindex="-1" role="dialog" aria-labelledby="modalrefusdmdLaale" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalhistoriqueLabel">Refus de demande de modification</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{route("modification.ActionRejeter")}}">
                    @csrf
                <div class="row">
                    <input type="hidden" name="id" id="idmodification" />
                    <div class="col-sm-12">
                        <label>Motif de refus</label>
                        <textarea class="form-control" name="motif">

                        </textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="card-footer pull-right">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Réjeter la demande
                        </button>
                    </div>
                </div>
                </form>
            </div>


        </div>
    </div>
</div>
<!-- modal small -->
<div class="modal fade" id="modalconditionremuneration" tabindex="-1" role="dialog" aria-labelledby="modalconditionremunerationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalhistoriqueLabel">Condition de rémunération</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="row">
                        <div class="col-sm-12"   >
                            <div class="card" style="height: 100% !important" >
                                <div class="card-body card-block">
                                    <form method="post" action="{{route("recrutement.ConditionRemuneration")}}">
                                        @csrf
                                        <div class="row">
                                            <div class=" col-lg-4">
                                                <label for="text-input" class=" form-control-label">Définition</label>
                                                <select class="form-control id_definition" name="id_definition" id="id_definition" required>
                                                    @if(isset($definitions))
                                                        @foreach($definitions as $definition)
                                                            <option value="{{$definition->id}}">{{$definition->libelle}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class=" col-lg-4">
                                                <label for="text-input" class=" form-control-label">Catégorie professionnelle</label>
                                                <select class="form-control id_categorie" name="id_categorie" id="id_categorie">
                                                    @if(isset($categories))
                                                        @foreach($categories as $categorie)
                                                            <option value="{{$categorie->libelle}}">{{$categorie->libelle}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class=" col-lg-4">
                                                <label for="text-input" class=" form-control-label">Régime hebdomadaire</label>
                                                <select class="form-control regime" name="regime" id="crregime">
                                                    <option value="0">40H</option>
                                                    <option value="1">44H</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" id="slugConditionRemuneration" name="slugConditionRemuneration" value="" />
                                    <div id="rubriques" class="form-inline">
                                        <?php $i=0; ?>
                                        <div class=" form-control-label">
                                            <label for="rubrique[]">Rubrique</label>
                                            <div class="form-group col-sm-12">
                                                <select type="text" name="rubrique[]"  class="  type_c form-control input-field rubrique" readonly="true" style="width: 260px">
                                                    @if(isset($rubrique_salaires))
                                                    @foreach($rubrique_salaires as $rubrique_salaire)
                                                        <?php $i++?>
                                                        @if($i==1)
                                                        <option value="{{$rubrique_salaire->libelle}}" {{$i==1?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                        @endif @endforeach
                                                        @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-control-label">
                                            <label for="valeur[]">Valeur</label>
                                            <div class="form-group col-sm-12">
                                                <div class="form-line">
                                                    <input type="text" name="valeur[]" id="Salaire_de_base" class="valeur_c salaire_base form-control" placeholder="Valeur" readonly>
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
                                                            <option value="{{$rubrique_salaire->libelle}}" {{$i==2?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
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
                                                    <input type="text" name="valeur[]" id="Sursalaire" class="valeur_c form-control" placeholder="Valeur" >
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
                                                                @if($i==3)
                                                            <option value="{{$rubrique_salaire->libelle}}" {{$i==3?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
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
                                                    <input type="text" name="valeur[]" id="Prime_de_salissure" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
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
                                                                @if($i==4)
                                                            <option value="{{$rubrique_salaire->libelle}}" {{$i==4?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
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
                                                    <input type="text" name="valeur[]" id="Prime_de_tenue_de_travail" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
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
                                                                @if($i==5)
                                                            <option value="{{$rubrique_salaire->libelle}}" {{$i==5?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
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
                                                    <input type="text" name="valeur[]" id="Prime_de_transport" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
                                                </div>
                                            </div>
                                        </div>
                                            <hr width="100%" color="blue">
                                            </br>

                                    </div>
                                        <h5>Rubrique Additionnelle</h5>
                                        <div id="rubriques_petit" class="form-inline">

                                        </div>
                                    Ajouter une rubrique salariale
                                    <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addrubrique">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </button>
                                    <div id="rubriquetemplate" class="row clearfix" style="display: none">

                                        <div class=" form-control-label">
                                            <label for="rubrique[]">Rubrique</label>
                                            <div class="form-group col-sm-12">
                                                <select type="text" name="rubrique[]" class="type_c form-control input-field">
                                                    <?php $i=0?>
                                                    @if(isset($rubrique_salaires))
                                                        @foreach($rubrique_salaires as $rubrique_salaire)
                                                            <?php $i++;?>
                                                            @if($i>=6)
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
                                                </div>
                                            </div>
                                        </div>
                                        <hr width="100%" color="blue">
                                    </div>
                                    <div class="modal-footer">
                                        </br>
                                        <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            Enregistrer</button>
                                    </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        </div>
    </div>
</div>
<!-- modal small -->
<div class="modal fade" id="modaltype_permission" tabindex="-1" role="dialog" aria-labelledby="modaltype_permissionLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalhistoriqueLabel">Type de permission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <form method="post" action="{{route('absence.ajouter_type_permission')}}">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        @csrf

                        <input type="hidden" id="id_abs" name="id" value="" />
                        <div class="form-group">
                            <label for="text-input" class=" form-control-label">Type de permission</label>
                           <select class="form-control" name="id_permission" id="id_permission" required>
                               <option value="">Sélectionner un type de permission</option>
                               @if(isset($type_permissions))
                                   @foreach($type_permissions as $type_permission)
                                       <option value="{{$type_permission->id}}">{{$type_permission->libelle}}</option>
                                       @endforeach
                                   @endif
                           </select>
                        </div>


                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                    Enregistrer</button>
            </div>
                </form>

            </div>
    </div>
</div>

<!-- modal small -->
<div class="modal fade" id="modal_add_epi" tabindex="-1" role="dialog" aria-labelledby="modalhistoriqueLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalhistoriqueLabel">Fiche equipement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route(isset($avantage)?'modifier_avantage':'save_epi')}}" enctype="multipart/form-data" >
                <div class="modal-content">

                    <div class="row">
                        @csrf

                        <input type="hidden" id="id" name="id" value="{{isset($avantage)?$avantage->id:''}}" />
                        <div class="col-sm-3">
                            <div class="form-group"  >
                                <img src="{{Storage::url('app/images/defaut.png')}}" id="rendu_img1"style=";height: 200px;" class="fa fa-user"/>
                            </div>

                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="text-input" class=" form-control-label">Libelle</label>
                                <input name="libelleequipement" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="text-input" class=" form-control-label">Quantite</label>
                                <input name="qte_equipement" type="number" min="1" required class="form-control" />
                            </div>
                            <div>
                                <input type="file" class="form-control" id="photo" name="photo_equipement"/>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    </br>
                    <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <div class="page-wrapper">
    @include('layouts.nav')
        <img src="{{ asset("images/Eiffage_2400_01_colour_RGB.jpg") }}" class="logo_eiffage" style="display: none">
    <!-- PAGE CONTAINER-->
        <div class="page-container">
            @include('layouts.bar')
            <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid" id="page">
                            <div class="agile-grid"  style="background-color: #FFFFFF;@yield('pour_register') margin: 5px">

                                @if(Session::has('success'))
                                    <div class="alert alert-success">{{Session::get('success')}}</div>
                                @endif()
                                @if(Session::has('error'))
                                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                                @endif()
                                @yield('content')
                            </div>
            @yield('page')
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
                <!-- END PAGE CONTAINER-->
        </div>
    </div>

    <!-- Jquery JS-->
    <!-- Jquery JS-->
    <script src="{{  URL::asset("public/vendor/jquery-3.2.1.min.js") }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{  URL::asset("public/vendor/bootstrap-4.1/popper.min.js") }}"></script>
    <script src="{{  URL::asset("public/vendor/bootstrap-4.1/bootstrap.min.js") }}"></script>
    <!-- Vendor JS       -->
    <script src="{{  URL::asset("public/vendor/slick/slick.min.js") }}">
    </script>
    <script src="{{  URL::asset("public/vendor/wow/wow.min.js") }}"></script>
    <script src="{{  URL::asset("public/vendor/animsition/animsition.min.js") }}"></script>
    <script src="{{  URL::asset("public/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js") }}">
    </script>
    <script src="{{  URL::asset("public/vendor/counter-up/jquery.waypoints.min.js") }}"></script>
    <script src="{{  URL::asset("public/vendor/counter-up/jquery.counterup.min.js") }}">
    </script>
    <script src="{{  URL::asset("public/vendor/circle-progress/circle-progress.min.js") }}"></script>
    <script src="{{  URL::asset("public/vendor/perfect-scrollbar/perfect-scrollbar.js") }}"></script>
    <script src="{{  URL::asset("public/vendor/chartjs/Chart.bundle.min.js") }}"></script>
    <script src="{{  URL::asset("public/vendor/select2/select2.min.js") }}">
    </script>
    <script src="{{ asset("js/bootstrap.js") }}"></script>
    <script src="{{ asset("js/bootstrap-select.js") }}"></script>
    <script src="{{ asset("js/dataTables.min.js") }}"></script>
    <script src="{{ asset("js/dataTables.checkboxes.js") }}"></script>
    <script src="{{ asset("js/dataTables.buttons.min.js") }}"></script>
    <script src="{{ asset("js/buttons.flash.min.js") }}"></script>
    <script src="{{ asset("js/jszip.min.js") }}"></script>
    <script src="{{ asset("js/dataTable.pdfmaker.js") }}"></script>
    <script src="{{ asset("js/vfs_fonts.js") }}"></script>
    <script src="{{ asset("js/buttons.html5.min.js") }}"></script>
    <script src="{{ asset("js/buttons.print.min.js") }}"></script>

    <!-- Main JS-->
    <script src="{{ asset("js/main.js") }}"></script>



    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="{{  URL::asset("public/js/jquery.ui.widget.js") }}"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->


    <script src="{{  URL::asset("public/js/jquery.iframe-transport.js") }}"></script>
    <script src="{{  URL::asset("public/js/jquery.fileupload.js") }}"></script>
    <script src="{{  URL::asset("public/js/jquery.fileupload-process.js") }}"></script>
    <script src="{{  URL::asset("public/js/jquery.fileupload-image.js") }}"></script>
    <script src="{{  URL::asset("public/js/jquery.fileupload-audio.js") }}"></script>
    <script src="{{  URL::asset("public/js/jquery.fileupload-video.js") }}"></script>
    <script src="{{  URL::asset("public/js/jquery.fileupload-validate.js") }}"></script>
</body>

</html>
<!-- end document-->
