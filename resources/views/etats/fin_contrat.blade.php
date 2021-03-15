@extends('layouts.app')
@section('fin_contrat')
    active
@endsection
@section('etats')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">FIN CONTRAT</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->

            <div class="table-responsive table-responsive-data2">
                <table class="table  table-earning" id="table_repertoire">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOM</th>
                        <th>PRENOMS</th>
                        <th>TYPE DE CONTRAT</th>
                        <th>FONCTION</th>
                        <th>SERVICE</th>
                        <th>DATE D'EMBAUCHE</th>
                        <th>DATE FIN</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contrats as $contrat)
                        <tr class="tr-shadow">
                            <td>{{$contrat->id_p}}</td>
                            <td>{{$contrat->nom}}</td>
                            <td>{{$contrat->prenom}}</td>
                            <td>{{$contrat->libelle}}</td>
                            <td>{{$contrat->fonction}}</td>
                            <td>{{$contrat->service}}</td>
                            <td><i class="fa fa-calendar-times-o" aria-hidden="true"></i>{{\Carbon\Carbon::parse($contrat->datedebutc)->format('d-m-Y')}}</td>
                            <td><i class="fa fa-calendar-times-o" aria-hidden="true"></i>{{\Carbon\Carbon::parse($contrat->datefinc)->format('d-m-Y')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <button class="btn btn-success" data-toggle="modal" data-target="#RVmodal" id="renouveller"> Renouveller</button>

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
        $(document).ready(function() {
            var table= $('#table_repertoire').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        title: 'Liste fin de contrat groupement'
                    },
                    {
                        extend: 'csv',
                        title: 'Liste fin de contrat groupement'
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'Liste fin de contrat groupement'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Liste fin de contrat groupement'
                    } ,
                    {
                        extend: 'print',
                        title: 'Liste fin de contrat groupement'
                    }
                ],
                language: {
                    url: "{{ asset('public/js/French.json')}}"
                },
                "columnDefs": [
                    {
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true
                        }
                    },
                    { "width": "10%", "targets": 2 }
                ],
                "select": {
                    'style': 'multi'
                },
                "order": [[ 1, "desc" ]],
                "ordering":true,
                "paging": false,
                "responsive": true,
                "createdRow": function( row, data, dataIndex){

                },
            });
            //table.DataTable().draw();
            $('#table_repertoire tbody').on( 'click', 'tr', function () {
                $(this).toggleClass('selected');
            } );

            $('#button').click( function () {
                alert( table.rows('.selected').data().length +' row(s) selected' );
            } );
            $('#renouveller').click(function(e){
                var rows_selected = table.column(0).checkboxes.selected();
                console.log(rows_selected);
                var mavariable="";
                $.each(rows_selected, function(index, rowId){
                    // Create a hidden element
                    //  console.log(rowId);
                    mavariable=mavariable+','+rowId;

                });


                if(mavariable==""){
                    alert("Veuillez selectionner au moins un élément");
                    location.reload(true);
                    e.preventDefault();
                    //  $("#RVmodal").modal('toggle');
                    // $('#RVmodal').modal('show');
                }{
                    $("#id_personnetype_contratrenouvellement").val(mavariable);
                }
                //console.log(mavariable);
            });
        } );
    </script>
@endsection