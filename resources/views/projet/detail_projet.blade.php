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
                <h2 class="title-1">GESTION DE PROJET</h2>
            </div>
        </div>
    </div>
    <div class="table-data__tool  pull-right">
    </div>
    </br>
    <div class="row">

        <div class="col-sm-12">

            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>Gestion de projet</strong>
                </div>
                <div class="card-body" >

                        <form method="post" action="{{route("modifier_projet")}}" enctype="multipart/form-data">

                                    @csrf
                                    </br>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <img src="{{isset($projet) && $projet->logo!=''? Storage::url('app/images/projet/'.$projet->logo):URL::asset('images/user.png')}}" name="photo" id="rendu_img" alt="" />
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="file" id="photo" name="logo" placeholder="photo" class="form-control">
                                            <input type="hidden" id="id" name="id" placeholder="id" value="{{isset($projet)?$projet->id:''}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Nom *</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text"  name="libelle" id="libelle" placeholder="Nom" class="form-control" value="{{isset($projet)?$projet->libelle:''}}" required>
                                            <small class="form-text text-muted">une chaine de caractère</small>
                                        </div>
                                    </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Civilité *</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text"  name="genre" id="genre" placeholder="Civilité" class="form-control" value="{{isset($projet)?$projet->genre:''}}" required>
                                    <small class="form-text text-muted">une chaine de caractère</small>
                                </div>
                            </div>
                            <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Représentant *</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text"  name="representant" id="representant" placeholder="Représentant" class="form-control" value="{{isset($projet)?$projet->representant:''}}" required>
                                            <small class="form-text text-muted">une chaine de caractère</small>
                                        </div>
                                    </div>
                            <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Description *</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <textarea  name="description" id="description" class="form-control" required style="height: 250px">{{isset($projet)?$projet->description:''}}</textarea>
                                            <small class="form-text text-muted">une chaine de caractère</small>
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