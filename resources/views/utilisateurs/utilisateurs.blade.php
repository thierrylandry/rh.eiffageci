@extends('layouts.app')
@section('utilisateur')
    active
@endsection
@section('utilisateur_block')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">GESTION DES UTILISATEURS</h2>
            </div>
        </div>
    </div>
    <div class="table-data__tool  pull-right">
        <div class="table-data__tool-right">
            @if(isset($utilisateur))
                <a href="{{route('utilisateur')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                    <i class="zmdi zmdi-plus"></i>Ajouter</a>
            @endif
            <a href="{{route('lister_personne')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-long-arrow-return"></i>Retour</a>
        </div>&nbsp;
    </div>
    </br>
    <div class="row">

        <div class="col-sm-12">

            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>Gestion utilisateur</strong>
                </div>
                <div class="card-body" >
                    @if(isset($utilisateur))
                        <form method="post" action="{{route("modifier_user")}}" enctype="multipart/form-data">
                        @else
                        <form method="post" action="{{route("save_user")}}" enctype="multipart/form-data">

                        @endif
                        @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <img src="{{isset($utilisateur) && $utilisateur->photo!=''? Storage::url('app/images/users/'.$utilisateur->photo):URL::asset('images/user.png')}}" name="photo" id="rendu_img" alt="" />
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="photo" name="photo" placeholder="photo" class="form-control">
                                <input type="hidden" id="id" name="id" placeholder="id" value="{{isset($utilisateur)?$utilisateur->id:''}}" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Nom *</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="nom" placeholder="Nom" class="form-control" value="{{isset($utilisateur)?$utilisateur->nom:''}}" required>
                                <small class="form-text text-muted">une chaine de caractère</small>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Prénoms *</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="prenom" placeholder="Prénoms" class="form-control" value="{{isset($utilisateur)?$utilisateur->prenoms:''}}" required>
                                <small class="form-text text-muted">une chaine de caractère</small>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">E-mail</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="email" placeholder="E-mail" class="form-control" value="{{isset($utilisateur)?$utilisateur->email:''}}" required>
                            </div>
                        </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                <label for="domaine">Les Roles</label>
                                    </div>
                            <div class="col-12 col-md-9">
                                <select class="form-control " id="roles" name="roles[]"  multiple required >
                                    @foreach($roles as $role)
                                        @if(isset($utilisateur) and $utilisateur->hasRole($role->name))
                                            <option value="{{$role->name}}" selected>{{$role->description}}</option>
                                        @else
                                            <option value="{{$role->name}}" >{{$role->description}}</option>
                                        @endif

                                    @endforeach
                                </select>
                                <input type="checkbox" id="checkbox" >Selectionner Tout
                            </div>
                            </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Mot de passe</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="password" id="mdp" name="password" placeholder="Mot de passe" value="{{isset($utilisateur)?$utilisateur->password:''}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Confirmer mot de passe</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="password" id="confmdp" name="confmdp" placeholder="Confirmer mot de passe" class="form-control" value="{{isset($utilisateur)?$utilisateur->password:''}}" required>
                            </div>
                        </div>
                        <div class="card-footer pull-right">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i>@if(isset($utilisateur)) {{"Modifier"}} @else {{"Enregistrer"}}@endif
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
                <table class="table   table-earning" id="table_utilisateur">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>NOM</th>
                        <th>PRENOMS</th>
                        <th>EMAIL</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($utilisateurs as $utilisateur)
                        <tr class="tr-shadow">
                            <td>{{$utilisateur->id}}</td>
                            <td>{{$utilisateur->nom}}</td>
                            <td>{{$utilisateur->prenoms}}</td>
                            <td>{{$utilisateur->email}}</td>
                            <td>
                                <a href="{{route('supprimer_utilisateur',['id'=>$utilisateur->id])}}"  class="btn btn-danger col-sm-4 pull-right">
                                    <i class=" fa fa-trash"></i>
                                </a>
                                <a href="{{route('modifier_utilisateur',['id'=>$utilisateur->id])}}"  class="btn btn-info col-sm-4 pull-right">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
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

    <script src="{{ asset("js/select2.full.js") }}"></script>
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

            $('#confmdp').on('change',function (e) {
                var  confmdp=$('#confmdp').val();
                var  mdp=$('#mdp').val();
                if(mdp!=confmdp){
                    $('#confmdp').val('');
                }
            });
            var table= $('#table_utilisateur').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
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
            }).column(0).visible(false);
            //table.DataTable().draw();
            var $selectrole= $('#roles').select2({ placeholder: 'Selecctionner le(s) rôle(s)'});
            $("#checkbox").click(function(){

                if($("#checkbox").is(':checked') ){
                    $("#roles > option").prop("selected","selected");
                }else{
                    $("#roles > option").removeAttr("selected");
                }
                $selectrole.trigger('change');
            });
        } );
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    console.log(input.files[0]);
                    console.log(input.files[0].type);
                    if(input.files[0].type=="image/jpeg" || input.files[0].type=="image/png" ){
                        if(input.files[0].size<=1000024){

                            console.log('cool');
                            $('#rendu_img').attr('src', e.target.result);
                        }else{
                            alert('trop volumineux');

                            input.value='';
                            $('#rendu_img').attr('src','images/user.png');
                        }
                    }else{
                        alert('le ficher doit être de type jpeg ou png exclusivement');

                        input.value='';
                        $('#rendu_img').attr('src','images/user.png');
                    }


                }

                reader.readAsDataURL(input.files[0]);

            }else{
                $('#rendu_img').attr('src','images/user.png');
            }
        }

        $("#photo").change(function() {
            readURL(this);
        });

    </script>

@endsection