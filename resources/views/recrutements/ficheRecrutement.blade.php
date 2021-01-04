@extends('layouts.app')
@section('pole_demande')
    active
@endsection
@section('pole_demande_block')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <a href="{{route('recrutement.demande')}}" class="card col-sm-4">
            <div  style="color: green">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-plus fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Demande</h4>
                </div>
            </div>
        </a>
        <a href="{{route('recrutement.validation')}}" class="card col-sm-4">
            <div    style="color: green">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-clipboard-check fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Validation</h4>
                </div>

            </div>
        </a>
        <a href="{{route('recrutement.gestion')}}" class="card col-sm-4">
            <div    style="color: green">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-list-ol fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Gestion</h4>
                </div>

            </div>
        </a>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">RECRUTEMENT - {{isset($recrutement)?"MODIFICATION DE LA DEMANDE ":"DEMANDE DE PERSONNEL"}}</h2>
            </div>
        </div>
    </div>
    </br>
    <div class="table-data__tool">
        <div class="table-data__tool-left">
            <div class="table-data__tool  pull-right">
                @if(isset($recrutement))
                    <div class="table-data__tool-right">
                        <a href="{{route('recrutement.demande')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>DEMANDER UN RECRUTEMENT</a>
                    </div>
                @endif
            </div>
        </div>
       <!--place ici les bouton -->
    </div>
