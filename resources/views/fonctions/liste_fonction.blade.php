@extends('layouts.app')
@section('fonction')
    active
@endsection
@section('fonction_block')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">GESTION DES FONCTIONS</h2>
            </div>
        </div>
    </div>
    <div class="table-data__tool  pull-right">
        <div class="table-data__tool-right">

            @if(isset($fonction))
                <a href="{{route('fonctions')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                    <i class="zmdi zmdi-plus"></i>Ajouter</a>
            @endif
        </div>&nbsp;
    </div>
    </br>
    <div class="row">

        <div class="col-sm-12">

            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>Ajouter une fonction</strong>
                </div>
                <div class="card-body" >
                    @if(isset($fonction))
                        <form method="post" action="{{route("modifier_fonction")}}">
                            @else
                                <form method="post" action="{{route("save_fonction")}}">
                                    @endif
                                    @csrf
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">libelle *</label>
                                        </div>
                                        <input type="hidden" id="id" name="id" placeholder="id" class="form-control" value="{{isset($fonction)?$fonction->id:''}}" required>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="text-input" name="libelle" placeholder="libelle" class="form-control" value="{{isset($fonction)?$fonction->libelle:''}}" required>
                                        </div>
                                    </div>
                                    <div class="card-footer pull-right">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i>@if(isset($fonction)) {{"Modifier"}} @else {{"Enregistrer"}}@endif
                                        </button>
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
                        <th>LIBELLE</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fonctions as $fonction)
                        <tr class="tr-shadow">
                            <td>{{$fonction->libelle}}</td>
                            <td><a href="{{route("pmodifier_fonction",['id'=>$fonction->id])}}"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
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
            $('.supprimerfonction').click( function (e) {
                //   table.row('.selected').remove().draw( false );
                if(confirm("Voulez vous supprimer la fonction?")){}else{e.preventDefault(); e.returnValue = false; return false; }
            } );
            var table= $('#table_repertoire').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                language: {
                    url: "{{ asset('public/js/French.json')}}"
                },
                "order": [[ 1, "desc" ]],
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