@extends('layouts.app')
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
        <div class="col-lg-12">
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
            "{{$res->libelleUnite}}",
            @endforeach
        ];
        var DATA = [
            @foreach($tabResultat as $res)
            {{$res}},
            @endforeach
        ]
    </script>
@endsection