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

            @if(isset($invite))
                <a href="{{route('invite')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                    <i class="zmdi zmdi-plus"></i>Ajouter</a>
            @endif
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
                    @if(isset($invite))
                    <form method="post" action="{{route("modifier_invite")}}">
                        @else
                            <form method="post" action="{{route("save_invite")}}">
                        @endif
                        @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Nom *</label>
                        </div>
                        <input type="hidden" id="id" name="id" placeholder="id" class="form-control" value="{{isset($invite)?$invite->id:''}}" required>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="nom" placeholder="Nom" class="form-control" value="{{isset($invite)?$invite->nom:''}}" required>
                        </div>
                    </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Prénoms *</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="prenom" placeholder="Prénoms" class="form-control" value="{{isset($invite)?$invite->prenoms:''}}" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Entreprise</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="entreprise" placeholder="Entreprise" class="form-control" value="{{isset($invite)?$invite->entreprise:''}}" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Surete</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-control" name="surete">
                                    <option value="1" {{isset($invite) && $invite->surete==1?'selected':''}}>OUI</option>
                                    <option value="2" {{isset($invite) && $invite->surete==2?'selected':''}}>NON</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Contact</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="contact" placeholder="Contact" class="form-control" value="{{isset($invite)?$invite->contact:''}}">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">E - mail</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="email" placeholder="E - mail" class="form-control" value="{{isset($invite)?$invite->email:''}}" required>
                            </div>
                        </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label"> Whatsapp </label>
                                    </div>
                                    <!--fin-->
                                    <div class="col-12 col-md-9">
                                        <input type="text"  id="text-input" name="whatsapp" placeholder="whatsapp" class="form-control" value="{{isset($invite)?$invite->whatsapp:''}}">
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Sattelitaire </label>
                                    </div>
                                    <!--fin-->
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="sattelitaire" placeholder="Sattelitaire" class="form-control" value="{{isset($invite)?$invite->sattelitaire:''}}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Adresse :</label>
                                    </div>
                                    <!--fin-->
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="adresse" placeholder="Adresse" class="form-control" value="{{isset($invite)?$invite->adresse:''}}">
                                    </div>
                                </div>
                        <div class="card-footer pull-right">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i>@if(isset($invite)) {{"Modifier"}} @else {{"Enregistrer"}}@endif
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
                        <th>NOM</th>
                        <th>PRENOMS</th>
                        <th>ENTREPRISE</th>
                        <th>SURETE</th>
                        <th>CONTACT</th>
                        <th>WHATSAPP</th>
                        <th>SATTELITAIRE</th>
                        <th>ADRESSE</th>
                        <th>EMAIL</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invites as $invite)
                        <tr class="tr-shadow">
                            <td>{{$invite->nom}}</td>
                            <td>{{$invite->prenoms}}</td>
                            <td>{{$invite->entreprise}}</td>
                            <td>@if($invite->surete==1)
                                OUI
                                    @else
                                    NON
                                @endif</td>
                            <td><i class="fa fa-phone-square" aria-hidden="true"></i> {{$invite->contact}}</td>
                            <td><i class="fa fa-phone-square" aria-hidden="true"></i> {{$invite->whatsapp}}</td>
                            <td><i class="fa fa-phone-square" aria-hidden="true"></i> {{$invite->sattelitaire}}</td>
                            <td><i class="fa fa-home" aria-hidden="true"></i> {{$invite->adresse}}</td>
                            <td><i class="fa fa-envelope" aria-hidden="true"></i> {{$invite->email}}</td>
                            <td><a href="{{route("pmodifier_invite",['id'=>$invite->id])}}"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a> <a href="{{route("supprimer_invite",['id'=>$invite->id])}}" class="supprimerinvite"><i class="fa fa-trash" aria-hidden="true"></i></a>  <a href="{{route("passage_invite",['id'=>$invite->id])}}"><i class="fa Example of anchor fa-anchor" aria-hidden="true"></i>Passages</a> </td>
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
            $('.supprimerinvite').click( function (e) {
                //   table.row('.selected').remove().draw( false );
                if(confirm("Voulez vous supprimer liinvité? Attention la suppression de l'inviter entrainera la suppression en cascade de tout ses passages")){}else{e.preventDefault(); e.returnValue = false; return false; }
            } );
            var date =new Date();
            var table= $('#table_repertoire').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 0,1, 2,3,4,5 ]
                        },
                        text:"Copier",
                        filename: "Liste des invités du "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "Liste des invités du  "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0,1, 2,3,4,5]
                        },
                        text:"Excel",
                        filename: "Liste des invités du "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "Liste des invités du  "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        orientation: 'landscape',

                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0,1, 2,3,4,5 ]
                        },
                        text:"PDF",
                        filename: "Liste des invités du  "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "Liste des invités du  "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        orientation: 'landscape',

                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0,1, 2,3,4,5 ]
                        },
                        text:"Imprimer",
                        filename: "Liste des invités du "+date.getDate()+'-'+(date.getMonth()+1)+'-'+date.getFullYear(),
                        className: 'btn btn-primary btn-sm m-5 width-140 assets-select-btn toolbox-delete-selected',
                        messageTop: "Liste des invités du  "+date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear(),
                        orientation: 'landscape',
                    }
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