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
                        <th>NATIONALITE</th>
                        <th>ADRESSE</th>
                        <th>MOBILE</th>
                        <th>WHATSAPP</th>
                        <th>SATTELITAIRE</th>
                        <th>LIEN DE PARENTE</th>
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
                            <td>{{$expatrie->contact}}</td>
                            <td>{{$expatrie->whatsapp}}</td>
                            <td>{{$expatrie->sattelitaire}}</td>
                            <td>-</td>
                        </tr>

                        @if(isset($expatrie->familles) && !empty($expatrie->familles))

                            <?php $tabs=json_decode($expatrie->familles);
                            ?>
                            @foreach($tabs as $familles)
                                <tr class="tr-shadow">
                                    <td>{{isset($familles->nom_prenom)?explode(' ',$familles->nom_prenom)[0]:''}}</td>
                                    <td>

                                        @if(isset($familles->nom_prenom))

                                            <?php
                                            foreach(explode(' : ',$familles->nom_prenom) as $tt):
                                           $nom_part.=$tt.' ';
                                            endforeach;
                                            ?>

                                            {{$nom_part}}

                                        @endif


                                  </td>
                                    <td>{{$expatrie->libelle}}</td>
                                    <td>{{$expatrie->nom_fr_fr}}</td>
                                    <td>{{$expatrie->adresse}}</td>
                                    <td>{{$expatrie->contact}}</td>
                                    <td>{{$expatrie->whatsapp}}</td>
                                    <td>{{$expatrie->sattelitaire}}</td>
                                    <td>

                                        @if($familles->lien_parente=="CONJ") conjoint de {{$expatrie->nom}} {{$expatrie->prenom}} @endif
                                        @if($familles->lien_parente=="ENF") enfant de {{$expatrie->nom}} {{$expatrie->prenom}} @endif</td>
                                </tr>
                            @endforeach
                            @endif

                    @endforeach

                    @foreach($invites_presents as $invites_present)
                        <tr class="tr-shadow">
                            <td>{{$invites_present->nom}}</td>
                            <td>{{$invites_present->prenoms}}</td>
                            <td>{{$invites_present->fonction}}</td>
                            <td>{{$invites_present->nom_fr_fr}}</td>
                            <td>{{$invites_present->adresse}}</td>
                            <td>{{$invites_present->contact}}</td>
                            <td>{{$invites_present->whatsapp}}</td>
                            <td>{{$invites_present->sattelitaire}}</td>
                            <td>-</td>
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
                            columns: [ 0,1, 2,3,4,5,6,7,8]
                        },
                        text:"Copier",
                        filename: "Tableau synoptique "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        messageTop: "Tableau synoptique  "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns:  [ 0,1, 2,3,4,5,6,7,8]
                        },
                        text:"Excel",
                        filename: "Tableau synoptique  "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        messageTop: "Tableau synoptique  "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        orientation: 'landscape',
                        pageSize: 'LEGAL'

                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns:  [ 0,1, 2,3,4,5,6,7,8]
                        },
                        text:"PDF",
                        filename: "Tableau synoptique  "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        messageTop: "Tableau synoptique  "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        orientation: 'landscape',
                        pageSize: 'LEGAL'

                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns:  [ 0,1, 2,3,4,5,6,7,8]
                        },
                        text:"Imprimer",
                        filename: "Tableau synoptique  "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        messageTop: "Tableau synoptique  "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    }
                ],
                language: {
                    url: "{{ asset('public/js/French.json')}}"
                },

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