<div class="row">

    <form action="{{isset($recrutement)?route('recrutement.modifier'):route('recrutement.enregistrer')}}" method="post" enctype="multipart/form-data" class="form-horizontal col-lg-12">
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
                            <div class="col-12 col-md-3">
                                <label for="text-input" class=" form-control-label">Poste à pouvoir *</label>
                                <input type="text" id="posteAPouvoir" name="posteAPouvoir" placeholder="Entrer le poste à pouvoir" class="form-control" value="{{isset($recrutement)?$recrutement->posteAPouvoir:""}}">
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="text-input" class=" form-control-label">Nombre de personne</label>
                                <input class="form-control" type="number" min="1" value="{{isset($recrutement)?$recrutement->NbrePersonne:1}}" id="nombre_personne" name="nombre_personne"/>

                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="col-12 col-md-3">
                                <label for="text-input" class=" form-control-label">Entite *</label>
                                <select class="form-control" id="id_entite" name="id_entite" >
                                    @foreach($entites as $entite)
                                        <option value="{{$entite->id}}" {{isset($recrutement) && $recrutement->id_entite==$entite->id?"selected":Auth::user()->id_entite==$entite->id?"selected":""}} >{{$entite->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-3">
                                <label for="text-input" class=" form-control-label">Service</label>
                                <select class="form-control" id="service" name="service">
                                    <option value=""></option>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}" {{isset($recrutement) && $recrutement->id_service==$service->id?"selected":Auth::user()->id_service==$service->id?"selected":""}} >{{$service->libelle}}</option>
                                    @endforeach;
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Descriptif de la fonction</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <textarea class="form-control" name="descriptifFonction">{{isset($recrutement)?$recrutement->descriptifFonction:""}}</textarea>
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
                            @if(isset($competences))
                                @foreach($competences as $keyCompetence => $competence)
                            <div class="form-control-label">
                                <div class="form-group col-sm-6">
                                    <div class="form-line">
                                        <input type="text" name="competences[]" class="valeur_c form-control" placeholder="Valeur" value="{{ isset($competence)?$competence->valeur:old('competences[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                                @endforeach
                                @endif
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
                            @if(isset($taches))
                                @foreach($taches as $keyTache =>$tache)
                            <div class="form-control-label">

                                <div class="form-group col-sm-6">
                                    <div class="form-line">
                                        <input type="text" name="taches[]" class="valeur_c form-control" placeholder="Valeur" value="{{ isset($tache)?$tache->valeur:old('taches[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                                @endforeach
                                @endif
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
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Type de contrat *</label>
                                    <select class="form-control" name="id_type_contrat" required>
                                        @foreach($typecontrats as $typecontrat)
                                            <option value="{{$typecontrat->id}}" {{isset($recrutement) && $recrutement->id_type_contrat==$typecontrat->id?"selected":""}}>{{$typecontrat->libelle}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Date de debut</label>
                                    <input type="date" name="dateDebut" class="form-control" value="{{isset($recrutement)? $recrutement->dateDebut:''}}"/>
                                </div>
                                <div class=" col-lg-1">
                                    <label for="text-input" class=" form-control-label">Durée</label>
                                    <input type="number" name="dureeMission" class="form-control" value="{{isset($recrutement)? $recrutement->dureeMission:''}}"/>
                                </div>
                                <div class=" col-lg-2">
                                    <label for="text-input" class=" form-control-label">Unité</label>
                                    <select class="form-control" name="id_uniteJour" required>
                                        @foreach($uniteJours as $uniteJour)
                                            <option value="{{$uniteJour->id}}" {{isset($recrutement) && $recrutement->id_unite==$uniteJour->id?"selected":""}}>{{$uniteJour->libelle}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Budget mensuel / FCFA</label>
                                    <input type="text" name="budgetMensuel" class="form-control" value="{{isset($recrutement)? $recrutement->budgetMensuel:''}}"/>
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
                        <strong>Avantage/Dotation (mensuel)</strong>
                    </div>
                    <div class="card-body" >
                        <div class="row">
                            <div class=" col-lg-3">
                                <label>Téléphone portable</label>
                                <select class="form-control" name="telephone_portable" id="telephone_portable">
                                    <option value="0" {{isset($recrutement)&& $recrutement->telephone_portable==0?"selected":""}} >non</option>
                                    <option value="1" {{isset($recrutement)&& $recrutement->telephone_portable==1?"selected":""}}>oui</option>
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
            <button type="submit" class="btn {{isset($recrutement)?"btn-info":"btn-success"}} btn-sm">
                <i class="zmdi zmdi-edit"></i>{{isset($recrutement)? "Modifier la demande":'Envoyer la demande'}}
            </button>
            <button type="reset" class="btn btn-danger btn-sm" id="reset">
                <i class="fa fa-ban"></i> Réinitialiser
            </button>
        </div>
    </form>

</div>
</br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>Mes demandes de recrutement</strong>
                </div>
                <div class="card-body" >
            <div class="table-responsive m-b-40">
                <table class="table table-borderles" id="table_recrutement">
                    <thead>
                    <tr>
                        <th>slug</th>
                        <th>STATUS</th>
                        <th>NUMERO</th>
                        <th>DEMANDEUR</th>
                        <th>DIRECTION</th>
                        <th>SERVICE</th>
                        <th>POSTE</th>
                        <th>CONTRAT</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($recrutements as $recrutement)
                        <tr>
                            <td>{{$recrutement->slug}}</td>
                            <td>    @if($recrutement->etat==1)
                                    <i class=" fa fa-check-circle-o" style="background-color: red"></i>
                                @elseif($recrutement->etat==2)
                                    <i class=" fa fa-check-circle-o" style="background-color: orange"></i>
                                @elseif($recrutement->etat==3)
                                    <i class=" fa fa-check-circle-o" style="background-color: green"></i>
                                @elseif($recrutement->etat==4)
                                    <i class=" fa fa-check-circle-o" style="background-color: black"></i>
                                @endif
                            </td>
                            <td>{{$recrutement->id}}</td>
                            <td>{{$recrutement->user->nom}} {{$recrutement->user->prenoms}}</td>
                            <td>{{$recrutement->user->entite->libelle}}</td>
                            <td>{{$recrutement->user->service->libelle}}</td>
                            <td>{{$recrutement->posteAPouvoir}}</td>
                            <td>{{$recrutement->type_contrat->libelle}}</td>
                            <td>
                                <div class="table-data-feature">
                                    @if($recrutement->etat==1)
                                        <a href="{{route("recrutement.consulter",$recrutement->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{route("recrutement.modification",$recrutement->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a  href="{{route("recrutement.supprimer",$recrutement->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>


                                    @elseif($recrutement->etat==2)
                                        <a href="{{route("recrutement.consulter",$recrutement->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-eye"></i>
                                        </a>
                                    @elseif($recrutement->etat==3)

                                        <a href="{{route("recrutement.consulter",$recrutement->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-eye"></i>
                                        </a>
                                    @elseif($recrutement->etat==4)
                                        <a href="{{route("recrutement.consulter",$recrutement->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-eye"></i>
                                        </a>
                                        <a href="{{route("recrutement.supprimer",$recrutement->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
                </div>
            </div>
        </div>
    </div>
            <!-- END DATA TABLE -->


    <script src="{{ asset("vendor/jquery-3.2.1.min.js") }}"></script>

    <script src="{{  URL::asset("vendor/select2/select2.min.js") }}"></script>
    <script>
        $('#id_entite').select2({ placeholder: 'Selectionner une entite'});
        $("#id_entite").prop("readonly", true);
        $('#service').select2({ placeholder: 'Selectionner un service'});
        $("#service").prop("readonly", true);
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
        $(document).ready(function() {
            var table= $('#table_recrutement').DataTable({
                "order": [[ 0, "desc" ]],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                language: {
                    url: "{{ asset('public/js/French.json')}}"
                },

                "ordering":true,
                "responsive": true,
                "paging": false,
                "createdRow": function( row, data, dataIndex){

                },
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ]
            }).column(0).visible(false);
            //table.DataTable().draw();
        } );
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