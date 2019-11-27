@extends('layouts.app')

@if($mode=="gestion")
        @section('recrutement.gestion')
            active
        @endsection
@else
@section('recrutement.validation')
    active
@endsection
@endif
@section('recrutements')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">RECRUTEMENT - LISTE DES DEMANDES DE RECRUTEMENT</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" >
            <!-- DATA TABLE -->
            <div class="table-data__tool  pull-right">
                @if(Auth::user() != null && Auth::user()->hasRole('Recrutements') || Auth::user()->hasRole('Demande_recrutement'))
                <div class="table-data__tool-right">
                    <a href="{{route('recrutement.demande')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>DEMANDER UN RECRUTEMENT</a>
                </div>
                    @endif
            </div>
            <div class="table-responsive m-b-40">
                <table class="table table-borderles" id="table_recrutement">
                    <thead>
                    <tr>
                        <th>slug</th>
                        <th>STATUS</th>
                        <th>NUMERO</th>
                        <th>DEMANDEUR</th>
                        <th>DIRECTION</th>
                        <th>SERVICE</th>
                        <th>POSTE</th>
                        <th>CONTRAT</th>
                        <th>ACTION</th>
                        <th>CONDITION DE REMUNERATION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recrutements as $recrutement)
                        <tr>
                            <td>{{$recrutement->slug}}</td>
                            <td>    @if($recrutement->etat==1)
                                        <i class=" fa fa-check-circle-o" style="background-color: red"></i>
                                        @elseif($recrutement->etat==2)
                                         <i class=" fa fa-check-circle-o" style="background-color: orange"></i>
                                    @elseif($recrutement->etat==3)
                                    <i class=" fa fa-check-circle-o" style="background-color: green"></i>
                                @elseif($recrutement->etat==4)
                                    <i class=" fa fa-check-circle-o" style="background-color: black"></i>
                                    @endif
                            </td>
                            <td>{{$recrutement->id}}</td>
                            <td>{{$recrutement->user->nom}} {{$recrutement->user->prenoms}}</td>
                            <td>{{$recrutement->user->entite->libelle}}</td>
                            <td>{{$recrutement->user->service->libelle}}</td>
                            <td>{{$recrutement->posteAPouvoir}}</td>
                            <td>{{$recrutement->type_contrat->libelle}}</td>
                            <td>
                                <div class="table-data-feature">
                                @if($recrutement->etat==1)
                                        @if($mode=="validation")
                                        <a href="{{route('recrutement.ActionValider',$recrutement->slug)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Send">
                                            <i class="zmdi zmdi-mail-send"></i> Valider
                                        </a>&nbsp;
                                        <a href="#" class="btn btn-danger btn_rejeter" data-toggle="modal" data-target="#modalrefusdmd" data-placement="top" title="Rejeter">
                                            <i class="zmdi zmdi zmdi-close"></i> Rejeter
                                        </a>&nbsp;
                                        @endif


                                        <a href="{{route("recrutement.consulter",$recrutement->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="fa fa-eye"></i>
                                        </a>&nbsp;
                                    @if($mode=="gestion")
                                        <a href="{{route("recrutement.modification",$recrutement->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>&nbsp;
                                        <a href="{{route("recrutement.supprimer",$recrutement->slug)}}" id="btnsupprimer" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>&nbsp;
                                        @endif


                                @elseif($recrutement->etat==2)
                                        <a href="#" class="btn btn-warning btn_modal_condition_remuneration" data-toggle="modal" data-target="#modalconditionremuneration" data-placement="top" title="Condition de rémunération">
                                            <i class="zmdi zmdi-format-indent-increase"></i> Condition de rémunération
                                        </a>&nbsp;

                                        <a href="{{route("recrutement.consulter",$recrutement->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-eye"></i>
                                        </a>&nbsp;
                                @elseif($recrutement->etat==3)

                                        <a href="{{route("recrutement.consulter",$recrutement->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-eye"></i>
                                        </a>&nbsp;
                                @elseif($recrutement->etat==4)
                                        <a href="{{route("recrutement.supprimer",$recrutement->slug)}}" id="btnsupprimer" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>&nbsp;
                                @endif
                                </div>
                            </td>
                            <td>{{isset($recrutement)?$recrutement->salaire:''}}</td>
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
    <script type="application/javascript">
        $("#addrubrique").click(function (e) {
            $($("#rubriquetemplate").html()).appendTo($("#rubriques"));
        });
    </script>
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

        $("#btnsupprimer").click(function(e){
           if(confirm("Voulez vous supprimer?")){

           }else{
               e.preventDefault;
           }
        })
    </script>
    <script>

        $(document).ready(function() {
            var table= $('#table_recrutement').DataTable({
                "order": [[ 0, "desc" ]],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                language: {
                    url: "{{ asset('public/js/French.json')}}"
                },

                "ordering":true,
                "responsive": true,
                "paging": false,
                "createdRow": function( row, data, dataIndex){

                },
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ]
            }).column(0).visible(false).column(9).visible(false);
            //table.DataTable().draw();

           // $("#slugrecrutement").
            $(".btn_rejeter").click(function(e){

                var data = table.row($(this).closest('tr')).data();
                var slug=data[Object.keys(data)[0]];
                $("#slugrecrutement").val(slug);
            });
            $(".btn_modal_condition_remuneration").click(function(e){

                var data = table.row($(this).closest('tr')).data();
                var slug=data[Object.keys(data)[0]];
                $("#slugConditionRemuneration").val(slug);
                var salairejson=data[Object.keys(data)[9]];

                var tab_salairejson = jQuery.parseJSON( salairejson );
          //      alert( obj.name === "John" );
                console.log(tab_salairejson);
                $("#rubriques").empty();
                $.get("../recrutements/liste_salaire/"+slug,function(data){
                    $("#rubriques").append(data);

                });


            });
        } );
        $(".current").click(function (){
            alert("eee");
        });
        $("#id_definition").change(function (e) {
            var id_definition=  $("#id_definition").val();
            $.get("../listercat/"+id_definition,function(data){
                console.log(data);
                var lesOptions;
                $.each(data, function( index, value ) {
                    lesOptions+="<option value='"+value.id+"'>"+value.libelle+"</option>" ;
                });
                $("#id_categorie").empty();
                $("#id_categorie").append(lesOptions);
                //  $("#id_categorie").trigger("chosen:updated");

            });
            //  alert("ddd");
        })
    </script>
@endsection