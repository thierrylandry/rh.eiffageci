@extends('layouts.app')
@section('dirci')
    active
@endsection
@section('tableau_de_bord_block')
    style="display: block;"
@endsection
@section('page')

    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">DIRECTION CI</h2>
            </div>

        </div>
    </div>
    </br>
    <div class="row">
        <div class="col-lg-6">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class="table  table-earning" id="table_employe">
                            <thead>
                            <tr>
                                <th>Effectifs globaux Projet ESF</th>
                                <th>EFFECTIF</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($effectifglobaux as $res)
                                <tr class="tr-shadow">
                                    <td>{{$res->libelleUnite}}</td>
                                    <td>{{$res->nb}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <h3 class="title-2 m-b-40">Effectifs globaux Projet ESF</h3>
                    <canvas id="effectif_globaux"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class="table  table-earning" id="table_employe">
                            <thead>
                            <tr>
                                <th>Répartition H/F</th>
                                <th>EFFECTIF</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($repartition_homme_femme as $res)
                                <tr class="tr-shadow">
                                    <td> @if($res->sexe=="M")
                                            "{{"Hommes"}}"
                                        @elseif($res->sexe=="F")
                                            "{{"Femmes"}}"
                                        @endif</td>
                                    <td>{{$res->nb}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <h3 class="title-2 m-b-40">Répartition H/F</h3>
                    <canvas id="repartition_homme_femme"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class="table  table-earning" id="table_employe">
                            <thead>
                            <tr>
                                <th>Nationnalité - Personnel</th>
                                <th>EFFECTIF</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($repartition_nationalite as $res)
                                <tr class="tr-shadow">
                                    <td> {{$res->nom_fr_fr}}</td>
                                    <td>{{$res->nb}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <h3 class="title-2 m-b-40">Nationnalité - Personnel</h3>
                    <canvas id="repartition_nationalite"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="copyright">
                <p>Copyright © 2019 Eiffage. All rights reserved.</p>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{isset($json_eff_globaux)?$json_eff_globaux:''}}" id="json_eff_globaux">
    <input type="hidden" value="{{isset($json_entite)?$json_entite:''}}" id="json_entite">
    <input type="hidden" value="{{isset($json_h_f)?$json_h_f:''}}" id="json_h_f">
    <script type="application/javascript">
        var effectifglobaux=[
            @foreach($effectifglobaux as $res)
            {{$res->nb}},
            @endforeach
        ];
        var effectifglobaux_libelle=[
            @foreach($effectifglobaux as $res)
                    "{{$res->libelleUnite}}",
            @endforeach
        ];
        //repartition par sexe
        var repartition_homme_femme=[
            @foreach($repartition_homme_femme as $res)
            {{$res->nb}},
            @endforeach
        ];
        var repartition_homme_femme_libelle=[
            @foreach($repartition_homme_femme as $res)
            @if($res->sexe=="M")
                    "{{"Hommes"}}",
            @elseif($res->sexe=="F")
                    "{{"Femmes"}}",
            @endif
            @endforeach
        ];
        //repartition par nationnalite
        var repartition_nationalite=[
            @foreach($repartition_nationalite as $res)
            {{$res->nb}},
            @endforeach
        ];
        var repartition_nationalite_libelle=[
            @foreach($repartition_nationalite as $res)
            "{{ $res->nom_fr_fr}}",
            @endforeach
        ];
        var DATA = [
            @foreach($tabResultat as $res)
            {{$res}},
            @endforeach
        ]
    </script>
@endsection