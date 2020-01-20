@extends('layouts.app')
@section('pole_demande')
    active
@endsection
@section('pole_demande_block')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <a href="{{route('modification.demande')}}" class="card col-sm-4">
            <div style="color: deepskyblue">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-plus fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Demande</h4>
                </div>
            </div>
        </a>
        <a href="{{route('modification.validation')}}" class="card col-sm-4">
            <div    style="color: deepskyblue">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-clipboard-check fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Validation</h4>
                </div>

            </div>
        </a>
        <a href="{{route('modification.gestion')}}" class="card col-sm-4">
            <div    style="color: deepskyblue">
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
                <strong>Liste des modifications</strong>
            </div>
            <div class="card-body" >
                <div class="row">

                    <div class="col-sm-6">
                        {{$modification->list_modif}}
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
    </br>
    </br>
    </br>
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