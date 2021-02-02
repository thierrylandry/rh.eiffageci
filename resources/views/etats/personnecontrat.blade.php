@extends('layouts.app')
@section('personne_contrat')
    active
@endsection
@section('etats')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">LISTE DES PERSONNES ET LEUR TYPE DE CONTRAT</h2>
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
                        <th>NOM</th>
                        <th>PRENOMS</th>
                        <th>SEXE</th>
                        <th>TYPE DE CONTRAT</th>
                        <th>DATE DE DEBUT</th>
                        <th>DATE DE FIN</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contrats as $contrat)
                        <tr class="tr-shadow">
                            <td>{{$contrat->nom}}</td>
                            <td>{{$contrat->prenom}}</td>
                            <td>@if($contrat->sexe=='F') {{"Féminin"}} @else {{"Masculin"}} @endif</td>
                            <td>
                                @if($contrat->definition=="Stagiaire")
                                    {{$contrat->Stagiaire}}
                                    @else
                                    {{$contrat->libelle}}
                            @endif
                            </td>
                            <td>{{$contrat->datedebutc}}</td>
                            <td>
                                @if($contrat->libelle=="CDI")

                                @else
                                    {{$contrat->datefinc}}
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
        $(document).ready(function() {
            var table= $('#table_repertoire').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        title: 'Liste des personnes & leurs contrats'
                    },
                    {
                        extend: 'csv',
                        title: 'Liste des personnes & leurs contrats'
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'Liste des personnes & leurs contrats'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Liste des personnes & leurs contrats'
                    } ,
                    {
                        extend: 'print',
                        title: 'Liste des personnes & leurs contrats'
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
    </script>
@endsection