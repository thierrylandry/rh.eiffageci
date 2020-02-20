@extends('layouts.app')
@section('pole_demande')
    active
@endsection
@section('pole_demande_block')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <a href="{{route('recrutement.demande')}}" class="card col-sm-4">
            <div  style="color: green">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-plus fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Demande</h4>
                </div>
            </div>
        </a>
        <a href="{{route('recrutement.validation')}}" class="card col-sm-4">
            <div    style="color: green">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-clipboard-check fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Validation</h4>
                </div>

            </div>
        </a>
        <a href="{{route('recrutement.gestion')}}" class="card col-sm-4">
            <div    style="color: green">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-list-ol fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Gestion</h4>
                </div>

            </div>
        </a>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">DEMANDE DE RECRUTEMENT N°{{$recrutement->id}}</h2>
            </div>
        </div>
    </div>
    <div class="row">

    </div>
    <div class="table-data__tool">
        <div class="table-data__tool-left">
            <div class="table-data__tool  pull-right">
                @if(isset($recrutement))
                    <div class="table-data__tool-right">
                        <a href="{{back()->getTargetUrl()}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-long-arrow-return"></i>RETOUR</a>
                    </div>
                @endif
            </div>
        </div>
        <!--place ici les bouton -->
    </div>
<div class="row">

    <div class="col-lg-12">
        <div class="card" style="height: 100% !important">
            <div class="card-header">
                <strong>Information</strong>
            </div>
            <div class="card-body" >
                <div class="row">
                    <div class="col-sm-4">
                        <p> Poste à pouvoir : <b>{{isset($recrutement)? $recrutement->posteApouvoir:''}}</b></p>
                        <p> Nombre de personne : <b>{{isset($recrutement)? $recrutement->NbrePersonne:''}}</b></p>
                    </div>
                    <div class="col-sm-4">
                        <p> Date de debut :  {{\Carbon\Carbon::parse(isset($personne)? $personne->dateDebut:'')->format('d-m-Y')}}</p>
                        <p> Entité : {{isset($recrutement)?  $recrutement->entite->libelle:''}}</p>
                    </div>
                    <div class="col-sm-4">
                        <p>Service : {{isset($recrutement)?  $recrutement->service->libelle:''}}</p>
                        <p> Description de la fonction : {{isset($recrutement) ? $recrutement->descriptifFonction:''}} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    </br>
    <div class="row">
        <div class="col-lg-6">
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
                                        @if(!isset($competence))
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

        <div class="col-lg-6">
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
                                        @if(!isset($tache))
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

    </div>
    </br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>Contrat</strong>
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="col-sm-3">
                            <p> Date de début : <b>{{\Carbon\Carbon::parse(isset($personne)? $personne->dateDebut:'')->format('d-m-Y')}}</b></p>

                        </div>
                        <div class="col-sm-3">
                            <p> Type de contrat : <b>{{isset($recrutement)? $recrutement->type_contrat->libelle:''}}</b></p>

                        </div>
                        <div class="col-sm-3">
                            <p> Durée de mission : {{isset($recrutement)? $recrutement->dureeMission:''}} {{isset($recrutement) && isset($recrutement->unitejour->libelle)? $recrutement->unitejour->libelle:''}}</p>
                        </div>
                        <div class="col-sm-3">
                            <p> Budget mensuel : {{isset($recrutement)?  $recrutement->budgetMensuel:''}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </br>

<div class="row">
    <div class="col-lg-12">
        <div class="card" style="height: 100% !important">
            <div class="card-header">
                <strong>Avantage/Dotation (mensuel)</strong>
            </div>
            <div class="card-body" >
                <div class="row">
                    <div class="col-sm-3">
                        <p> Téléphone portable : <b>{{isset($recrutement) && $recrutement->telephone_portable==1?'OUI' :'NON'}}</b></p>


                    </div>
                    <div class="col-sm-3">
                        <p> Forfait : <b>{{isset($recrutement)? $recrutement->forfait:''}}</b></p>


                    </div>
                    <div class="col-sm-3">
                        <p> Débit internet : <b>{{isset($recrutement)? $recrutement->forfait:''}}</b> </p>


                    </div>
                    <div class="col-sm-3">
                        <p> Assurance : <b>{{isset($recrutement)?  $recrutement->debit_internet:''}}</b></p>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>Condition de rémunération</strong>
                </div>
                <div class="card-body" >
                    <div class="row">
                        <div class="col-sm-3">
                            <p> Budget mensuel : <b>{{isset($recrutement->budgetMensuel)?$recrutement->budgetMensuel:''}}</b></p>


                        </div>
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