@extends('layouts.app')
@section('repertoire')
    active
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">REPERTOIRE</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->

            <div class="table-responsive table-responsive-data2" style="overflow-x: scroll">
                <table class="table  table-earning" id="table_repertoire">
                    <thead>
                    <tr>
                        <th>NOM</th>
                        <th>PRENOMS</th>
                        <th>FONCTION</th>
                        <th>CONTACT PROFESSIONNEL</th>
                        <th>CONTACT PERSONNEL</th>
                        <th>EMAIL</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($repertoires as $repertoire)
                        <tr class="tr-shadow">
                            <td>{{$repertoire->nom}}</td>
                            <td>{{$repertoire->prenom}}</td>
                            <td>{{$repertoire->fonction}}</td>
                            <td><i class="fa fa-phone-square" aria-hidden="true"></i> {{$repertoire->pro}}</td>
                            <td><i class="fa fa-phone-square" aria-hidden="true"></i> {{$repertoire->perso}}</td>
                            <td><i class="fa fa-envelope" aria-hidden="true"></i> {{$repertoire->email}}</td>
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
        $(document).ready(function() {
            var table= $('#table_repertoire').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        title: 'Répertoire ESF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    },
                    {
                        extend: 'csv',
                        title: 'Répertoire ESF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'Répertoire ESF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Répertoire ESF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    } ,
                    {
                        extend: 'print',
                        title: 'Répertoire ESF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    }
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
            });
            //table.DataTable().draw();
        } );
        $('#table_repertoire tbody').on( 'click', 'tr', function () {
            $(this).toggleClass('selected');
        } );

        $('#button').click( function () {
            alert( table.rows('.selected').data().length +' row(s) selected' );
        } );
    </script>
@endsection