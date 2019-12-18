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