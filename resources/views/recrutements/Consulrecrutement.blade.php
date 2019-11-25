@extends('layouts.app')
@section('detail_personne')
    active
@endsection
@section('detail_personne_block')
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
    <div class="table-data__tool">
        <div class="table-data__tool-left">
        </div>

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
                                    <li>{{ isset($competence)?$competence:'' }}</li>
                                @endforeach
                            @endif
                        </ul>

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