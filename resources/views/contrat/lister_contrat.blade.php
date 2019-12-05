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
            <div class="card-body">
                <a  href="{{route('fiche_personnel',$personne->slug)}}" class="btn btn-outline-primary">Consulter la fiche</a>
                <a  href="{{route('detail_personne',$personne->slug)}}" class="btn btn-outline-secondary">Modifier les informations</a>
                <a href="{{route('document_administratif',$personne->slug)}}" class="btn btn-outline-success"> gérer les dossiers</a>
                <a href="{{route('lister_contrat',$personne->slug)}}" class="btn btn-outline-danger">Gérer les contrats</a>
            </div>

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

                                    @if($contrat->id_nature_contrat==1)
                                        <div class="input-group-btn">
                                            <div class="btn-group">
                                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-primary">Action</button>
                                                <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
                                                    <button type="button" tabindex="0" class="dropdown-item"  data-toggle="modal" data-target="#RVmodal" data-placement="top" title="Renouvellement de contrat" id="modalbtnrenouvellement">Renouvellement de contrat</button>
                                                    <button type="button" tabindex="0" class="dropdown-item"  data-toggle="modal" data-target="#RVmodal" data-placement="top" title="Avenant de contrat" id="modalbtnavenant" >Avenant</button>
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
function vider(){
    $("#id_definition").val("");
    $("#id_categorie").val("");
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
    $("#regime").val("");
}
            function information_contrat(ici){
                var data = table.row($(ici).closest('tr')).data();
                var id=data[Object.keys(data)[0]];
                $.get("../information_contrat/"+id,function(data){
                    console.log(data);
                    $("#id_definition").val(data.id_definition);
                    $("#id_categorie").val(data.id_categorie);
                    $("#matricule").val(data.matricule);
                    $("#service").val(data.service);
                    $("#couverture_maladie").val(data.couvertureMaladie);
                    $("#type_contrat").val(data.id_type_contrat);
                    $("#email").val(data.email);
                    $("#contact").val(data.contact);
                    $("#dateDebutC").val(data.datedebutc);
                    $("#dateFinC").val(data.datefinc);
                    $("#periode_essaie").val(data.periode_essaie);
                    $("#position").val(data.position);
                    $("#id_personne").val(data.id_personne);
                    $("#regime").val(data.regime);


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
            $("#id_definition").change(function (e) {
                var id_definition=  $("#id_definition").val();
                $.get("../listercat/"+id_definition,function(data){
                    console.log(data);
                    var lesOptions;
                    $.each(data, function( index, value ) {
                        lesOptions+="<option value='"+value.libelle+"'>"+value.libelle+"</option>" ;
                    });
                    alert(lesOptions);
                    $("#id_categorie").empty();
                    $("#id_categorie").append(lesOptions);
                    //  $("#id_categorie").trigger("chosen:updated");

                });
                //  alert("ddd");
            });
            //table.DataTable().draw();
        } );
    </script>
@endsection