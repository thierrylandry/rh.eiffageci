@extends('layouts.app')
@section('document_administratif')
    active
@endsection
@section('document_administratif_block')
    style="display: block;"
@endsection
@section('page')
    <style>
        .steps-form-2 {
            display: table ;
            width: 100%;
            position: relative; }
        .steps-form-2 .steps-row-2 {
            display: table-row; }
        .steps-form-2 .steps-row-2:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 2px;
            background-color: #7283a7; }
        .steps-form-2 .steps-row-2 .steps-step-2 {
            display: table-cell;
            text-align: center;
            position: relative; }
        .steps-form-2 .steps-row-2 .steps-step-2 p {
            margin-top: 0.5rem; }
        .steps-form-2 .steps-row-2 .steps-step-2 button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important; }
        .steps-form-2 .steps-row-2 .steps-step-2 .btn-circle-2 {
            width: 70px;
            height: 70px;
            border: 2px solid #59698D;
            background-color: white !important;
            color: #59698D !important;
            border-radius: 50%;
            padding: 22px 18px 15px 18px;
            margin-top: -22px; }
        .steps-form-2 .steps-row-2 .steps-step-2 .btn-circle-2:hover {
            border: 2px solid #4285F4;
            color: #4285F4 !important;
            background-color: white !important; }
        .steps-form-2 .steps-row-2 .steps-step-2 .btn-circle-2 .fa {
            font-size: 1.7rem; }

    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">CONTRAT - ETABLISSEMENT</h2>
            </div>
        </div>
    </div>
    </br>
    <div class="row">
        <div class="col-sm-12">
            <h2 class="text-center font-bold pt-4 pb-5 mb-5"><strong>Etape 3</strong></h2>

            <!-- Stepper -->
            <div class="steps-form-2">
                <div class="steps-row-2 setup-panel-2 d-flex justify-content-between">
                    <div class="steps-step-2 active" >
                        <button href="#step-1" type="button" style="background-color: gainsboro !important;"  class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Basic Information"><i class="fa fa-user" aria-hidden="true"></i></button>
                    </div>
                    <div class="steps-step-2">
                        <button disabled type="button" style="background-color: gainsboro!important;" class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Personal Data"><i class="fa fa-folder" aria-hidden="true"></i></button>
                    </div>
                    <div class="steps-step-2">
                        <button href="#step-3" type="button"  class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Terms and Conditions"><i class="fa fa-file-text" aria-hidden="true"></i></button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </br>
    <form action="{{route('save_contrat')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <input type="hidden" id="text-input" name="slug" placeholder="Nom" value="{{isset($personne)? $personne->slug:''}}" class="form-control" required>

        <div class="row">
            <div class="col-sm-6 top-campaign ">

                <div class="">
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Nature de contrat :</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control" name="id_nature_contrat" id="id_nature_contrat" required>
                                <option value="">SELECTIONNER</option>
                                @foreach($nature_contrats as $nature_contrat)
                                    <option {{isset($contrat) && $contrat->id_nature_contrat==$nature_contrat->id?'selected':''}} value="{{$nature_contrat->id}}">{{$nature_contrat->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Définition* :</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control" name="id_definition" id="id_definition" required>
                                <option value="">SELECTIONNER</option>
                                @foreach($definitions as $definition)
                                    <option {{isset($contrat) && $contrat->id_definition==$definition->id?'selected':''}} value="{{$definition->id}}">{{$definition->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Catégorie :</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control" name="id_categorie" id="id_categorie">
                                <option value="">SELECTIONNER</option>
                                @if(isset($categories))
                                    @foreach($categories as $categorie)
                                        <option {{isset($contrat) && $contrat->id_categorie==$categorie->id?'selected':''}} value="{{$categorie->id}}">{{$categorie->libelle}}</option>

                                    @endforeach;
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Matricule* :</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="text-input" name="matricule" placeholder="Matricule" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Service* :</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="service" required>
                                <option value="">SELECTIONNER UN SERVICE</option>
                                @foreach($services as $service)
                                    <option value="{{$service->id}}">{{$service->libelle}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="text-input" class=" form-control-label">Couverture maladie:</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="couverture_maladie">
                                <option value="80">80</option>
                                <option value="80R">80R</option>
                                <option value="100">100</option>
                                <option value="100M">100M</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="text-input" class=" form-control-label">Type de contrat* :</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="type_de_contrat" required>
                                <option value="">SELECTIONNER</option>
                                @foreach($typecontrats as $typecontrat)

                                    <option value="{{$typecontrat->id}}">{{$typecontrat->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">E - mail *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="email" id="email" name="email" placeholder="E - mail" class="form-control" value="{{isset($contrat)?$contrat->email:''}}">

                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Contact *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="contact" name="contact" placeholder="Contact" class="form-control" value="{{isset($contrat)?$contrat->contact:''}}">

                        </div>
                    </div>

                </div>


            </div>
            <div class="col-sm-6 top-campaign ">

                <div class="">
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Date de debut* :</label>
                        </div>
                        <div class="form-group">
                            <input type="date" name="dateDebutC" class="form-control" required/>
                        </div>
                    </div>


                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Date de fin :</label>
                        </div>
                        <div class="form-group">
                            <input type="date" name="dateFinC" class="form-control"/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Date de fin de la période d'éssai :</label>
                        </div>
                        <div class="form-group">
                            <input type="date" name="periode_essaie" class="form-control"/>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Position:</label>
                        </div>
                        <div class="form-group">
                            <select name="position" class="form-control">
                                <option value="1">Chantier</option>
                                <option value="2">Bureau</option>
                                <option value="3">Femme de ménage</option>
                            </select>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="card-footer pull-right">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="zmdi zmdi-edit"></i> Enregistrer
            </button>
            <button type="reset" class="btn btn-danger btn-sm" id="reset">
                <i class="fa fa-ban"></i> Réinitialiser
            </button>
        </div>
    </form>
    <script src="{{ asset("js/jquery.min.js") }}"></script>
    <script>
        $("#id_definition").change(function (e) {
            var id_definition=  $("#id_definition").val();
            $.get("../rh.eiffageci/listercat/"+id_definition,function(data){
                console.log(data);
                var lesOptions;
                $.each(data, function( index, value ) {
                    lesOptions+="<option value='"+value.id+"'>"+value.libelle+"</option>" ;
                });
                $("#id_categorie").empty();
                $("#id_categorie").append(lesOptions);
                //  $("#id_categorie").trigger("chosen:updated");

            });
            //  alert("ddd");
        })
    </script>
@endsection