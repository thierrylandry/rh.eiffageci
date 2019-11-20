@extends('layouts.app')
@section('detail_personne')
    active
@endsection
@section('detail_personne_block')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">RECRUTEMENT - DEMANDE DE PERSONNEL</h2>
            </div>
        </div>
    </div>
    </br>
    <div class="table-data__tool">
        <div class="table-data__tool-left">
        </div>
        <div class="table-data__tool-right">
            <a href="" class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-plus"></i>AJOUTER PERSONNE</a>
            <a href="" class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-view-list"></i>LISTER LES PERSONNES</a>
        </div>
    </div>
    <form action="{{route('modifier_personne')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <input type="hidden" id="text-input" name="slug" placeholder="Nom" value="{{isset($personne)? $personne->slug:''}}" class="form-control" required>

        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="height: 100% !important">
                    <div class="card-header">
                       <strong> Information</strong>
                    </div>
                    <div class="card-body" >
                        <div class="row form-group">
                            <div class="col-12 col-md-6">
                                <label for="text-input" class=" form-control-label">Poste à pouvoir *</label>
                                <input type="text" id="company" placeholder="Entrer le poste à pouvoir" class="form-control">
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="col-12 col-md-6">
                                <label for="text-input" class=" form-control-label">Entite *</label>
                                <select class="form-control">
                                    @foreach($entites as $entite)
                                        <option value="{{$entite->id}}">{{$entite->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Descriptif de la fonction</label>
                            </div>
                            <div class="col-12 col-md-9">
                               <textarea class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </br>
        <div class="row">
            <div class="col-sm-6"   >
                <div class="card" style="height: 100% !important" >
                    <div class="card-header">
                        <strong>Compétence recherchées</strong>
                    </div>
                    <div class="card-body card-block">
                        Ajouter une compétence
                        <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addpiece">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>
                        </br>
                        </br>
                        <div id="pieces" class="form-inline">

                            <div class="form-control-label">
                                <div class="form-group col-sm-6">
                                    <div class="form-line">
                                         <input type="text" name="num_p_piece[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                        </div>
                        <div id="piecetemplate" class="row clearfix" style="display: none">

                            <div class="form-control-label">
                               <div class="form-group col-sm-6">
                                    <div class="form-line">
                                       <input type="text" name="num_p_piece[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('valeur_c[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6"   >
                <div class="card" style="height: 100% !important" >
                    <div class="card-header">
                        <strong>Responsabilités ou tâches</strong>
                    </div>
                    <div class="card-body card-block">
                        Ajouter une Responsabilité ou une tâche
                        <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addpiece">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>
                        </br>
                        </br>
                        <div id="pieces" class="form-inline">

                            <div class="form-control-label">

                                <div class="form-group col-sm-6">
                                    <div class="form-line">
                                         <input type="text" name="num_p_piece[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                        </div>
                        <div id="piecetemplate" class="row clearfix" style="display: none">

                            <div class="form-control-label">
                                <div class="form-group col-sm-6">
                                    <div class="form-line">
                                       <input type="text" name="num_p_piece[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('valeur_c[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </br>

        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="height: 100% !important">
                    <div class="card-body" >
                        <div class="col-12 col-md-6">
                            <label for="text-input" class=" form-control-label">Type de contrat *</label>
                            <select class="form-control">
                                @foreach($typecontrats as $typecontrat)
                                    <option value="{{$typecontrat->id}}">{{$typecontrat->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer pull-right">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="zmdi zmdi-edit"></i> Modifier
            </button>
            <button type="reset" class="btn btn-danger btn-sm" id="reset">
                <i class="fa fa-ban"></i> Réinitialiser
            </button>
        </div>
    </form>
    <script src="{{ asset("vendor/jquery-3.2.1.min.js") }}"></script>

    <script src="{{  URL::asset("vendor/select2/select2.min.js") }}"></script>
    <script>
        $('#commune').select2({ placeholder: 'Selectionner une commune'});
        var dob = new Date($('#datenaissancet').val());
        var today = new Date();
        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#age').html('Age : '+age+' Ans');
        $("#datenaissancet").change(function(e){
            var dob = new Date($('#datenaissancet').val());
            var today = new Date();
            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
            $('#age').html('Age : '+age+' Ans');
        });
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
                            $('#rendu_img').attr('src','../images/user.png');
                        }
                    }else{
                        alert('le ficher doit être de type jpeg ou png exclusivement');

                        input.value='';
                        $('#rendu_img').attr('src','../images/user.png');
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
        $("#reset").click(function() {
            $('#rendu_img').attr('src','images/user.png');
        });
    </script>
    <script type="application/javascript">
        $("#addfamille").click(function (e) {
            $($("#familletemplate").html()).appendTo($("#familles"));
        });
        $("#addpiece").click(function (e) {
            $($("#piecetemplate").html()).appendTo($("#pieces"));
        });
    </script>
@endsection