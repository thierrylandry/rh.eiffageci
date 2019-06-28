@extends('layouts.app')
@section('salaires')
    active
@endsection
@section('salaires_block')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">{{" NOM : ". $personne->nom." ".$personne->prenom}}  SALAIRES-LISTE </h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool  pull-right">

                <div class="table-data__tool-right">
                    <a href="{{ url()->previous() }}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-arrow-back"></i>RETOUR</a>
                </div>
                <div class="table-data__tool-right">
                    <a href="{{route('Ajouter_salaire',['slug'=>$personne->slug])}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>AJOUTER UN SALAIRE</a>
                </div>
            </div>
            <div class="table-responsive table-responsive-data2">
                <table class="table  table-earning" id="table_employe">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>SURSALAIRE</th>
                        <th>TRANSPORT</th>
                        <th>LOGEMENT</th>
                        <th>SALISSURE</th>
                        <th>TENUE DE TRAVAIL</th>
                        <th>SALAIRE BRUTE</th>
                        <th>RETENUE</th>
                        <th>SALAIRE NET</th>
                        <th>DATE DEBUT</th>
                        <th>DATE FIN</th>
                        <th>PERIODE DE CONTRAT</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if( isset($salaires))
                    @foreach($salaires as $salaire)

                        <tr class="tr-shadow">
                            <td>{{$salaire->id}}</td>
                            <td>{{$salaire->sursalaire}}</td>
                            <td>{{$salaire->transport}}</td>
                            <td>{{$salaire->logement}}</td>
                            <td>{{$salaire->salissure}}</td>
                            <td>{{$salaire->tenueTravail}}</td>
                            <td>{{$salaire->sursalaire+$salaire->transport+$salaire->logement+$salaire->salissure+$salaire->tenueTravail}}</td>
                            <td>{{$salaire->retenue}}</td>
                            <td>{{($salaire->sursalaire+$salaire->transport+$salaire->logement+$salaire->salissure+$salaire->tenueTravail)-$salaire->retenue}}</td>
                           <td>{{$salaire->dateDebutS}}</td>
                            <td>{{$salaire->dateFin}}</td>
                            <td>{{"Du ".$salaire->datedebutc." à ".$salaire->datefinc }}</td>

                        </tr>
                    @endforeach
                        @endif
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
    </script>
@endsection