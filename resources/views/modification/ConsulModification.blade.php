@extends('layouts.app')
@section('modification.demande')
    active
@endsection
@section('modifications')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">DEMANDE DE MODIFICATION N°{{$modification->id}}</h2>
            </div>
        </div>
    </div>
    <div class="row">

    </div>
    <div class="table-data__tool">
        <div class="table-data__tool-left">
            <div class="table-data__tool  pull-right">
                @if(isset($modification))
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
                        <p> Poste à pouvoir : <b>{{isset($modification)? $modification->postApouvoir:''}}</b></p>
                        <p> Nombre de personne : <b>{{isset($modification)? $modification->nombre_personne:''}}</b></p>
                    </div>
                    <div class="col-sm-4">
                        <p> Date de naissance :  {{\Carbon\Carbon::parse(isset($personne)? $personne->datenaissance:'')->format('d-m-Y')}}</p>
                        <p> Entité : {{isset($modification)?  $modification->entite->libelle:''}}</p>
                    </div>
                    <div class="col-sm-4">
                        <p>Service : {{isset($modification)?  $modification->service->libelle:''}}</p>
                        <p> Description de la fonction : {{isset($modification) ? $modification->descriptifFonction:''}} </p>
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
                            <p> Date de début : <b>{{isset($modification)? $modification->dateDebut:''}}</b></p>

                        </div>
                        <div class="col-sm-3">
                            <p> Type de contrat : <b>{{isset($modification)? $modification->type_contrat->libelle:''}}</b></p>

                        </div>
                        <div class="col-sm-3">
                            <p> Durée de mission : {{isset($modification)? $modification->dureeMission:''}} {{isset($modification) && isset($modification->unitejour->libelle)? $modification->unitejour->libelle:''}}</p>
                        </div>
                        <div class="col-sm-3">
                            <p> Budget mensuel : {{isset($modification)? $modification->budgetMensuel:''}}</p>
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
                        <p> Débit internet : {{isset($recrutement)? $recrutement->forfait:''}} </p>


                    </div>
                    <div class="col-sm-3">
                        <p> Assurance : {{isset($recrutement)?  $recrutement->debit_internet:''}}</p>


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