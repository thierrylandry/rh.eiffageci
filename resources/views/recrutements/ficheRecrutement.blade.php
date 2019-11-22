@extends('layouts.app')
@section('recrutement.demande')
    active
@endsection
@section('recrutements')
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
       <!--place ici les bouton -->
    </div>
    <form action="{{route('recrutement.enregistrer')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <input type="hidden" id="text-input" name="slug" placeholder="Nom" value="{{isset($recrutement)? $recrutement->slug:''}}" class="form-control" required>

        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="height: 100% !important">
                    <div class="card-header">
                       <strong> Information</strong>
                    </div>
                    <div class="card-body" >
                        <div class="row form-group">
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Poste à pouvoir *</label>
                                <input type="text" id="posteAPouvoir" name="posteAPouvoir" placeholder="Entrer le poste à pouvoir" class="form-control">
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Entite *</label>
                                <select class="form-control" id="id_entite" name="id_entite"  >
                                    @foreach($entites as $entite)
                                        <option value="{{$entite->id}}" {{Auth::user()->id_service==$entite->id?"selected":""}}>{{$entite->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-4">
                                <label for="text-input" class=" form-control-label">Service</label>
                                <select class="form-control" id="service" name="service">
                                    <option value=""></option>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}" {{Auth::user()->id_service==$service->id?"selected":""}}>{{$service->libelle}}</option>
                                        @endforeach;
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Descriptif de la fonction</label>
                            </div>
                            <div class="col-12 col-md-9">
                               <textarea class="form-control" name="descriptifFonction"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6"   >
                <div class="card" style="height: 100% !important" >
                    <div class="card-header">
                        <strong>Compétence recherchées</strong>
                    </div>
                    <div class="card-body card-block">
                        Ajouter une compétence
                        <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addcompetence">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>
                        </br>
                        </br>
                        <div id="competences" class="form-inline">

                            <div class="form-control-label">
                                <div class="form-group col-sm-6">
                                    <div class="form-line">
                                         <input type="text" name="competences[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('competences[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                        </div>
                        <div id="competencetemplate" class="row clearfix" style="display: none">

                            <div class="form-control-label">
                               <div class="form-group col-sm-6">
                                    <div class="form-line">
                                       <input type="text" name="competences[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('competences[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6"   >
                <div class="card" style="height: 100% !important" >
                    <div class="card-header">
                        <strong>Responsabilités ou tâches</strong>
                    </div>
                    <div class="card-body card-block">
                        Ajouter une Responsabilité ou une tâche
                        <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addtache">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>
                        </br>
                        </br>
                        <div id="taches" class="form-inline">

                            <div class="form-control-label">

                                <div class="form-group col-sm-6">
                                    <div class="form-line">
                                         <input type="text" name="taches[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('taches[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                        </div>
                        <div id="tachetemplate" class="row clearfix" style="display: none">

                            <div class="form-control-label">
                                <div class="form-group col-sm-6">
                                    <div class="form-line">
                                       <input type="text" name="taches[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('taches[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="height: 100% !important">
                    <div class="card-header">
                        <strong>Contrat</strong>
                    </div>
                    <div class="card" style="height: 100% !important">
                        <div class="card-body" >
                        <div class="row">
                           <div class=" col-lg-4">
                               <label for="text-input" class=" form-control-label">Type de contrat *</label>
                               <select class="form-control" name="id_type_contrat" required>
                                   @foreach($typecontrats as $typecontrat)
                                       <option value="{{$typecontrat->id}}">{{$typecontrat->libelle}}</option>
                                   @endforeach
                               </select>
                            </div>
                            <div class=" col-lg-4">
                               <label for="text-input" class=" form-control-label">Date de debut</label>
                               <input type="date" name="dateDebut" class="form-control" />
                            </div>
                            <div class=" col-lg-4">
                               <label for="text-input" class=" form-control-label">Durée de mission</label>
                               <input type="text" name="dureeMission" class="form-control" />
                            </div>
                            <div class=" col-lg-4">
                                <label for="text-input" class=" form-control-label">Budget mensuel / FCFA</label>
                                <input type="text" name="budgetMensuel" class="form-control" />
                            </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="height: 100% !important">
                    <div class="card-header">
                        <strong>Condition de rémunération</strong>
                    </div>
                    <div class="card-body" >
                        <div class="row">
                            <div class=" col-lg-3">
                                <label for="text-input" class=" form-control-label">Définition</label>
                                <select class="form-control" name="id_definition">
                                    @foreach($definitions as $definition)
                                        <option value="{{$definition->id}}">{{$definition->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" col-lg-3">
                                <label for="text-input" class=" form-control-label">Catégorie professionnelle</label>
                                <select class="form-control" name="id_categorie">
                                        @if(isset($categories))
                                            @foreach($categories as $categorie)
                                                <option  value="{{$categorie->id}}">{{$categorie->libelle}}</option>
                                            @endforeach;
                                        @endif
                                </select>
                            </div>
                            <div class=" col-lg-3">
                                <label for="text-input" class=" form-control-label">Régime hebdomadaire</label>
                                <select class="form-control" name="regime" id="regime">
                                    <option value="0">40H</option>
                                    <option value="1">44H</option>
                                </select>
                            </div>
                            <div class=" col-lg-3">
                                <label for="text-input" class=" form-control-label">Salaire de base</label>
                                <input type="text" name="salaireBase" class="form-control" />
                            </div>
                            <div class=" col-lg-3">
                                <label for="text-input" class=" form-control-label">Sursalaire</label>
                                <input type="text" name="surSalaire" class="form-control" />
                            </div>
                            <div class=" col-lg-3">
                                <label for="text-input" class=" form-control-label">Prime de transport</label>
                                <input type="text" name="primeTp" class="form-control" />
                            </div>
                            <div class=" col-lg-3">
                                <label for="text-input" class=" form-control-label">Total brut</label>
                                <input type="text" name="totalBrute" class="form-control" />
                            </div>
                            <div class=" col-lg-3">
                                <label for="text-input" class=" form-control-label">Total net (avec 1 part d'IG)</label>
                                <input type="text" name="totalnet1part" class="form-control" />
                            </div>
                            <div class=" col-lg-3">
                                <label for="text-input" class=" form-control-label">Total net (...parts d'IGR)</label>
                                <input type="text" name="totalnetparts" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="height: 100% !important">
                    <div class="card-header">
                        <strong>Avantage/Dotation (mensuel)</strong>
                    </div>
                    <div class="card-body" >
                        <div class="row">
                            <div class=" col-lg-3">
                                <label>Téléphone portable</label>
                                <select class="form-control" name="telephone_portable" id="telephone_portable">
                                    <option value=""></option>
                                    <option value="0">non</option>
                                    <option value="1">oui</option>
                                </select>
                            </div><div class=" col-lg-3">
                                <label>Forfait</label>
                                <select class="form-control" name="forfait" id="forfait">
                                    <option value=""></option>
                                    @foreach($forfaits as $forfait)
                                        <option value="{{$forfait->libelle}}">{{$forfait->libelle}}</option>
                                        @endforeach
                                </select>
                            </div><div class=" col-lg-3">
                                <label>Débit internet</label>
                                <select class="form-control" name="debit_internet" id="debit_internet">
                                    <option value=""></option>
                                    @foreach($debit_internets as $debit_internet)
                                        <option value="{{$debit_internet->libelle}}">{{$debit_internet->libelle}}</option>
                                    @endforeach
                                </select>
                            </div><div class=" col-lg-3">
                                <label>Assurence maladie</label>
                                <select class="form-control" name="assurance_maladie" id="assurance_maladie">
                                    <option value=""></option>
                                    @foreach($assurance_maladies as $assurance_maladie)
                                        <option value="{{$assurance_maladie->libelle}}">{{$assurance_maladie->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer pull-right">
            <button type="submit" class="btn btn-success btn-sm">
                <i class="zmdi zmdi-edit"></i> Envoyer la demande
            </button>
            <button type="reset" class="btn btn-danger btn-sm" id="reset">
                <i class="fa fa-ban"></i> Réinitialiser
            </button>
        </div>
    </form>
    <script src="{{ asset("vendor/jquery-3.2.1.min.js") }}"></script>

    <script src="{{  URL::asset("vendor/select2/select2.min.js") }}"></script>
    <script>
        $('#telephone_portable').select2({ placeholder: 'Selectionner un téléphone portable'});
        $('#forfait').select2({ placeholder: 'Selectionner un forfait'});
        $('#debit_internet').select2({ placeholder: 'Selectionner un debit internet'});
        $('#assurance_maladie').select2({ placeholder: 'Selectionner un assurance maladie'});
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
    </script>
    <script type="application/javascript">
        $("#addcompetence").click(function (e) {
            $($("#competencetemplate").html()).appendTo($("#competences"));
        });
        $("#addtache").click(function (e) {
            $($("#tachetemplate").html()).appendTo($("#taches"));
        });

    </script>
@endsection