@extends('layouts.app')
@section('expatrie')
    active
@endsection
@section('etats')
    style="display: block;"
@endsection
@section('page')

    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">LISTE DES EXPATRIES</h2>
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
                        <th>FONCTION</th>
                        <th>NATIONNALITE</th>
                        <th>ADRESSE</th>
                        <th>MOBILE</th>
                        <th>WHATSAPP</th>
                        <th>SATTELITAIRE</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($expatries as $expatrie)
                        <tr class="tr-shadow">
                            <td>{{$expatrie->nom}}</td>
                            <td>{{$expatrie->prenom}}</td>
                            <td>{{$expatrie->libelle}}</td>
                            <td>{{$expatrie->nom_fr_fr}}</td>
                            <td>{{$expatrie->adresse}}</td>
                            <td>{{$expatrie->mobile}}</td>
                            <td>{{$expatrie->whatsapp}}</td>
                            <td>{{$expatrie->sattelitaire}}</td>
                        </tr>

                        @if(isset($expatrie->familles) && !empty($expatrie->familles))

                            @foreach(json_decode($expatrie->familles) as $familles)
                                <tr class="tr-shadow">
                                    <td>{{isset($familles->nom_prenom)?$familles->nom_prenom:''}}</td>
                                    <td></td>
                                    <td>{{isset($expatrie->surete) && $expatrie->surete==1?'OUI':'NON'}}</td>
                                </tr>
                            @endforeach
                            @endif

                    @endforeach

                    @foreach($invites_presents as $invites_present)
                        <tr class="tr-shadow">
                            <td>{{$invites_present->nom}}</td>
                            <td>{{$invites_present->prenoms}}</td>
                            <td>{{isset($invites_present->surete) && $invites_present->surete==1?'OUI':'NON'}}</td>
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
            var date =new Date();
            var table= $('#table_repertoire').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 0,1, 2]
                        },
                        text:"Copier",
                        filename: "Liste des expatriés du "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        messageTop: "Liste des expatriés du "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0,1, 2]
                        },
                        text:"Excel",
                        filename: "Liste des expatriés du "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        messageTop: "Liste des expatriés du "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0,1, 2]
                        },
                        text:"PDF",
                        filename: "Liste des expatriés du "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        messageTop: "Liste des expatriés du "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0,1, 2]
                        },
                        text:"Imprimer",
                        filename: "Liste des expatriés du "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        messageTop: "Liste des expatriés du "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
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
            var table1= $('#table_invite').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 0,1, 2]
                        },
                        text:"Copier",
                        filename: "Liste des invités presents du "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        messageTop: "Liste des invités presents du "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0,1, 2]
                        },
                        text:"Excel",
                        filename: "Liste des invités presents du "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        messageTop: "Liste des invités presents du "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0,1, 2]
                        },
                        text:"PDF",
                        filename: "Liste des invités presents du "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        messageTop: "Liste des invités presents du "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),

                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0,1, 2]
                        },
                        text:"Imprimer",
                        filename: "Liste des invités presents du "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        messageTop: "Liste des invités presents du "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
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