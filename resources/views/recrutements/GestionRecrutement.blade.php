@extends('layouts.app')
@section('recrutement.gestion')
    active
@endsection
@section('lister_personne')
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
                        <th>NOM & PRENOM DEMANDEUR</th>
                        <th>DIRECTION</th>
                        <th>SERVICE</th>
                        <th>POSTE A POUVOIR</th>
                        <th>DESCRIPTIF FONCTION</th>
                        <th>COMPETENCES RECHERCHEES</th>
                        <th>RESPONSABILITES OU TACHES</th>
                        <th>NATURE CONTRAT</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recrutements as $recrutement)
                        <tr>
                            <td>{{$recrutement->slug}}</td>
                            <td>{{$recrutement->etat}}</td>
                            <td>{{$recrutement->id}}</td>
                            <td>{{$recrutement->slug}}</td>
                            <td>{{$recrutement->slug}}</td>
                            <td>{{$recrutement->slug}}</td>
                            <td>{{$recrutement->slug}}</td>
                            <td>{{$recrutement->slug}}</td>
                            <td>{{$recrutement->slug}}</td>
                            <td>{{$recrutement->slug}}</td>
                            <td>{{$recrutement->slug}}</td>
                            <td>{{$recrutement->slug}}</td>
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