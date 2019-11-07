@extends('layouts.app')
@section('invite')
    active
@endsection
@section('invite')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">PASSAGE  DE {{$invite->prenoms.' '.$invite->nom}}</h2>
            </div>
        </div>
    </div>
    <div class="table-data__tool  pull-right">
        <div class="table-data__tool-right">

            @if(isset($passage))
                <a href="{{ URL::previous() }}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                    <i class="zmdi zmdi-plus"></i>Ajouter</a>
            @endif
            <a href="{{route('invite')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-long-arrow-return"></i>Retour</a>
        </div>&nbsp;
    </div>
    </br>
    <div class="row">

        <div class="col-sm-12">

            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>Ajouter un passage</strong>
                </div>
                <div class="card-body" >
                    @if(isset($passage))
                        <form method="post" action="{{route("modifier_passage")}}">
                            @else
                                <form method="post" action="{{route("enregistrer_passage")}}">
                                    @endif
                                    @csrf
                                    <div class="row">


                                 <div class="col-sm-6">
                                     <div class="row form-group">
                                         <div class="col col-md-3">
                                             <label for="text-input" class=" form-control-label">Date d'arrivée *</label>
                                         </div>
                                         <input type="hidden" id="id_invite" name="id_invite" placeholder="id" class="form-control" value="{{isset($invite)?$invite->id:''}}" required>
                                         <input type="hidden" id="id" name="id" placeholder="id" class="form-control" value="{{isset($passage)?$passage->id:''}}" required>
                                         <div class="col-12 col-md-9">
                                             <input type="date" id="text-input" name="dateArrive" placeholder="" class="form-control" value="{{isset($passage)?$passage->dateArrive:''}}" required>

                                         </div>
                                     </div>
                                     <div class="row form-group">
                                         <div class="col col-md-3">
                                             <label for="text-input" class=" form-control-label">Date de départ </label>
                                         </div>
                                         <div class="col-12 col-md-9">
                                             <input type="date" id="text-input" name="dateDepart" placeholder="" class="form-control" value="{{isset($passage)?$passage->dateDepart:''}}" *>

                                         </div>
                                     </div>
                                 </div>
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Objectif</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="text-input" name="objectif" placeholder="objectif" class="form-control" value="{{isset($passage)?$passage->objectif:''}}">
                                            </div>
                                        </div>
                                        <div class="card-footer pull-right">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fa fa-dot-circle-o"></i>@if(isset($passage)) {{"Modifier"}} @else {{"Enregistrer"}}@endif
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                </form>

                </div>
            </div>
        </div>
        <div class="col-md-12">
            <!-- DATA TABLE -->
            </br>
            <div class="table-responsive table-responsive-data2">
                <table class="table   table-earning" id="table_repertoire">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>DATE D'ARRIVEE</th>
                        <th>DATE DE DEPART</th>
                        <th>OBJECTIF</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invite->passages()->get() as $passage)
                        <tr class="tr-shadow">
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$passage->dateArrive}}</td>
                            <td>{{$passage->dateDepart}}</td>
                            <td>{{$passage->objectif}}</td>
                            <td> <a href="{{route("pmodifier_passage",['id'=>$passage->id])}}"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{route("supprimer_passage",['id'=>$passage->id])}}" class="supprimerpassage"><i class="fa fa-trash" aria-hidden="true"></i></a> </td>
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
            $('.supprimerpassage').click( function (e) {
                //   table.row('.selected').remove().draw( false );
                if(confirm("Voulez vous supprimer le passage ?")){}else{e.preventDefault(); e.returnValue = false; return false; }
            } );
            var table= $('#table_repertoire').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                language: {
                    url: "{{ asset('public/js/French.json')}}"
                },
                "order": [[ 0, "desc" ]],
                "ordering":true,
                "responsive": true,
                "paging": false,
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