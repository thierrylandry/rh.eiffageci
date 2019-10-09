@extends('layouts.app')
@section('informatique')
    active
@endsection
@section('etats')
    style="display: block;"
@endsection
@section('page')

    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">TABLEAU DE GESTION DU PARC INFORMATIQUE</h2>
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

                        <th>PRENOMS</th>
                        <th>NOM</th>
                        <th>CHANTIER</th>
                        <th>POSTE</th>
                        <th>EMAIL</th>
                        <th>TELEPHONE</th>
                        <th>TYPE</th>
                        <th>N° DE PA</th>
                        <th>STATION D'A</th>
                        <th>WHATSAPP</th>
                        <th>SATTELITAIRE</th>
                        <th>LIEN DE PARENTE</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lespersonnes as $lespersonne)

                        <tr>
                            <th>{{$lespersonne->prenoms}}</th>
                            <th>{{$lespersonne->NOM}}</th>
                            <th>{{$lespersonne->CHANTIER}}</th>
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
            function getWeek ( tDate ) {
                var res = '' ;

                //de l'année courante
                var janv1 = new Date ( tDate.getYear(), 0, 1 ) ;  //1 janvier
                var dec31 = new Date ( tDate.getYear(), 11, 31 ) ;  //31 decembre
                var janv1Num = janv1.getDay() == 0 ? 7 : janv1.getDay() ; //numero du 1 janvier
                var premSem = 7 - janv1Num > 2 ? true : false ;  //si la première semaine compte ou pas
                var premLundi = 9 - janv1Num ; //date du premier lundi suivant le 1 janvier
                //nb jour separant la date du 1 janvier
                var nbJour = parseInt((tDate - janv1) / (60 * 60 * 24 * 1000) + 1, 10) ;
                //nb jour dans l'annee
                var nbJourTot = parseInt((dec31 - janv1) / (60 * 60 * 24 * 1000) + 1, 10) ;
                //nombre de semaines dans l'annee
                var nbSem ;
                if (janv1Num == 4 || (janv1Num == 3 && nbJourTot == 366)) { nbSem = 53 ; }
                else { nbSem = 52 ; }

                //de l'année précédente
                var janv1Prev = new Date ( tDate.getYear()-1, 0, 1 ) ;  //1 janvier
                var dec31Prev = new Date ( tDate.getYear()-1, 11, 31 ) ;  //31 decembre
                var janv1NumPrev = janv1Prev.getDay() == 0 ? 7 : janv1Prev.getDay() ;  //numero du 1 janvier
                //nb jour dans l'annee
                var nbJourTotPrev = parseInt((dec31Prev - janv1Prev) / (60 * 60 * 24 * 1000) + 1, 10) ;
                //nombre de semaines dans l'annee
                var nbSemPrev ;
                if (janv1NumPrev == 4 || (janv1NumPrev == 3 && nbJourTotPrev == 366)) { nbSemPrev = 53 ; }
                else { nbSemPrev = 52 ; }

                //calcul de la semaine
                var nbSemCompl = parseInt((nbJour - premLundi) / 7 , 10) ;

                var week = premSem + nbSemCompl + 1 ;

                if (nbJour < premLundi) {
                    if (premSem) {
                        res = '01/' + tDate.getYear() ;
                    }
                    else {
                        res = nbSemPrev + '/' + (tDate.getYear()-1) ;
                    }
                }
                else {
                    if ((week > 52) && (week > nbSem)) {
                        res = '01/' + (tDate.getYear()+1) ;
                    }
                    else {
                        var tmp = '0' + week ;
                        res = tmp.substring(tmp.length-2, tmp.length) + '/' + tDate.getYear() ;
                    }
                }

                return (res) ;
            }


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
                        filename: "Tableau synoptique N°<?php echo date('W', strtotime("now")); ?>",
                        messageTop: "",
                        title: "Tableau synoptique  N°<?php echo date('W', strtotime("now")); ?>",
                        orientation: 'landscape',
                        pageSize: 'LEGAL'
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns:  [ 0,1, 2,3,4,5,6,7,8]
                        },
                        text:"Excel",
                        filename: "Tableau synoptique N°<?php echo date('W', strtotime("now")); ?>",
                        messageTop: "",
                        title: "Tableau synoptique  N°<?php echo date('W', strtotime("now")); ?>",
                        orientation: 'landscape',
                        pageSize: 'LEGAL',

                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns:  [ 0,1, 2,3,4,5,6,7,8]
                        },
                        text:"PDF",
                        filename: "Tableau synoptique N°<?php echo date('W', strtotime("now")); ?>",
                        messageTop: "",
                        title: "Tableau synoptique  N°<?php echo date('W', strtotime("now")); ?>",
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns:  [ 0,1, 2,3,4,5,6,7,8]
                        },
                        text:"Imprimer",
                        filename: "Tableau synoptique N°<?php echo date('W', strtotime("now")); ?>",
                        messageTop: "",
                        title: "Tableau synoptique  N°<?php echo date('W', strtotime("now")); ?>",
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                    }
                ],
                language: {
                    url: "{{ asset('public/js/French.json')}}"
                },

                "paging": false,
                "order": false,
                "responsive": true,
                "createdRow": function( row, data, dataIndex){

                },
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