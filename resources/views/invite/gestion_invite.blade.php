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
                <h2 class="title-1">GESTION DES INVITES</h2>
            </div>
        </div>
    </div>
    <div class="table-data__tool  pull-right">
        <div class="table-data__tool-right">

            <a href="{{route('lister_personne')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-long-arrow-return"></i>Retour</a>
        </div>&nbsp;
    </div>
    </br>
    <div class="row">

        <div class="col-sm-12">

            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>Ajouter un invité</strong>
                </div>
                <div class="card-body" >
                    <form meethod="post" action="{{route("save_invite")}}">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Nom *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="nom" placeholder="Nom" class="form-control" required>
                            <small class="form-text text-muted">une chaine de caractère</small>
                        </div>
                    </div>
                    </form>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Prénoms *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="prenom" placeholder="Prénoms" class="form-control" required>
                            <small class="form-text text-muted">une chaine de caractère</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Entreprise</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="contact" placeholder="contact" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Surete</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select class="form-control">
                                <option value="1">OUI</option>
                                <option value="2">NON</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Contact</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="contact" placeholder="contact" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">E - mail</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="email" placeholder="E - mail" class="form-control" required>
                            <small class="form-text text-muted">une chaine de caractère</small>
                        </div>
                    </div>
                    </div>
                </div>
        </div>
        <div class="col-md-12">
            <!-- DATA TABLE -->

            <div class="table-responsive table-responsive-data2">
                <table class="table  table-earning" id="table_repertoire">
                    <thead>
                    <tr>
                        <th>NOM</th>
                        <th>PRENOMS</th>
                        <th>ENTREPRISE</th>
                        <th>SURETE</th>
                        <th>CONTACT</th>
                        <th>EMAIL</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invietes as $inviete)
                        <tr class="tr-shadow">
                            <td>{{$inviete->nom}}</td>
                            <td>{{$inviete->prenoms}}</td>
                            <td>{{$inviete->entreprise}}</td>
                            <td>@if($inviete->surete==1)
                                OUI
                                    @else
                                    NON
                                @endif</td>
                            <td><i class="fa fa-phone-square" aria-hidden="true"></i> {{$inviete->contact}}</td>
                            <td><i class="fa fa-envelope" aria-hidden="true"></i> {{$inviete->email}}</td>
                            <td><i class="fa Example of anchor fa-anchor" aria-hidden="true"></i><a href="#">Ajouter passage</a> </td>
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
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                language: {
                    url: "{{ asset('public/js/French.json')}}"
                },
                "order": [[ 1, "desc" ]],
                "ordering":true,
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