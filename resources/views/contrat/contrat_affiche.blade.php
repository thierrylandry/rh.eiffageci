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
        <div class="col-md-12">
            <div class="overview-wrap">
                <h4 class="title-1">  {{" NOM : ". $personne->nom." ".$personne->prenom}}</h4>
            </div>
            <div class="table-data__tool  pull-right">
                <div class="table-data__tool-right">

                    <a href="{{url()->previous()}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-long-arrow-return"></i>Retour</a>
                </div>&nbsp;
            </div>
        </div>

    </div>


    @if(isset($ancien_contrat))
        <div class="alert alert-warning">Attention les valeurs du dernier contrat sont pré-chargées</div>
    @endif()

    <br>

    @if(isset($contrat))
    <form action="{{route('update_contrat')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @else
            <form action="{{route('save_contrat')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @endif
        @csrf
        <input type="hidden" id="text-input" name="slug" placeholder="Nom" value="{{isset($personne)? $personne->slug:''}}" class="form-control" required>
        <input type="hidden" id="text-input" name="id_contrat" placeholder="Nom" value="{{isset($contrat)? $contrat->id:''}}" class="form-control" required>

        <div class="row">
            <div class="col-sm-6 top-campaign ">

                <div class="">
                    <div class="col-sm-9">
                        <input type="hidden" name="id_nature_contrat" id="id_nature_contrat" value="1">
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Définition :</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control id_definition" name="id_definition" id="id_definition" required>
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
                            <select class="form-control id_categorie" name="id_categorie" id="id_categorie">
                                <option value="">SELECTIONNER</option>
                                @if(isset($categories))
                                    @foreach($categories as $categorie)
                                        <option {{isset($contrat) && $contrat->id_categorie==$categorie->id?'selected':''}} value="{{$categorie->id}}">{{$categorie->libelle}}</option>

                                    @endforeach;
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class=" row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Régime </br>hebdomadaire</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control regime" name="regime" id="regime">
                                <option value="40H">40H</option>
                                <option value="44H">44H</option>
                            </select>
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Matricule :</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="matricule" name="matricule" placeholder="Matricule" class="form-control" value="{{isset($contrat)?$contrat->matricule:''}}" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="text-input" class=" form-control-label">Service :</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="service" id="service" required>
                                <option value="">SELECTIONNER UN SERVICE</option>
                                @foreach($services as $service)
                                    <option {{isset($contrat) && $contrat->id_service==$service->id?'selected':''}} value="{{$service->id}}">{{$service->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="text-input" class=" form-control-label">Couverture maladie:</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="couverture_maladie" id="couverture_maladie">
                                <option value="80" {{isset($contrat) && $contrat->couvertureMaladie=="80"?'selected':''}}>80</option>
                                <option value="80R" {{isset($contrat) && $contrat->couvertureMaladie=="80R"?'selected':''}}>80R</option>
                                <option value="100" {{isset($contrat) && $contrat->couvertureMaladie=="100"?'selected':''}}>100</option>
                                <option value="100M" {{isset($contrat) && $contrat->couvertureMaladie=="100M"?'selected':''}}>100M</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="text-input" class=" form-control-label">Type de contrat :</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="type_de_contrat" id="type_de_contrat1" required>
                                <option value="">SELECTIONNER</option>
                                @foreach($typecontrats as $typecontrat)

                                    <option value="{{$typecontrat->id}}"  {{isset($contrat) && $contrat->id_type_contrat==$typecontrat->id?'selected':''}}>{{$typecontrat->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">E - mail *</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="email" id="email" name="email" placeholder="E - mail" class="form-control" value="{{isset($contrat)?$contrat->email:''}}" >

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
                            <label for="text-input" class=" form-control-label">Date de debut :</label>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="dateDebutC_memoire" class="form-control" value="{{isset($contrat)?$contrat->datedebutc:''}}" />
                            <input type="date" name="dateDebutC" id="dateDebutC" class="form-control" value="{{isset($contrat)?$contrat->datedebutc:''}}"   required/>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Date de fin :</label>
                        </div>
                        <div class="form-group">
                            <input type="date" name="dateFinC" class="form-control" value="{{isset($contrat)?$contrat->datefinc:''}}"/>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Date de fin de la période d'éssai :</label>
                        </div>
                        <div class="form-group">
                            <input type="date" name="periode_essaie" class="form-control" value="{{isset($contrat)?$contrat->periode_essaie:''}}"/>
                        </div>
                    </div>

                    @if(isset($contrat))
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Date de rupture d'essai :</label>
                        </div>
                        <div class="form-group">
                            <input type="date" name="ruptureEssai" value="{{isset($contrat)?$contrat->ruptureEssaie:''}}" class="form-control" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Date depart définitif :</label>
                        </div>
                        <div class="form-group">
                            <input type="date" name="departdefinitif" class="form-control" value="{{isset($contrat) && $contrat->departDefinitif!=''? $newDate = date("Y-m-d",strtotime($contrat->departDefinitif)):''}}" />
                        </div>
                    </div>
                    @endif
                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Date d'induction:</label>
                        </div>
                        <div class="form-group">
                            <input type="date" name="dateInduction" value="{{isset($contrat)?$contrat->dateInduction:''}}" class="form-control"/>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-4">
                            <label for="text-input" class=" form-control-label">Position:</label>
                        </div>
                        <div class="form-group">
                            <select name="position" class="form-control">
                                    <option value="1" {{isset($contrat) && $contrat->position==1 ?'selected':''}}>Chantier</option>
                                    <option value="2" {{isset($contrat) && $contrat->position==2 ?'selected':''}}>Bureau</option>
                                    <option value="3" {{isset($contrat) && $contrat->position==3 ?'selected':''}}>Femme de ménage</option>
                            </select>
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
                                    <form method="post" action="{{route("recrutement.ConditionRemuneration")}}">
                                        @csrf
                                        <input type="hidden" id="slugConditionRemuneration" name="slugConditionRemuneration" value="" />
                                        <div id="rubriques" class="form-inline">
                                            <?php $i=0; ?>
                                            <div class=" form-control-label">
                                                <label for="rubrique[]">Rubrique</label>
                                                <div class="form-group col-sm-12">
                                                    <select type="text" name="rubrique[]"  class="  type_c form-control input-field rubrique" readonly="true" style="width: 260px">
                                                        @if(isset($rubrique_salaires))
                                                            @foreach($rubrique_salaires as $rubrique_salaire)
                                                                <?php $i++?>
                                                                @if($i==1)
                                                                    <option value="{{$rubrique_salaire->libelle}}" {{$i==1?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                                @endif @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-control-label">
                                                <label for="valeur[]">Valeur</label>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-line">
                                                        <input type="text" name="valeur[]" id="Salaire_de_base" class="valeur_c salaire_base form-control" placeholder="Valeur" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr width="100%" color="blue">
                                            <div class=" form-control-label">
                                                <label for="rubrique[]">Rubrique</label>
                                                <div class="form-group col-sm-12">
                                                    <select type="text" name="rubrique[]"  class="type_c form-control input-field" style="width: 260px">
                                                        <?php $i=0; ?>
                                                        @if(isset($rubrique_salaires))
                                                            @foreach($rubrique_salaires as $rubrique_salaire)
                                                                <?php $i++?>
                                                                @if($i==2)
                                                                    <option value="{{$rubrique_salaire->libelle}}" {{$i==2?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-control-label">
                                                <label for="valeur[]">Valeur</label>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-line">
                                                        <input type="text" name="valeur[]" id="Sursalaire" class="valeur_c form-control" placeholder="Valeur" >
                                                    </div>
                                                </div>
                                            </div>
                                            <hr width="100%" color="blue">
                                            <div class=" form-control-label">
                                                <label for="rubrique[]">Rubrique</label>
                                                <div class="form-group col-sm-12">
                                                    <select type="text" name="rubrique[]"  class="type_c form-control input-field" style="width: 260px">
                                                        <?php $i=0; ?>
                                                        @if(isset($rubrique_salaires))
                                                            @foreach($rubrique_salaires as $rubrique_salaire)
                                                                <?php $i++?>
                                                                @if($i==3)
                                                                    <option value="{{$rubrique_salaire->libelle}}" {{$i==3?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-control-label">
                                                <label for="valeur[]">Valeur</label>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-line">
                                                        <input type="text" name="valeur[]" id="Prime_de_salissure" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr width="100%" color="blue">
                                            <div class=" form-control-label">
                                                <label for="rubrique[]">Rubrique</label>
                                                <div class="form-group col-sm-12">
                                                    <select type="text" name="rubrique[]"  class="type_c form-control input-field" style="width: 260px">
                                                        <?php $i=0; ?>
                                                        @if(isset($rubrique_salaires))
                                                            @foreach($rubrique_salaires as $rubrique_salaire)
                                                                <?php $i++?>
                                                                @if($i==4)
                                                                    <option value="{{$rubrique_salaire->libelle}}" {{$i==4?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-control-label">
                                                <label for="valeur[]">Valeur</label>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-line">
                                                        <input type="text" name="valeur[]" id="Prime_de_tenue_de_travail" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr width="100%" color="blue">
                                            <div class=" form-control-label">
                                                <label for="rubrique[]">Rubrique</label>
                                                <div class="form-group col-sm-12">
                                                    <select type="text" name="rubrique[]"  class="type_c form-control input-field" style="width: 260px">
                                                        <?php $i=0; ?>
                                                        @if(isset($rubrique_salaires))
                                                            @foreach($rubrique_salaires as $rubrique_salaire)
                                                                <?php $i++?>
                                                                @if($i==5)
                                                                    <option value="{{$rubrique_salaire->libelle}}" {{$i==5?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-control-label">
                                                <label for="valeur[]">Valeur</label>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-line">
                                                        <input type="text" name="valeur[]" id="Prime_de_transport" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr width="100%" color="blue">
                                            </br>

                                        </div>
                                        <h5>Rubrique Additionnelle</h5>
                                        <div id="rubriques_petit" class="form-inline">

                                        </div>
                                        Ajouter une rubrique salariale
                                        <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addrubrique">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </button>
                                        <div id="rubriquetemplate" class="row clearfix" style="display: none">

                                            <div class=" form-control-label">
                                                <label for="rubrique[]">Rubrique</label>
                                                <div class="form-group col-sm-12">
                                                    <select type="text" name="rubrique[]" class="type_c form-control input-field">
                                                        <?php $i=0?>
                                                        @if(isset($rubrique_salaires))
                                                            @foreach($rubrique_salaires as $rubrique_salaire)
                                                                <?php $i++;?>
                                                                @if($i>=6)
                                                                    <option value="{{$rubrique_salaire->libelle}}">{{$rubrique_salaire->libelle}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-control-label">
                                                <label for="valeur[]">Valeur</label>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-line">
                                                        <input type="text" name="valeur[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr width="100%" color="blue">
                                        </div>
                                        <div class="modal-footer">
                                            </br>
                                            <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                Enregistrer</button>
                                        </div>
                                    </form>

                            </div>
                        </div>
                    </div>

                </div>
                </br>
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
    function envoie_liste_categorie(){
        var id_definition=  $(".id_definition").val();
        $.get("../listercat/"+id_definition,function(data){
            console.log(data);
            var lesOptions;
            $.each(data, function( index, value ) {
                lesOptions+="<option value='"+value.id+"'>"+value.libelle+"</option>" ;
            });
            $(".id_categorie").empty();
            $(".id_categorie").append(lesOptions);
            //  $("#id_categorie").trigger("chosen:updated");

        });
    }
    $(".id_definition").change(function (e) {
        envoie_liste_categorie();
        //  alert("ddd");
    });
</script>
@endsection