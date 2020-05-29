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
        @font-face {
            font-family: "alamain";
            src: url('alamain1.ttf');
        }
        @font-face {
            font-family: "alamain";
            font-style: italic;
            src: url('alamain1.ttf');
        }
        @font-face {
            font-family: "alamain";
            font-weight: bold;
            src: url('alamain1.ttf');
        }
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
@include('personne.menu_retour_contrat')

            <div class="table-responsive table-responsive-data2">
                <table class="table  table-earning" id="table_employe">
                    <thead>
                    <tr>
                        <th>slug</th>
                        <th>NATURE CONTRAT</th>
                        <th>MATRICULE</th>
                        <th class="">TYPE </br>CONTRAT</th>
                        <th>COUVERTURE </br>MALADIE</th>
                        <th>SERVICE</th>
                        <th>DATE DEBUT</th>
                        <th>DATE FIN</th>
                        <th>DATE DE </br>DEPART DEFINITIF</th>
                        <th>PERIODE </br> ESSAI</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contrats as $contrat)
                        <tr class="tr-shadow @if($contrat->etat==2) grey @endif">
                            <td>{{$contrat->id}}</td>
                            <td>@if(isset($contrat->nature_contrat->id) && $contrat->nature_contrat->id==1)
                                    <span style="background-color:#57b846; color:white">{{$contrat->nature_contrat->libelle}}</span>
                                @elseif(isset($contrat->nature_contrat->id) && $contrat->nature_contrat->id==2)
                                    <span style="background-color:#00b5e9;  color:white">{{$contrat->nature_contrat->libelle}}</span>
                                @elseif(isset($contrat->nature_contrat->id) && $contrat->nature_contrat->id==3)
                                    <span style="background-color:#4bb1b1;  color:white">{{$contrat->nature_contrat->libelle}}</span>
                                @endif
                            </td>
                            <td>{{$contrat->matricule}}</td>
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
                            <td> {{ isset($contrat->datefinc) ?date("d-m-Y",strtotime($contrat->datefinc)):'' }}</td>
                            <td>
                                {{isset($contrat) && $contrat->departDefinitif!=''? $newDate = date("d-m-Y",strtotime($contrat->departDefinitif)):''}}</td>
                            <td> {{ isset($contrat->periode_essaie)?date("d-m-Y",strtotime($contrat->periode_essaie)):'' }}</td>

                            <td> <div class="table-data-feature">

                                    @if($contrat->etat==1)
                                        <div class="input-group-btn">
                                            <div class="btn-group">
                                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-primary">Action</button>
                                                <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
                                                    @if($contrat->id_nature_contrat==1)
                                                        <a href="{{route("contratpdf",$contrat->id)}}" target="_blank" tabindex="0" class="dropdown-item" title="Télécharger le pdf" > <i class="zmdi zmdi-collection-pdf"></i> Télécharger le pdf</a>
                                                    @elseif($contrat->id_nature_contrat==2 &&  $contrat->id_type_contrat=2 || $contrat->id_type_contrat==4)
                                                        <a href="{{route("renouvellement_contratpdf",$contrat->id)}}" target="_blank" tabindex="0" class="dropdown-item" title="Télécharger le pdf" > <i class="zmdi zmdi-collection-pdf"></i> Télécharger le pdf</a>
                                                    @elseif($contrat->id_nature_contrat==3)
                                                        <a href="{{route("avenant",$contrat->id)}}" target="_blank" tabindex="0" class="dropdown-item" title="Télécharger le pdf" > <i class="zmdi zmdi-collection-pdf"></i> Télécharger le pdf</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif

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
                                        @if($contrat->id_nature_contrat==1)
                                        <a href="{{route("contratpdf",$contrat->id)}}" target="_blank" tabindex="0" class="dropdown-item" title="Télécharger le pdf" > <i class="zmdi zmdi-collection-pdf"></i> Télécharger le pdf</a>
                                        @endif

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
                "order": [[ 0, "desc" ]],
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
            $('#table_employe tbody').on( 'click', 'tr', function () {
                $(this).toggleClass('selected');
            } );

            $('#button').click( function () {
                alert( table.rows('.selected').data().length +' row(s) selected' );
            } );
            function vider(){
                $("#id_definition1").val("");
                $("#id_categorie1").val("");
                $("#matricule").val("");
                $("#service").val("");
                $("#couverture_maladie").val();
                $("#type_contrat").val();
                $("#email").val("");
                $("#contact").val("");
                $("#dateDebutC").val("");
                $("#dateFinC").val("");
                $("#periode_essaie").val("");
                $("#position").val("");
                $("#id_personne").val("");
                $("#id_nature_contrat").val("");
                $("#service").val("");
                $("#regime").val("");
            }
            function information_contrat(ici){
                var data = table.row($(ici).closest('tr')).data();
                var id=data[Object.keys(data)[0]];
                $.get("../information_contrat/"+id,function(data){
                    console.log(data);
                    $("#id_definition1").val(data[0].id_definition);
                    $("#id_categorie1").empty();

                    var lesOptions;
                    $.each(data[1], function( index, value ) {
                        lesOptions+="<option value='"+value.id+"'>"+value.libelle+"</option>" ;
                    });

                    $("#id_categorie1").append(lesOptions);
                    $("#id_categorie1").val(data[0].id_categorie);
                    $("#matricule").val(data[0].matricule);
                    $("#service").val(data[0].service);
                    $("#couverture_maladie").val(data[0].couvertureMaladie);
                    $("#type_contrat").val(data[0].id_type_contrat);
                    $("#email").val(data[0].email);
                    $("#contact").val(data[0].contact);
                    $("#dateDebutC").val(data[0].datedebutc);
                    $("#dateFinC").val(data[0].datefinc);
                    $("#periode_essaie").val(data.periode_essaie);
                    $("#position").val(data[0].position);
                    $("#id_personne").val(data[0].id_personne);
                    $("#service").val(data[0].id_service);
                    $("#regime").val(data[0].regime);


                });
            }

            $("#modalbtnrenouvellement").click(function (e) {
                $typedoc=2;
                vider();
                information_contrat(this);
                if($typedoc==2){
                    $("#titre_contrat").html("RENOUVELLEMENT DE CONTRAT")
                    $("#dateDebutC").prop('readonly',true);
                    $("#dateFinC").prop('readonly',false);
                    /*   $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);*/
                    $("#id_nature_contrat").val($typedoc);
                }else if($typedoc==3){
                    $("#titre_contrat").html("AVENANT DE CONTRAT")
                    $("#dateDebutC").prop('readonly',true);
                    $("#dateFinC").prop('readonly',true);
                    $("#id_nature_contrat").val($typedoc);
                    /*   $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);*/
                }


            });
            $("#modalbtnavenant").click(function (e) {
                $typedoc=3;
                vider();
                information_contrat(this);
                if($typedoc==2){
                    $("#titre_contrat").html("RENOUVELLEMENT DE CONTRAT")
                    $("#dateDebutC").prop('readonly',true);
                    $("#dateFinC").prop('readonly',false);
                    $("#id_nature_contrat").val($typedoc);
                    /*   $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);*/
                }else if($typedoc==3){
                    $("#titre_contrat").html("AVENANT DE CONTRAT")
                    $("#dateDebutC").prop('readonly',true);
                    $("#dateFinC").prop('readonly',true);
                    $("#id_nature_contrat").val($typedoc);
                    /*   $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);*/
                }


            });
            $("#id_definition1").change(function (e) {
                var id_definition=  $("#id_definition1").val();
                $.get("../listercat/"+id_definition,function(data){
                    console.log(data);
                    var lesOptions;
                    $.each(data, function( index, value ) {
                        lesOptions+="<option value='"+value.libelle+"'>"+value.libelle+"</option>" ;
                    });
                    $("#id_categorie1").empty();
                    $("#id_categorie1").append(lesOptions);
                    //  $("#id_categorie").trigger("chosen:updated");

                });
                //  alert("ddd");
            });
            //table.DataTable().draw();
        } );
    </script>
@endsection