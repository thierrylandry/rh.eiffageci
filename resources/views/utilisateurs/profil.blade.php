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
                <h2 class="title-1">Mon compte</h2>
            </div>
        </div>
    </div>
    </br>
    <div class="row">

        <div class="col-sm-12">

            <div class="card" style="height: 100% !important">
                <div class="card-header">
                </div>
                <div class="card-body" >
                        <form method="post" action="{{route("modifier_user_profil")}}" enctype="multipart/form-data">
                        @csrf
                            <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="domaine">Personne</label>
                            </div>
                            </div>
                            </br>
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
                                <input type="text"  name="nom" id="nom" placeholder="Nom" class="form-control" value="{{isset($utilisateur)?$utilisateur->nom:''}}" required>
                                <small class="form-text text-muted">une chaine de caractère</small>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Prénoms *</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text"  name="prenom" id="prenom" placeholder="Prénoms" class="form-control" value="{{isset($utilisateur)?$utilisateur->prenoms:''}}" required>
                                <small class="form-text text-muted">une chaine de caractère</small>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">E-mail</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text"  name="email" id="email" placeholder="E-mail" class="form-control" value="{{isset($utilisateur)?$utilisateur->email:''}}" readonly>
                            </div>
                        </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                <label for="domaine">Les Roles</label>
                                    </div>
                            <div class="col-12 col-md-9">
                                    <ol>
                                        @foreach($roles as $role)
                                            @if(isset($utilisateur) and $utilisateur->hasRole($role->name))
                                                <li>{{$role->description}}</li>
                                            @endif

                                        @endforeach
                                    </ol>
                            </div>
                            </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="domaine">Entité en charge</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <ol>
                                            @foreach($entites as $entite)
                                                    <li >{{$entite->libelle}} </li>
                                            @endforeach
                                        </ol>
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

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">L'entité *</label>
                                </div>
                                <div class="col-12 col-md-9">
                                        <ul>
                                        @foreach($entites as $entite)
                                            @if(isset($utilisateur) && $utilisateur->id_entite==$entite->id)
                                            <li>{{$entite->libelle}}</li>
                                                @endif
                                        @endforeach
                                        </ul>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Service</label>
                                </div>
                                <div class="col-12 col-md-9">
                                        <ul>
                                            @foreach($services as $service)
                                                @if(isset($utilisateur) && $utilisateur->id_service==$service->id)
                                                    <li>{{$service->libelle}}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                </div>
                            </div>
                        <div class="card-footer pull-right">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i>{{"Modifier"}}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
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
            $('#personne').on('change',function (e) {
                var personne= $('#personne').val();
                $.get("{{URL::asset('lapersonne')}}/"+personne,function(data){

                    if(data==""){
                        alert("Cette personne n'a pas de contrat actif");
                    }
                    $('#nom').val(data.nom);
                    $('#prenom').val(data.prenom);
                    $('#id_service').val(data.service);
                    $('#id_entite').val(data.id_entite);
                });
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
            var $personne= $('#personne').select2({ placeholder: 'Selectionner une personne'});
            var $selectrole= $('#roles').select2({ placeholder: 'Selectionner le(s) rôle(s)'});
            var $selectchantier= $('#id_entite_en_charge').select2({ placeholder: 'Selectionner le(s) entite(s)'});
            $("#checkbox").click(function(){

                if($("#checkbox").is(':checked') ){
                    $("#roles > option").prop("selected","selected");
                }else{
                    $("#roles > option").removeAttr("selected");
                }
                $selectrole.trigger('change');
            });
            $("#checkbox2").click(function(){

                if($("#checkbox2").is(':checked') ){
                    $("#id_entite_en_charge > option").prop("selected","selected");
                }else{
                    $("#id_entite_en_charge > option").removeAttr("selected");
                }
                $selectchantier.trigger('change');
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