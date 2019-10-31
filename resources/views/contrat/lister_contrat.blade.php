@extends('layouts.app')
@section('lister_contrat')
    active
@endsection
@section('lister_contrat_block')
    style="display: block;"
@endsection
@section('page')
    <style>
        .grey{ background-color: lightgrey !important;}
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">  {{" NOM : ". $personne->nom." ".$personne->prenom}}-LISTE CONTRAT</h2>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool  pull-right">
                <div class="table-data__tool-right">

                    <a href="{{route('lister_personne',$personne->id_entite)}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-long-arrow-return"></i>Retour</a>
                </div>&nbsp;
                <div class="table-data__tool-right">

                    <a href="{{route('contrat_new_user2',['slug'=>$personne->slug])}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>AJOUTER UN CONTRAT</a>
                </div>
            </div>

            <div class="table-responsive table-responsive-data2">
                <table class="table  table-earning" id="table_employe">
                    <thead>
                    <tr>
                        <th>slug</th>
                        <th class="">TYPE </br>CONTRAT</th>
                        <th>COUVERTURE </br>MALADIE</th>
                        <th>SERVICE</th>
                        <th>DATE DEBUT</th>
                        <th>DATE FIN</th>
                        <th>PERIODE </br> ESSAI</th>
                        <th>TIMELINE</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contrats as $contrat)
                        <tr class="tr-shadow @if($contrat->etat==2) grey @endif">
                            <td>{{$contrat->id}}</td>
                            <td>@foreach($typecontrats as $typecontrat)
                                    @if($typecontrat->id==$contrat->id_type_contrat)
                                        {{$typecontrat->libelle}}
                                    @endif
                                @endforeach</td>
                            <td>{{$contrat->couvertureMaladie}}</td>
                            <td>@foreach($services as $service)
                                    @if($service->id==$contrat->id_service)
                                        {{$service->libelle}}
                                    @endif
                                @endforeach</td>
                            <td>
                                {{ isset($contrat->datedebutc)?date("d-m-Y",strtotime($contrat->datedebutc)):'' }}
                            </td>
                            <td> {{ isset($contrat->datefinc) || $contrat->datefinc!='0000-00-00' ?date("d-m-Y",strtotime($contrat->datefinc)):'' }}</td>
                            <td> {{ isset($contrat->periode_essaie)?date("d-m-Y",strtotime($contrat->periode_essaie)):'' }}</td>
                            <td>

                                @if(!empty($contrat->datedebutc) && !empty($contrat->datefinc) && Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)) !=0)
                                <div class=" ">
                                    @if(round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)))<=25)
                                    <div class="progress mb-3">

                                          <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $diff = ((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)) }}%" aria-valuenow="{{ $diff = Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()) }}"
                                             aria-valuemin="0" aria-valuemax="100">{{ round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc))) }}%</div>
                                    </div>
@elseif(round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)))>25 && round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)))<=50)
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $diff = ((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)) }}%" aria-valuenow="{{ $diff = Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()) }}"
                                             aria-valuemin="0" aria-valuemax="100">{{ round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc))) }}%</div>
                                    </div>
@elseif(round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)))>50 && round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)))<=75)
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $diff = ((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)) }}%" aria-valuenow="{{ $diff = Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()) }}"
                                             aria-valuemin="0" aria-valuemax="100">{{ round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc))) }}%</div>
                                    </div>
                                    @elseif(round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)))>75 && round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)))<100)
                                        <div class="progress mb-3">
                                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $diff = ((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)) }}%" aria-valuenow="{{ $diff = Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()) }}"
                                                 aria-valuemin="0" aria-valuemax="100">{{ round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc))) }}%</div>
                                        </div>
                                    @elseif(round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)))>=100)
                                        <div class="progress mb-3">
                                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width:100%" aria-valuenow="{{ $diff = Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()) }}"
                                                 aria-valuemin="0" aria-valuemax="100">100%</div>
                                        </div>
                                    @endif
                                </div>
                            @endif</td>
                            <td> <div class="table-data-feature">

                                    <a href="{{route('affiche_contrat',['id'=>$contrat->id])}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Plus d'info">
                                        <i class="zmdi zmdi-more"></i>
                                    </a>
                                    @if($contrat->etat==1)
                                    <a href="{{route('rupture_contrat',['id'=>$contrat->id])}}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Plus d'info">
                                        <i class="zmdi zmdi-minus-circle-outline"></i>
                                    </a>
                                    @endif
                                    <a href="{{route('affiche_contrat',['id'=>$contrat->id])}}" onclick="if(confirm('Voulez vous supprimer?')){}else{ e.preventDefault()}" class="item" data-toggle="tooltip" data-placement="top" title="Supprimer">
                                        <i class="zmdi zmdi-delete"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
    <script src="{{ asset("js/jquery.min.js") }}"></script>
    <script src="{{ asset("js/dataTables.min.js") }}"></script>

    <script src="{{ asset("js/dataTables.checkboxes.js") }}"></script>
    <script src="{{ asset("js/dataTables.buttons.min.js") }}"></script>
    <script src="{{ asset("js/buttons.flash.min.js") }}"></script>
    <script src="{{ asset("js/jszip.min.js") }}"></script>
    <script src="{{ asset("js/dataTable.pdfmaker.js") }}"></script>
    <script src="{{ asset("js/vfs_fonts.js") }}"></script>
    <script src="{{ asset("js/buttons.html5.min.js") }}"></script>
    <script src="{{ asset("js/buttons.print.min.js") }}"></script>
    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#rendu_img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }else{
                $('#rendu_img').attr('src','images/user.png');
            }
        }

        $("#photo").change(function() {
            readURL(this);
        });
        $("#reset").click(function() {
            $('#rendu_img').attr('src','images/user.png');
        });
    </script>
    <script>
        $(document).ready(function() {
            var table= $('#table_employe').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                language: {
                    url: "{{ asset('public/js/French.json')}}"
                },
                "order": [[ 1, "desc" ]],
                "ordering":true,
                "paging": false,
                "responsive": true,
                "createdRow": function( row, data, dataIndex){

                },
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ]
            }).column(0).visible(false);
            //table.DataTable().draw();
        } );
    </script>
@endsection