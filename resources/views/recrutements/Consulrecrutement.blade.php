@extends('layouts.app')
@section('recrutement.demande')
    active
@endsection
@section('recrutements')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">DEMANDE DE RECRUTEMENT N°{{$recrutement->id}}</h2>
            </div>
        </div>
    </div>
    </br>
    </br>
    <div class="table-data__tool">
        <div class="table-data__tool-left">
            <div class="table-data__tool  pull-right">
                @if(isset($recrutement))
                    <div class="table-data__tool-right">
                        <a href="{{redirect()->back()}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>RETOUR</a>
                    </div>
                @endif
            </div>
        </div>
        <!--place ici les bouton -->
    </div>

        <div class="col-lg-12">
            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>Information</strong>
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="col-sm-4">
                            <p> Poste à pouvoir : <b>{{isset($recrutement)? $recrutement->postApouvoir:''}}</b></p>
                            <p> Nombre de personne : <b>{{isset($recrutement)? $recrutement->nombre_personne:''}}</b></p>
                            <p> Date de naissance :  {{\Carbon\Carbon::parse(isset($personne)? $personne->datenaissance:'')->format('d-m-Y')}}</p>
                            <p> Entité : {{isset($recrutement)?  $recrutement->entite->libelle:''}}</p>
                            <p>Service : {{isset($recrutement)?  $recrutement->service->libelle:''}}</p>
                            <p> Description de la fonction : {{isset($recrutement) ? $recrutement->descriptifFonction:''}} </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="col-lg-12">
        <div class="card" style="height: 100% !important">
            <div class="card-header">
                <strong>Compétence recherchée</strong>
            </div>
            <div class="card-body" >
                <div class="row">
                    <div class="col-sm-4">
                        <ul>
                            @if(isset($competences))
                                @foreach($competences as $competence)
                                 @if(!empty($competence))
                                   <li>{{$competence}}</li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card" style="height: 100% !important">
            <div class="card-header">
                <strong>Responsabilité ou tâche</strong>
            </div>
            <div class="card-body" >
                <div class="row">
                    <div class="col-sm-4">
                        <ul>
                            @if(isset($taches))
                                @foreach($taches as $tache)
                                    @if(!empty($tache))
                                        <li>{{$tache}}</li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card" style="height: 100% !important">
            <div class="card-header">
                <strong>Contrat</strong>
            </div>
            <div class="card-body" >
                <div class="row">
                    <div class="col-sm-4">
                        <p> Type de contrat : <b>{{isset($recrutement)? $recrutement->type_contrat->libelle:''}}</b></p>
                        <p> Date de début : <b>{{isset($recrutement)? $recrutement->dateDebut:''}}</b></p>
                        <p> Durée de mission : {{isset($recrutement)? $recrutement->dureeMission:''}} </p>
                        <p> BUdget mensuel : {{isset($recrutement)?  $recrutement->budgetMensuel:''}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card" style="height: 100% !important">
            <div class="card-header">
                <strong>Avantage/Dotation (mensuel)</strong>
            </div>
            <div class="card-body" >
                <div class="row">
                    <div class="col-sm-4">
                        <p> Téléphone portable : <b>{{isset($recrutement)? $recrutement->type_contrat->libelle:''}}</b></p>
                        <p> Forfait : <b>{{isset($recrutement)? $recrutement->forfait:''}}</b></p>
                        <p> Débit internet : {{isset($recrutement)? $recrutement->forfait:''}} </p>
                        <p> Assurance : {{isset($recrutement)?  $recrutement->debit_internet:''}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset("vendor/jquery-3.2.1.min.js") }}"></script>
    <script type="application/javascript">
        $("#addfamille").click(function (e) {
            $($("#familletemplate").html()).appendTo($("#familles"));
        });
        $("#addpiece").click(function (e) {
            $($("#piecetemplate").html()).appendTo($("#pieces"));
        });
    </script>
@endsection