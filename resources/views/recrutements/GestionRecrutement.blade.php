@extends('layouts.app')
@section('recrutement.gestion')
    active
@endsection
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
        <div class="col-md-12" style="overflow-x:scroll;">
            <!-- DATA TABLE -->
            <div class="table-data__tool  pull-right">
                <div class="table-data__tool-right">
                    <a href="" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>DEMANDER UN RECRUTEMENT</a>
                </div>
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
                        <th>DESCRIPTIF</th>
                        <th>COMPETENCES</th>
                        <th>RESPONSABILITES</th>
                        <th>CONTRAT</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recrutements as $recrutement)
                        <tr>
                            <td>{{$recrutement->slug}}</td>
                            <td>    @if($recrutement->etat==1)
                                        <i class=" fas fa-check-circle-o" style="background-color: red"></i>
                                        @elseif($recrutement->etat==2)
                                         <i class=" fas fa-check-circle-o" style="background-color: orange"></i>
                                    @elseif($recrutement->etat==3)
                                    <i class=" fas fa-check-circle-o" style="background-color: green"></i>
                                @elseif($recrutement->etat==4)
                                    <i class=" fas fa-check-circle-o" style="background-color: black"></i>
                                    @endif
                            </td>
                            <td>{{$recrutement->id}}</td>
                            <td>{{$recrutement->user->nom}} {{$recrutement->user->prenoms}}</td>
                            <td>{{$recrutement->user->entite->libelle}}</td>
                            <td>{{$recrutement->user->service->libelle}}</td>
                            <td>{{$recrutement->posteAPouvoir}}</td>
                            <td>{{$recrutement->descriptifFonction}}</td>
                            <td>
                                <ul>@foreach(json_decode($recrutement->competenceRecherche) as $tab)
                                         @if(!empty($tab))
                                            <li>
                                        {{$tab}}
                                            </li>
                                        @endif
                                      @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>@foreach(json_decode($recrutement->tache) as $tab)
                                        @if(!empty($tab))
                                            <li>
                                                {{$tab}}
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                             </td>
                            <td>{{$recrutement->type_contrat->libelle}}</td>
                            <td>
                                @if($recrutement->etat==1)
                                    <a><i class="fas fa-pencil" style="background-color: red"></i> Modifier</a>
                                @elseif($recrutement->etat==2)
                                    <i class=" fas fa-check-circle-o" style="background-color: orange"></i>
                                @elseif($recrutement->etat==3)
                                    <i class=" fas fa-check-circle-o" style="background-color: green"></i>
                                @elseif($recrutement->etat==4)
                                    <i class=" fas fa-check-circle-o" style="background-color: black"></i>
                                @endif
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
            }).column(0).visible(false);
            //table.DataTable().draw();
        } );
        $(".current").click(function (){
            alert("eee");
        });
    </script>
@endsection