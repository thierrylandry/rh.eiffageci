@extends('layouts.app')
@section('tableau_de_bord'.$lentite->id)
    active
@endsection
@section('tableau_de_bord_block')
    style="display: block;"
@endsection
@section('page')
    <script src="{{URL::asset('public/code/highcharts.js')}}"></script>
    <script src="{{URL::asset('public/code/modules/exporting.js')}}"></script>
    <script src="{{URL::asset('public/code/modules/export-data.js')}}"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">TABLEAU DE BORD DE {{$lentite->libelle}}</h2><a href="javascript:window.print()" id="btnprint" class="btn btn-info"><i class="fa fa-print"></i> Imprimer</a>
            </div>
        </div>
    </div>
    </br>
    <div class="row">
        <div class="col-lg-6 tableau">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class="tableperso table-earning" id="table_employe">
                            <thead>
                            <tr><?php $somme =0; ?>
                                @foreach($effectifglobaux as $res)
                                <?php $somme += $res->y; ?>
                                @endforeach
                                <th style="width: 100%">Effectifs {{$lentite->libelle}}</th>
                                <th style="min-width: 50px; max-width: 50px">{{$somme}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($effectifglobaux as $res)
                                    <tr class="tr-shadow">

                                        <td>{{$res->name}}</td>
                                        <td>{{$res->y}}</td>
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
                    <div id="effectifglobaux" style="min-width: 310px; height: 310px; max-width: 600px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row break">
        <div class="col-lg-6 col-xs-6	col-sm-6	col-md-6	col-lg-6 tableau">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class="tableperso  table-earning" id="table_employe">
                            <thead>
                            <tr>
                                <?php $somme =0; ?>
                                @foreach($qualification_contractuelle as $res)
                                    <?php $somme += $res->y; ?>
                                @endforeach
                                <th style="width: 100%">Qualification contractuelle {{$lentite->libelle}}</th>
                                <th style="min-width: 50px; max-width: 50px">{{$somme}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($qualification_contractuelle as $res)
                                <tr class="tr-shadow">
                                    <td> {{$res->name}}</td>
                                    <td>{{$res->y}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6	col-sm-6	col-md-6	col-lg-6 ">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <div id="qualification_contractuelle" ></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row break">
        <div class="col-lg-6 tableau">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class=" tableperso table-earning" id="table_employe">
                            <thead>
                            <tr>
                                <?php $somme =0; ?>
                                @foreach($repartition_service as $res)
                                    <?php $somme += $res->y; ?>
                                @endforeach
                                <th style="width: 100%">Services - Personnel {{$lentite->libelle}}</th>
                                <th >{{$somme}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($repartition_service as $res)
                                <tr class="tr-shadow">
                                    <td> {{$res->name}}</td>
                                    <td>{{$res->y}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6	col-sm-6	col-md-6	col-lg-6 ">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <div id="repartition_service" style="min-width: 310px; height: 310px; max-width: 600px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row break">
        <div class="col-lg-6 tableau">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class="tableperso  table-earning" id="table_employe">
                            <thead>
                            <tr>
                                <?php $somme =0; ?>
                                @foreach($repartition_tranche_age as $res)
                                    <?php $somme += $res->y; ?>
                                @endforeach
                                <th style="width: 100%">Répartition tranche d'age {{$lentite->libelle}}</th>
                                <th >{{$somme}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($repartition_tranche_age as $res)
                                <tr class="tr-shadow">
                                    <td> {{$res->name}}</td>
                                    <td>{{$res->y}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6	col-sm-6	col-md-6	col-lg-6 ">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <div id="repartition_tranche_age" style="min-width: 310px; height: 310px; max-width: 600px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row break">
        <div class="col-lg-6 tableau">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class="tableperso  table-earning" id="table_employe">
                            <thead>
                            <tr><?php $somme =0; ?>
                                @foreach($repartition_homme_femme as $res)
                                    <?php $somme += $res->y; ?>
                                @endforeach
                                <th style="width: 100%">Répartition H/F {{$lentite->libelle}}</th>
                                <th >{{$somme}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($repartition_homme_femme as $res)
                                <tr class="tr-shadow">
                                    <td> {{$res->name}}</td>
                                    <td>{{$res->y}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6	col-sm-6	col-md-6	col-lg-6 ">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <div id="repartition_homme_femme" style="min-width: 310px; height: 310px; max-width: 600px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row break">
        <div class="col-lg-6 tableau">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class="tableperso  table-earning" id="table_employe">
                            <thead>
                            <tr>
                                <?php $somme =0; ?>
                                @foreach($repartition_nationalite as $res)
                                    <?php $somme += $res->y; ?>
                                @endforeach
                                <th style="width: 100%">Nationalité - Personnel {{$lentite->libelle}}</th>
                                <th >{{$somme}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($repartition_nationalite as $res)
                                <tr class="tr-shadow">
                                    <td> {{$res->name}}</td>
                                    <td>{{$res->y}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6	col-sm-6	col-md-6	col-lg-6 ">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <div id="repartition_nationalite" ></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 tableau">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class="tableperso  table-earning" id="table_employe">
                            <thead>
                            <tr><?php $somme =0; ?>
                                @foreach($camanberts as $res)
                                    <?php $somme += $res->y; ?>
                                @endforeach
                                <th style="width: 100%">Type de contrat {{$lentite->libelle}}</th>
                                <th >{{$somme}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($camanberts as $res)
                                <tr class="tr-shadow">
                                    <td> {{$res->name}}</td>
                                    <td>{{$res->y}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6	col-sm-6	col-md-6	col-lg-6 ">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <div id="type_de_contrat"  style="min-width: 310px; height: 310px; max-width: 600px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>



    <div class="row break">
        <div class="col-lg-6 tableau">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class="tableperso  table-earning" id="table_employe">
                            <thead>
                            <tr>
                                <?php $somme =0; ?>
                                @foreach($repartition_ancienete as $res)
                                    <?php $somme += $res->y; ?>
                                @endforeach
                                <th style="width: 100%">Ancienneté locaux EGC CI (révolue) {{$lentite->libelle}}</th>
                                <th >{{$somme}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($repartition_ancienete as $res)
                                <tr class="tr-shadow">
                                    <td> {{$res->name}}</td>
                                    <td>{{$res->y}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6	col-sm-6	col-md-6	col-lg-6 ">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <div id="repartition_ancienete" style="min-width: 310px; height: 310px; max-width: 600px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row break">
        <div class="col-lg-6 tableau" >
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class="table  table-earning" id="table_employe">
                            <thead>
                            <tr>
                                <th>Mois</th>
                                <th>Entrées</th>
                                <th>Sorties</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0;$i<sizeof($repartition_entrees);$i++)
                                <tr class="tr-shadow">
                                    <td> {{$repartition_entrees[$i]->name}}</td>
                                    <td> {{$repartition_entrees[$i]->y}}</td>
                                    <td> {{$repartition_sorties[$i]->y}}</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6	col-sm-6	col-md-6	col-lg-6 ">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <div id="bilan_entre_sorti" style="min-width: 310px; height: 310px; max-width: 600px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row break">
        <div class="col-lg-6 tableau" >
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class="table  table-earning" id="table_employe">
                            <thead>
                            <tr>
                                <th>Mois</th>
                                <th>Effectifs</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0;$i<sizeof($effectif_par_mois);$i++)
                                <tr class="tr-shadow">
                                    <td> {{$effectif_par_mois[$i]->name}}</td>
                                    <td> {{$effectif_par_mois[$i]->y}}</td>

                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6	col-sm-6	col-md-6	col-lg-6 ">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <div id="effectif_par_mois" style="min-width: 310px; height: 310px; max-width: 600px; margin: 0 auto"></div>
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
    <script type="application/javascript">
        var effectifglobaux=[
            @foreach($effectifglobaux as $res)
                    {{"{name:"}} '{{$res->name}}' {{",y:".$res->y."}"}}
            ,
            @endforeach
        ];


        var repartition_nationalite=[
            @foreach($repartition_nationalite as $res)
                    {{"{name:"}} '{{$res->name}}' {{",y:".$res->y."}"}},
            @endforeach
        ];

        var repartition_homme_femme=[
            @foreach($repartition_homme_femme as $res)
                    {{"{name:"}} '{{$res->name}}' {{",y:".$res->y."}"}},
            @endforeach
        ];
        var type_de_contrat=[
            @foreach($camanberts as $res)
                    {{"{name:"}} '{{$res->name}}' {{",y:".$res->y."}"}},
            @endforeach
        ];
        var repartition_tranche_age=[
            @foreach($repartition_tranche_age as $res)
                    {{"{name:"}} '{{$res->name}}' {{",y:".$res->y."}"}},
            @endforeach
        ];

        var repartition_ancienete=[
            @foreach($repartition_ancienete as $res)
                    {{"{name:"}} '{{$res->name}}' {{",y:".$res->y."}"}},
            @endforeach
        ];
        var repartition_service=[
            @foreach($repartition_service as $res)
                    {{"{name:"}} '{{$res->name}}' {{",y:".$res->y."}"}},
            @endforeach
        ];

        var repartition_entrees=[
            @foreach($repartition_entrees as $res)
            {{$res->y}},
            @endforeach
        ];
        var repartition_sorties=[
            @foreach($repartition_sorties as $res)
            {{$res->y}},
            @endforeach
        ];
        var effectif_par_mois=[
            @foreach($effectif_par_mois as $res)
            {{$res->y}},
            @endforeach
        ];
        var qualification_contractuelle=[
            @foreach($qualification_contractuelle as $res)
                    {{"{name:"}} '{{$res->name}}' {{",y:".$res->y."}"}},
            @endforeach
        ];

    </script>
    <script type="text/javascript">
        var colors= [
            "#63b598", "#ce7d78", "#ea9e70", "#a48a9e", "#c6e1e8", "#648177" ,"#0d5ac1" ,
            "#f205e6" ,"#1c0365" ,"#14a9ad" ,"#4ca2f9" ,"#a4e43f" ,"#d298e2" ,"#6119d0",
            "#d2737d" ,"#c0a43c" ,"#f2510e" ,"#651be6" ,"#79806e" ,"#61da5e" ,"#cd2f00" ,
            "#9348af" ,"#01ac53" ,"#c5a4fb" ,"#996635","#b11573" ,"#4bb473" ,"#75d89e" ,
            "#2f3f94" ,"#2f7b99" ,"#da967d" ,"#34891f" ,"#b0d87b" ,"#ca4751" ,"#7e50a8" ,
            "#c4d647" ,"#e0eeb8" ,"#11dec1" ,"#289812" ,"#566ca0" ,"#ffdbe1" ,"#2f1179" ,
            "#935b6d" ,"#916988" ,"#513d98" ,"#aead3a", "#9e6d71", "#4b5bdc", "#0cd36d",
            "#250662", "#cb5bea", "#228916", "#ac3e1b", "#df514a", "#539397", "#880977",
            "#f697c1", "#ba96ce", "#679c9d", "#c6c42c", "#5d2c52", "#48b41b", "#e1cf3b",
            "#5be4f0", "#57c4d8", "#a4d17a", "#225b8", "#be608b", "#96b00c", "#088baf",
            "#f158bf", "#e145ba", "#ee91e3", "#05d371", "#5426e0", "#4834d0", "#802234",
            "#6749e8", "#0971f0", "#8fb413", "#b2b4f0", "#c3c89d", "#c9a941", "#41d158",
            "#fb21a3", "#51aed9", "#5bb32d", "#807fb", "#21538e", "#89d534", "#d36647",
            "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
            "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec",
            "#1bb699", "#6b2e5f", "#64820f", "#1c271", "#21538e", "#89d534", "#d36647",
            "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
            "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec",
            "#1bb699", "#6b2e5f", "#64820f", "#1c271", "#9cb64a", "#996c48", "#9ab9b7",
            "#06e052", "#e3a481", "#0eb621", "#fc458e", "#b2db15", "#aa226d", "#792ed8",
            "#73872a", "#520d3a", "#cefcb8", "#a5b3d9", "#7d1d85", "#c4fd57", "#f1ae16",
            "#8fe22a", "#ef6e3c", "#243eeb", "#1dc18", "#dd93fd", "#3f8473", "#e7dbce",
            "#421f79", "#7a3d93", "#635f6d", "#93f2d7", "#9b5c2a", "#15b9ee", "#0f5997",
            "#409188", "#911e20", "#1350ce", "#10e5b1", "#fff4d7", "#cb2582", "#ce00be",
            "#32d5d6", "#17232", "#608572", "#c79bc2", "#00f87c", "#77772a", "#6995ba",
            "#fc6b57", "#f07815", "#8fd883", "#060e27", "#96e591", "#21d52e", "#d00043",
            "#b47162", "#1ec227", "#4f0f6f", "#1d1d58", "#947002", "#bde052", "#e08c56",
            "#28fcfd", "#bb09b", "#36486a", "#d02e29", "#1ae6db", "#3e464c", "#a84a8f",
            "#911e7e", "#3f16d9", "#0f525f", "#ac7c0a", "#b4c086", "#c9d730", "#30cc49",
            "#3d6751", "#fb4c03", "#640fc1", "#62c03e", "#d3493a", "#88aa0b", "#406df9",
            "#615af0", "#4be47", "#2a3434", "#4a543f", "#79bca0", "#a8b8d4", "#00efd4",
            "#7ad236", "#7260d8", "#1deaa7", "#06f43a", "#823c59", "#e3d94c", "#dc1c06",
            "#f53b2a", "#b46238", "#2dfff6", "#a82b89", "#1a8011", "#436a9f", "#1a806a",
            "#4cf09d", "#c188a2", "#67eb4b", "#b308d3", "#fc7e41", "#af3101", "#ff065",
            "#71b1f4", "#a2f8a5", "#e23dd0", "#d3486d", "#00f7f9", "#474893", "#3cec35",
            "#1c65cb", "#5d1d0c", "#2d7d2a", "#ff3420", "#5cdd87", "#a259a4", "#e4ac44",
            "#1bede6", "#8798a4", "#d7790f", "#b2c24f", "#de73c2", "#d70a9c", "#25b67",
            "#88e9b8", "#c2b0e2", "#86e98f", "#ae90e2", "#1a806b", "#436a9e", "#0ec0ff",
            "#f812b3", "#b17fc9", "#8d6c2f", "#d3277a", "#2ca1ae", "#9685eb", "#8a96c6",
            "#dba2e6", "#76fc1b", "#608fa4", "#20f6ba", "#07d7f6", "#dce77a", "#77ecca"];

        // Build the chart
        Highcharts.chart('effectifglobaux', {
            credits: {
                enabled: false
            },
            exporting: { enabled: false },
            colors: colors,
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                width: 600
            },
            title: {
                text: 'Effectifs Globaux {{$lentite->libelle}}'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: effectifglobaux
            }],
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                alignColumns:'true',
                floating:true,
                y: 20,
                x:10,
                useHTML: true,
                navigation: {
                    activeColor: '#3E576F',
                    animation: true,
                    arrowSize: 12,
                    inactiveColor: '#CCC',
                    style: {
                        fontWeight: 'bold',
                        color: '#333',
                        fontSize: '12px'
                    }
                }
            },

        });
        Highcharts.chart('repartition_nationalite', {
            credits: {
                enabled: false
            },
            exporting: { enabled: false },
            colors: colors,
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                width: 600
            },
            title: {
                text: 'Répartition nationalite'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: repartition_nationalite
            }],
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                alignColumns:'true',
                floating:true,
                y: 20,
                x:10,
                useHTML: true,
                navigation: {
                    activeColor: '#3E576F',
                    animation: true,
                    arrowSize: 12,
                    inactiveColor: '#CCC',
                    style: {
                        fontWeight: 'bold',
                        color: '#333',
                        fontSize: '12px'
                    }
                }
            },
        });
        Highcharts.chart('repartition_homme_femme', {
            credits: {
                enabled: false
            },
            exporting: { enabled: false },
            colors: colors,
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                width: 600
            },
            title: {
                text: 'Répartition homme/femme'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: repartition_homme_femme
            }],
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                alignColumns:'true',
                floating:true,
                y: 20,
                x:10,
                useHTML: true,
                navigation: {
                    activeColor: '#3E576F',
                    animation: true,
                    arrowSize: 12,
                    inactiveColor: '#CCC',
                    style: {
                        fontWeight: 'bold',
                        color: '#333',
                        fontSize: '12px'
                    }
                }
            },

        });        Highcharts.chart('type_de_contrat', {
            credits: {
                enabled: false
            },
            exporting: { enabled: false },
            colors: colors,
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                width: 600
            },
            title: {
                text: 'Type de contrat'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: type_de_contrat
            }],
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                alignColumns:'true',
                floating:true,
                y: 20,
                x:10,
                useHTML: true,
                navigation: {
                    activeColor: '#3E576F',
                    animation: true,
                    arrowSize: 12,
                    inactiveColor: '#CCC',
                    style: {
                        fontWeight: 'bold',
                        color: '#333',
                        fontSize: '12px'
                    }
                }
            },

        });
        Highcharts.chart('repartition_tranche_age', {
            credits: {
                enabled: false
            },
            exporting: { enabled: false },
            colors: colors,
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                width: 600
            },
            title: {
                text: "Répartition tranche d'age"
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: repartition_tranche_age
            }],
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                alignColumns:'true',
                floating:true,
                y: 20,
                x:10,
                useHTML: true,
                navigation: {
                    activeColor: '#3E576F',
                    animation: true,
                    arrowSize: 12,
                    inactiveColor: '#CCC',
                    style: {
                        fontWeight: 'bold',
                        color: '#333',
                        fontSize: '12px'
                    }
                }
            },
        });
        Highcharts.chart('repartition_ancienete', {
            credits: {
                enabled: false
            },
            exporting: { enabled: false },
            colors: colors,
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                width: 600
            },
            title: {
                text: "Ancienneté locaux (révolue)"
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: repartition_ancienete
            }],
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                alignColumns:'true',
                floating:true,
                y: 20,
                x:10,
                useHTML: true,
                navigation: {
                    activeColor: '#3E576F',
                    animation: true,
                    arrowSize: 12,
                    inactiveColor: '#CCC',
                    style: {
                        fontWeight: 'bold',
                        color: '#333',
                        fontSize: '12px'
                    }
                }
            },
        });
        Highcharts.chart('repartition_service', {
            credits: {
                enabled: false
            },
            exporting: { enabled: false },
            colors: colors,
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                width: 600
            },
            title: {
                text: "Service - Personnel"
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: repartition_service
            }],
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                alignColumns:'true',
                floating:true,
                y: 20,
                x:10,
                useHTML: true,
                navigation: {
                    activeColor: '#3E576F',
                    animation: true,
                    arrowSize: 12,
                    inactiveColor: '#CCC',
                    style: {
                        fontWeight: 'bold',
                        color: '#333',
                        fontSize: '12px'
                    }
                }
            },
        });
        Highcharts.chart('bilan_entre_sorti', {
            credits: {
                enabled: false
            },
            exporting: { enabled: false },
            chart: {
                type: 'column',
                width: 600
            },
            title: {
                text: 'BILAN ENTREES SORTIES'
            },
            subtitle: {
            },
            xAxis: {
                categories: [
                    'Novembre-{{date('Y')-1}}',
                    'Decembre-{{date('Y')-1}}',
                    'Janvier-{{date('Y')}}',
                    'Fevrier-{{date('Y')}}',
                    'Mars-{{date('Y')}}',
                    'Avril-{{date('Y')}}',
                    'Mais-{{date('Y')}}',
                    'juin-{{date('Y')}}',
                    'juillet-{{date('Y')}}',
                    'Aout-{{date('Y')}}',
                    'Septembre-{{date('Y')}}',
                    'Octobre-{{date('Y')}}',
                    'Novembre-{{date('Y')}}',
                    'Decembre-{{date('Y')}}',
                    'Total'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Entrées',
                data: repartition_entrees

            }, {
                name: 'Sorties',
                data: repartition_sorties

            }]
        });

        Highcharts.chart('effectif_par_mois', {
            chart: {
                type: 'line',
                width: 600
            },
            title: {
                text: 'Effectif Mensuelle'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: [
            'Novembre-{{date('Y')-1}}',
            'Decembre-{{date('Y')-1}}',
            'Janvier-{{date('Y')}}',
            'Fevrier-{{date('Y')}}',
            'Mars-{{date('Y')}}',
            'Avril-{{date('Y')}}',
            'Mais-{{date('Y')}}',
            'juin-{{date('Y')}}',
            'juillet-{{date('Y')}}',
            'Aout-{{date('Y')}}',
            'Septembre-{{date('Y')}}',
            'Octobre-{{date('Y')}}',
            'Novembre-{{date('Y')}}',
            'Decembre-{{date('Y')}}',
            'Total'
        ],
            },
            yAxis: {
                title: {
                    text: 'Durée'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'Effectif',
                data: effectif_par_mois
            }]
        });
        // Build the chart
        Highcharts.chart('qualification_contractuelle', {
            exporting: { enabled: false },
            colors: colors,
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                width: 600
            },
            title: {
                text: 'Qualification contractuelle'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Effectif',
                colorByPoint: true,
                data: qualification_contractuelle
            }],
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                alignColumns:'true',
                floating:true,
                y: 20,
                x:10,
                useHTML: true,
                navigation: {
                    activeColor: '#3E576F',
                    animation: true,
                    arrowSize: 12,
                    inactiveColor: '#CCC',
                    style: {
                        fontWeight: 'bold',
                        color: '#333',
                        fontSize: '12px'
                    }
                }
            },
        });
    </script>
@endsection