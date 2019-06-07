@extends('layouts.app')
@section('global')
    active
@endsection
@section('tableau_de_bord_block')
    style="display: block;"
@endsection
@section('page')

    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">Global</h2>
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
                                <td>
                                @if($res->entite==1)
                                    PHB
                                   @elseif($res->entite==2)
                                    SPIE FONDATION
                                    @elseif($res->entite==3)
                                    DIRECTION CI
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
                    <h3 class="title-2 m-b-40">Effectifs globaux Projet ESF</h3>
                    <canvas id="effectif_globaux"></canvas>
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
            @if($res->entite==1)
                   "{{"PHB"}}",
            @elseif($res->entite==2)
            "{{"SPIE FONDATION"}}",
            @elseif($res->entite==3)
            "{{"DIRECTION CI"}}",
            @endif
            @endforeach
        ];
        var DATA = [
            @foreach($tabResultat as $res)
            {{$res}},
            @endforeach
        ]
    </script>
@endsection