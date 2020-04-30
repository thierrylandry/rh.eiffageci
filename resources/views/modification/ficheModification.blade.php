@extends('layouts.app')
@section('pole_demande')
    active
@endsection
@section('pole_demande_block')
    style="display: block;"
@endsection
@section('page')
    <style xmlns:Auth="http://symfony.com/schema/routing">
        .modifie{
            background-color: lightskyblue;
        }

    </style>
    <div class="row">
        <a href="{{route('modification.demande')}}" class="card col-sm-4">
            <div style="color: deepskyblue">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-plus fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Demande</h4>
                </div>
            </div>
        </a>
        <a href="{{route('modification.validation')}}" class="card col-sm-4">
            <div    style="color: deepskyblue">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-clipboard-check fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Validation</h4>
                </div>

            </div>
        </a>
        <a href="{{route('modification.gestion')}}" class="card col-sm-4">
            <div    style="color: deepskyblue">
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
                <h2 class="title-1">MODIFICATION - {{isset($modification)?"MODIFICATION DE LA DEMANDE ":"DEMANDE DE MODIFICATION"}}</h2>
            </div>
        </div>
    </div>
    </br>
    <div class="table-data__tool">
        <div class="table-data__tool-left">
            <div class="table-data__tool  pull-right">
                @if(isset($modification))
                    <div class="table-data__tool-right">
                        <a href="{{route('modification.demande')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>DEMANDER UNE MODIFICATION</a>
                    </div>
                @endif
            </div>
        </div>
        <!--place ici les bouton -->
    </div>
    <div class="row">

        <form action="{{isset($modification)?route('modification.modifier'):route('modification.enregistrer')}}" method="post" enctype="multipart/form-data" class="form-horizontal col-lg-12">
            @csrf
            <input type="hidden" id="text-input" name="id" placeholder="Nom" value="{{isset($modification)? $modification->id:''}}" class="form-control">
            <input type="text"  name="listemodif" id="listemodif" placeholder="Nom" style="display: none"  value="{{isset($listmodif)? str_replace('\u00e9','é',json_encode($listmodif)):''}}" class="form-control" required>

            <div class="card">
                <div class="card-header">
                    <strong>Liste des modifications </strong>
                </div>
                <div class="card-body" id="Ecran_affiche_liste" >
                    @if(isset($listmodif))
                                @foreach($listmodif as $listmodi)
                        <button type='button' class='btn btn-outline-primary'  style='font-size: 10pt!important;'disabled>{{$listmodi}}</button>
                                    @endforeach
                        @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="height: 100% !important">
                        <div class="card-header">
                            <strong>Information employé</strong>
                        </div>
                        <div class="card-body" >
                            <div class="row form-group">

                                <div class="col-12 col-md-4">
                                    <label for="text-input" class=" form-control-label">Personne concernée</label>
                                    <select class="form-control" id="id_personne1" name="id_personne">
                                        <option value="">Selectionner une personne</option>

                                        @foreach($personnes as $personne)
                                            <option value="{{$personne->id}}" {{!isset($modification) && Auth::user()->id_personne==$personne->id?'selected':''}} {{isset($modification) && $modification->id_personne==$personne->id?"selected":""}} >{{$personne->nom }} {{$personne->prenom }}</option>
                                        @endforeach

                                    </select>

                                </div>

                                <div class="col-12 col-md-3">
                                    <label for="text-input" class=" form-control-label">Matricule</label>
                                   <input type="text" name="matricule" id="matricule1" class="form-control" value="{{isset($modification)?$modification->personne->matricule:''}}" readonly/>
                                </div>

                                <div class="col-12 col-md-3">
                                    <label for="text-input" class=" form-control-label">Service</label>
                                    <input type="hidden" id="service1_initial" name="service1_initial" value="">
                                    <select class="form-control  {{isset($listmodif) && in_array('Le service',$listmodif)?'modifie':''}} " id="service1" name="service">
                                        <option value=""></option>
                                        @foreach($services as $service)
                                            <option value="{{$service->id}}" {{isset($modification) && $modification->id_service==$service->id?"selected":Auth::user()->id_service==$service->id?"selected":""}} >{{$service->libelle}}</option>
                                        @endforeach;
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12"   >
                    <div class="card" style="height: 100% !important" >
                        <div class="card-header">
                            <strong>Modification demandée</strong>
                        </div>
                        <div class="card-body" >
                            <div class="row">
                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Fonction</label>
                                    <input type="hidden" id="id_fonction1_initial" name="id_fonction1_initial"  value="">
                                    <select class="form-control {{isset($listmodif) && in_array('La fonction',$listmodif)?'modifie':''}}" name="id_fonction" id="id_fonction1"  required>
                                        <option valuue="">Selectionner une fonction</option>
                                        @foreach($fonctions as $fonction)
                                            <option value="{{$fonction->id}}" {{isset($modification) && $modification->id_fonction==$fonction->id?"selected":""}}>{{$fonction->libelle}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Type de contrat</label>
                                    <input type="hidden" id="id_type_contrat1_initial" name="id_type_contrat1_initial"  value="">
                                    <select class="form-control {{isset($listmodif) && in_array('Le type de contrat',$listmodif)?'modifie':''}}" name="id_type_contrat"  id="id_type_contrat1" required>
                                        <option value="">Sélectionner un type de contrat</option>
                                        @foreach($typecontrats as $typecontrat)
                                            <option value="{{$typecontrat->id}}" {{isset($modification) && $modification->id_type_contrat==$typecontrat->id?"selected":""}}>{{$typecontrat->libelle}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Date de debut de contrat</label>
                                    <input type="date" name="datedebutc" id="datedebutc1" class="form-control " value="{{isset($personne)?$personne->datedebutc:''}}" readonly/>
                                </div>
                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Date de fin de contrat</label>
                                    <input type="hidden" id="datefinc1_initial" name="datefinc1_initial"  value="">
                                    <input type="date" name="datefinc" id="datefinc1" class="form-control  {{isset($listmodif) && in_array('La date de fin',$listmodif)?'modifie':''}}" value="{{isset($personne)?$personne->datefinc:''}}"/>
                                </div>

                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Définition</label>
                                    <input type="hidden" id="dm_id_definition_initial" name="dm_id_definition_initial" value="">
                                    <select class="form-control {{isset($listmodif) && in_array('La définition',$listmodif)?'modifie':''}}" name="id_definition" id="dm_id_definition" required>
                                        <option value="">Sélectionner une définition</option>
                                        @foreach($definitions as $definition)
                                            <option value="{{$definition->id}}" {{isset($modification) && $definition->id==$modification->id_definition?"selected":""}}>{{$definition->libelle}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Catégorie profesionnelle</label>
                                    <input type="hidden" id="dm_id_categorie_initial" name="dm_id_categorie_initial"  value="">
                                    <select class="form-control {{isset($listmodif) && in_array('La catégorie',$listmodif)?'modifie':''}}" name="id_categorie" id="dm_id_categorie">
                                    </select>
                                </div>
                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Régime</label>
                                    <input type="hidden" id="regime1_initial"  name="regime1_initial" value="">
                                    <select class="form-control {{isset($listmodif) && in_array('La durée hebdomadaire de travail',$listmodif)?'modifie':''}}" name="regime" id="regime1"  required>
                                        <option value="">Sélectionner un régime</option>
                                        <option value="40H" {{isset($modification) && $modification->regime=="40H"?'selected':''}}>40H</option>
                                        <option value="44H" {{isset($modification) && $modification->regime=="44H"?'selected':''}}>44H</option>
                                    </select>
                                </div>
                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Budget mensuel / FCFA</label>
                                    <input type="hidden" id="dm_budgetMensuel_initial"  name="dm_budgetMensuel_initial" value="">
                                    <input type="text" name="budgetMensuel" id="dm_budgetMensuel" class="form-control {{isset($listmodif) && in_array('Le budget mensuel',$listmodif)?'modifie':''}}" value="{{isset($modification)? $modification->budgetMensuel:''}}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer pull-right">
                <button type="submit" class="btn {{isset($modification)?"btn-info":"btn-success"}} btn-sm">
                    <i class="zmdi zmdi-edit"></i>{{isset($modification)? "Modifier la demande":'Envoyer la demande'}}
                </button>
                <button type="reset" class="btn btn-danger btn-sm">
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
                    <strong>Mes demandes de modification</strong>
                </div>
                <div class="card-body" >
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderles" id="table_recrutement">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>STATUS</th>
                                <th>TYPE MODIFICATION <MARQUEE > (Ce type peut changer au cours de la procédure à la convenance des RHs)</MARQUEE></th>
                                <th>DEMANDEUR</th>
                                <th>PERSONNE</th>
                                <th>DIRECTION</th>
                                <th>LISTE DES MODIFICATIONS</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($modifications as $modification)
                                <tr>
                                    <td>{{$modification->id}}</td>
                                    <td>    @if($modification->etat==1)
                                            <i class=" fa fa-check-circle-o" style="background-color: red"></i>
                                        @elseif($modification->etat==2)
                                            <i class=" fa fa-check-circle-o" style="background-color: orange"></i>
                                        @elseif($modification->etat==3)
                                            <i class=" fa fa-check-circle-o" style="background-color: green"></i>
                                        @elseif($modification->etat==4)
                                            <i class=" fa fa-check-circle-o" style="background-color: black"></i>
                                        @endif
                                    </td>
                                    <td>@if(isset($modification->id_typeModification) && $modification->id_typeModification==2)
                                            <span style="background-color:#57b846; color:white">Renouvellement</span>
                                        @elseif(isset($modification->id_typeModification) && $modification->id_typeModification==3)
                                            <span style="background-color:#00b5e9;  color:white">Avenant</span>
                                        @endif</td>
                                    <td>{{$modification->user->nom}} {{$modification->user->prenoms}}</td>
                                    <td>{{isset($modification->personne->nom)?$modification->personne->nom:''}} {{isset($modification->personne->prenom)?$modification->personne->prenom:''}} <a href="{{route('fiche_personnel',['slug'=>$modification->personne->slug])}}" target="_blank">Consulter la fiche</a></td>
                                    <td>{{$modification->user->entite->libelle}}</td>
                                    <td>@foreach(json_decode($modification->list_modif) as $modif)
                                            <button type="button" class="btn btn-outline-primary" title="ici" disabled>{{$modif}}</button>
                                    @endforeach
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            @if($modification->etat==1)
                                                <a href="{{route("modification.modification",$modification->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <a  href="{{route("modification.supprimer",$modification->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>


                                            @elseif($modification->etat==2)
                                                <a href="{{route("modification.consulter",$modification->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="zmdi zmdi-eye"></i>
                                                </a>
                                            @elseif($modification->etat==3)

                                                <a href="{{route("modification.consulter",$modification->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="zmdi zmdi-eye"></i>
                                                </a>
                                            @elseif($modification->etat==4)
                                                <a href="{{route("modification.consulter",$modification->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="zmdi zmdi-eye"></i>
                                                </a>
                                                <a href="{{route("modification.supprimer",$modification->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
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
        var listmodifavenant;
        var listmodifeff = new Array();

        @if(isset($listmodif))

                listmodifeff=<?php echo str_replace('\u00e9','é',json_encode($listmodif));?>

        @endif


                @if(!isset($modification) && Auth::user()->hasRole('Ressource_humaine'))
              $('#id_personne1').select2({ placeholder: 'Selectionner une personne'});
                @endif


       // $('#service1').select2();
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
        function vider(){
            $("#service1").val("");
            $("#service1_initial").val("");
            $("#matricule1").val("");
            $("#id_fonction1").val("");
            $("#id_fonction1_initial").val("");
            $("#id_type_contrat1").val("");
            $("#id_type_contrat1_initial").val("");
            $("#datefinc1").val("");
            $("#datefinc1_initial").val("");
            $("#datedebutc1").val("");
            $("#regime1").val("");
            $("#regime1_initial").val("");
            $("#dm_id_definition").val("");
            $("#dm_id_definition_initial").val("");
            $("#dm_id_categorie").val("");
            $('#Ecran_affiche_liste').empty();
            if($(".form-control").hasClass('modifie')){
                $(".form-control").removeClass('modifie')
            }
        }

        auchangement();
function auchangement(){
    vider();
    var id_personne =$('#id_personne1').val();

    $.get('{{URL::asset('modifications/lapersonne_contrat')}}/'+id_personne,function(data){
        console.log(data);
        listmodifavenant=    data['Listmodifavenants'][0];
        console.log(listmodifavenant);
        $("#service1").val(data[0].service);
        $("#service1_initial").val(data[0].service);
        $("#matricule1").val(data[0].matricule);
        $("#id_fonction1").val(data[0].fonction);
        $("#id_fonction1_initial").val(data[0].fonction);
        $("#id_type_contrat1").val(data['lecontrat'][0].id_type_contrat);
        $("#id_type_contrat1_initial").val(data['lecontrat'][0].id_type_contrat);
        $("#datefinc1").val(data[0].datefinc);
        $("#datefinc1_initial").val(data[0].datefinc);
        $("#datedebutc1").val(data[0].datedebutc);
        $("#regime1").val(data[0].regime);
        $("#regime1_initial").val(data[0].regime);
        $("#dm_id_definition").val(data[0].id_definition);
        $("#dm_id_definition_initial").val(data[0].id_definition);

        var tab= $.parseJSON(data[0].valeurSalaire);
        var somme=0;
        $.each(tab,function(index, value ){
            var x=value.valeur;
            somme=somme+ parseInt(x);
        })
        $("#dm_budgetMensuel").val(somme);
        $("#dm_budgetMensuel_initial").val(somme);

        var id_definition=  data[0].id_definition;
        $.get("{{URL::asset('listercat')}}/"+id_definition,function(data){
            console.log(data);
            var lesOptions;
            $.each(data, function( index, value ) {
                lesOptions+="<option value='"+value.libelle+"'>"+value.libelle+"</option>" ;
            });
            $("#dm_id_categorie").empty();
            $("#dm_id_categorie").append(lesOptions);
        });

        $("#dm_id_categorie_initial").val(data[0].id_categorie);
        setTimeout(function(){ $("#dm_id_categorie").val(data[0].id_categorie); }, 1000);


    });
}


        $('#id_personne1').change(function(){
            auchangement();
        });
        $("#dm_id_definition").change(function (e) {
            // alert("test");
            var id_definition=  $("#dm_id_definition").val();
            $.get("{{URL::asset('listercat')}}/"+id_definition,function(data){
                console.log(data);
                var lesOptions;
                $.each(data, function( index, value ) {
                    lesOptions+="<option value='"+value.libelle+"'>"+value.libelle+"</option>" ;
                });
                $("#dm_id_categorie").empty();
                $("#dm_id_categorie").append(lesOptions);
            });

            setTimeout(function(){ $("#dm_id_categorie").val($("#dm_id_categorie_initial").val()); }, 1000);

        });
//exécuter sa au chargement de la page
        @if(isset($modification))
        var id_definition= "{{$modification->id_definition}}"+"ici";
                @else
        var id_definition="";
                        @endif

        $.get("{{URL::asset('listercat')}}/"+id_definition,function(data){

           // console.log(data);
            var lesOptions;
            $.each(data, function( index, value ) {
                lesOptions+="<option value='"+value.libelle+"'>"+value.libelle+"</option>" ;
            });
            $("#dm_id_categorie").empty();
            $("#dm_id_categorie").append(lesOptions);
        });
        var id_personne="{{isset($modification)?$modification->id_personne:''}}";
        $.get("{{URL::asset('modifications/lapersonne_contrat')}}/"+id_personne,function(data){
            console.log(data);
            $("#dm_id_categorie").val(data[0].id_categorie);
            $("#dm_id_categorie_initial").val(data[0].id_categorie);
                }
        );


        //fin
        function affiche_liste_modification(){
            $('#Ecran_affiche_liste').empty();

            var liste="";
            $.each(listmodifeff,function(index,value){
                liste+="<button type='button' class='btn btn-outline-primary'  style='font-size: 10pt!important;'disabled>"+value+"</button>";
            });


                $('#listemodif').val(JSON.stringify(listmodifeff));
                $('#Ecran_affiche_liste').append(liste);
        }
        //changer le type de contrat
        $("#id_type_contrat1").change(function(e){
           var  id_type_contrat1_initial=$("#id_type_contrat1_initial").val();
            var id_type_contrat1= $("#id_type_contrat1").val();
            var removeItem="Le type de contrat";
            if(id_type_contrat1_initial!==id_type_contrat1){
               if(!$(this).hasClass("modifie")){
                   $(this).addClass("modifie");
                   listmodifeff.push(removeItem);
               }
            }else{
                if($(this).hasClass("modifie")){
                    $(this).removeClass("modifie");
                    listmodifeff =jQuery.grep(listmodifeff, function(value) {
                        return value != removeItem;
                    });
                }
            }
            console.log(listmodifeff);
            affiche_liste_modification();
        });
        $("#service1").change(function(e){
            var  variable_initial=$("#service1_initial").val();
            var variable= $("#service1").val();
            var removeItem="Le service";
            if(variable_initial!==variable){
                if(!$(this).hasClass("modifie")){
                    $(this).addClass("modifie");
                    listmodifeff.push(removeItem);
                }
            }else{
                if($(this).hasClass("modifie")){
                    $(this).removeClass("modifie");
                    listmodifeff =jQuery.grep(listmodifeff, function(value) {
                        return value != removeItem;
                    });
                }
            }
            affiche_liste_modification();
        });
        $("#id_fonction1").change(function(e){
            var  variable_initial=$("#id_fonction1_initial").val();
            var variable= $("#id_fonction1").val();
            var removeItem="La fonction";
            if(variable_initial!==variable){
                if(!$(this).hasClass("modifie")){
                    $(this).addClass("modifie");
                    listmodifeff.push(removeItem);
                }
            }else{
                if($(this).hasClass("modifie")){
                    $(this).removeClass("modifie");
                    listmodifeff =jQuery.grep(listmodifeff, function(value) {
                        return value != removeItem;
                    });
                }
            }
            affiche_liste_modification();

        });
        $("#datefinc1").change(function(e){
            var  variable_initial=$("#datefinc1_initial").val();
            var variable= $("#datefinc1").val();
            var removeItem="La date de fin";
            if(variable_initial!==variable){
                if(!$(this).hasClass("modifie")){
                    $(this).addClass("modifie");
                    listmodifeff.push(removeItem);
                }
            }else{
                if($(this).hasClass("modifie")){
                    $(this).removeClass("modifie");
                    $(this).removeClass("modifie");
                    listmodifeff =jQuery.grep(listmodifeff, function(value) {
                        return value != removeItem;
                    });
                }
            }
            affiche_liste_modification();

        });
        $("#dm_id_definition").change(function(e){
            var  variable_initial=$("#dm_id_definition_initial").val();
            var variable= $("#dm_id_definition").val();
            var removeItem="La définition";
            if(variable_initial!==variable){
                if(!$(this).hasClass("modifie")){
                    $(this).addClass("modifie");
                    listmodifeff.push(removeItem);
                    listmodifeff =jQuery.grep(listmodifeff, function(value) {
                        return value != "La catégorie";
                    });
                    listmodifeff.push("La catégorie");

                    //nouveau
                    listmodifeff =jQuery.grep(listmodifeff, function(value) {
                        return value != "Les conditions de rémunérations";
                    });
                    listmodifeff.push("Les conditions de rémunérations");
                }
            }else{
                if($(this).hasClass("modifie")){
                    $(this).removeClass("modifie");
                    listmodifeff =jQuery.grep(listmodifeff, function(value) {
                        return value != removeItem;
                    });
                    if(!$("#dm_budgetMensuel").hasClass("modifie")){
                        //nouveau
                        listmodifeff =jQuery.grep(listmodifeff, function(value) {
                            return value != "Les conditions de rémunérations";
                        });
                        // listmodifeff.push("Les conditions de rémunérations");
                    }
                    if(!$("#dm_id_categorie").hasClass("modifie")){
                        //nouveau
                        listmodifeff =jQuery.grep(listmodifeff, function(value) {
                            return value != "La catégorie";
                        });
                        // listmodifeff.push("Les conditions de rémunérations");
                    }
                }
            }
            affiche_liste_modification();

        });
        $("#dm_id_categorie").change(function(e){
            var  variable_initial=$("#dm_id_categorie_initial").val();
            var variable= $("#dm_id_categorie").val();
            var removeItem="La catégorie";
            if(variable_initial!==variable){
                if(!$(this).hasClass("modifie")){
                    $(this).addClass("modifie");
                   if( $.inArray(removeItem,listmodifeff)==-1){
                       listmodifeff.push(removeItem);
                   }
                    //nouveau
                    listmodifeff =jQuery.grep(listmodifeff, function(value) {
                        return value != "Les conditions de rémunérations";
                    });
                    listmodifeff.push("Les conditions de rémunérations");

                }

            }else{
                if($(this).hasClass("modifie")){
                    $(this).removeClass("modifie");
                    listmodifeff =jQuery.grep(listmodifeff, function(value) {
                        return value != removeItem;
                    });
                    if(!$("#dm_budgetMensuel").hasClass("modifie")){
                        //nouveau
                        listmodifeff =jQuery.grep(listmodifeff, function(value) {
                            return value != "Les conditions de rémunérations";
                        });
                       // listmodifeff.push("Les conditions de rémunérations");
                    }
                }
            }
            affiche_liste_modification();

        });
        $("#regime1").change(function(e){
            var  variable_initial=$("#regime1_initial").val();
            var variable= $("#regime1").val();
            var removeItem="La durée hebdomadaire de travail";
            if(variable_initial!==variable){
                if(!$(this).hasClass("modifie")){
                    $(this).addClass("modifie");
                    listmodifeff.push(removeItem);
                }
            }else{
                if($(this).hasClass("modifie")){
                    $(this).removeClass("modifie");
                    listmodifeff =jQuery.grep(listmodifeff, function(value) {
                        return value != removeItem;
                    });
                }
            }
            affiche_liste_modification();

        });
        $("#dm_budgetMensuel").change(function(e){
            var  variable_initial=$("#dm_budgetMensuel_initial").val();
            var variable= $("#dm_budgetMensuel").val();
            var removeItem="Les conditions de rémunérations";
            if(variable_initial!==variable){
                if(!$(this).hasClass("modifie")){
                    $(this).addClass("modifie");
                    if( $.inArray('Les conditions de rémunérations' , animaux) == -1){
                        listmodifeff.push(removeItem);
                    }

                }
            }else{
                if($(this).hasClass("modifie")){
                    $(this).removeClass("modifie");
                    listmodifeff =jQuery.grep(listmodifeff, function(value) {
                        return value != removeItem;
                    });

                    if(!$("#dm_id_categorie").hasClass("modifie")){
                        //nouveau
                        listmodifeff =jQuery.grep(listmodifeff, function(value) {
                            return value != "Les conditions de rémunérations";
                        });
                        // listmodifeff.push("Les conditions de rémunérations");
                    }
                }
            }
            affiche_liste_modification();

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
        @if(!isset($modification) && isset(Auth::user()->id_personne) && (!Auth::user()->hasRole('Ressource_humaine') || !Auth::user()->hasRole('Chef_de_service')))

        document.getElementById("id_personne1").disabled = true;
        @else document.getElementById("id_personne1").disabled = false;
        @endif
        $("#addcompetence").click(function (e) {
            $($("#competencetemplate").html()).appendTo($("#competences"));
        });
        $("#addtache").click(function (e) {
            $($("#tachetemplate").html()).appendTo($("#taches"));
        });

    </script>
@endsection