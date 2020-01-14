@extends('layouts.app')
@section('absences.demande')
    active
@endsection
@section('absence')
    style="display: block;"
@endsection
@section('page')
    <style>
        .modifie{
            background-color: lightskyblue;
        }

    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">MODIFICATION - {{isset($absence)?"MODIFICATION DE LA DEMANDE ":"DEMANDE D'ABSENCES"}}</h2>
            </div>
        </div>
    </div>
    </br>
    <div class="table-data__tool">
        <div class="table-data__tool-left">
            <div class="table-data__tool  pull-right">
                @if(isset($absence))
                    <div class="table-data__tool-right">
                        <a href="{{route('absences.demande')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>DEMANDER UNE ABSENCE</a>
                    </div>
                @endif
            </div>
        </div>
        <!--place ici les bouton -->
    </div>
    <div class="row">

        <form action="{{isset($absence)?route('modification.modifier'):route('modification.enregistrer')}}" method="post" enctype="multipart/form-data" class="form-horizontal col-lg-12">
            @csrf
            <input type="hidden" id="text-input" name="id" placeholder="Nom" value="{{isset($absence)? $absence->id:''}}" class="form-control" required>
            <input type="text"  name="listemodif" id="listemodif" placeholder="Nom" style="display: none" value="{{isset($absence)? $absence->slug:''}}" class="form-control" required>

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
                                    <select class="form-control" id="id_personne1" name="id_personne" >
                                        <option value="">Selectionner une personne</option>
                                        @foreach($personnes as $personne)
                                            <option value="{{$personne->id}}" {{isset($absence) && $absence->id_personne==$personne->id?"selected":""}} >{{$personne->nom }} {{$personne->prenom }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="text-input" class=" form-control-label">Matricule</label>
                                   <input type="text" name="matricule" id="matricule1" class="form-control" readonly/>
                                </div>

                                <div class=" col-12 col-md-4">
                                    <label for="text-input" class=" form-control-label">Direction</label>
                                    <input type="hidden" id="id_fonction1_initial"  value="">
                                    <select class="form-control" name="id_fonction" id="id_fonction1" required>
                                        <option value="">Selectionner une fonction</option>
                                        @foreach($entites as $entite)
                                            <option value="{{$entite->id}}" {{isset($absence) && $absence->id_entite==$entite->id?"selected":""}}>{{$entite->libelle}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="text-input" class=" form-control-label">Service</label>
                                    <input type="hidden" id="service1_initial"  value="">
                                    <select class="form-control" id="service1" name="service">
                                        <option value=""></option>
                                        @foreach($services as $service)
                                            <option value="{{$service->id}}" {{isset($absence) && $absence->id_service==$service->id?"selected":Auth::user()->id_service==$service->id?"selected":""}} >{{$service->libelle}}</option>
                                        @endforeach;
                                    </select>
                                </div>

                                <div class=" col-12 col-md-4">
                                    <label for="text-input" class=" form-control-label">Fonction</label>
                                    <input type="hidden" id="id_fonction1_initial"  value="">
                                    <select class="form-control" name="id_fonction" id="id_fonction1" required>
                                        <option value="">Selectionner une fonction</option>
                                        @foreach($fonctions as $fonction)
                                            <option value="{{$fonction->id}}" {{isset($absence) && $absence->id_fonction==$fonction->id?"selected":""}}>{{$fonction->libelle}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class=" col-12 col-md-4">
                                    <label for="text-input" class=" form-control-label">Date d'embauche</label>
                                    <input type="hidden" id="id_fonction1_initial"  value="">
                                    <select class="form-control" name="id_fonction" id="id_fonction1" required>
                                        <option value="">Selectionner une fonction</option>
                                        @foreach($entites as $entite)
                                            <option value="{{$entite->id}}" {{isset($absence) && $absence->id_entite==$entite->id?"selected":""}}>{{$entite->libelle}}</option>
                                        @endforeach
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
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Date de départ souhaité</label>
                                    <input type="date" name="dateDebut" class="form-control" value="{{isset($absence)? $absence->dateDebut:''}}"/>
                                </div>
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Date de retour souhaité</label>
                                    <input type="date" name="dateDebut" class="form-control" value="{{isset($absence)? $absence->dateDebut:''}}"/>
                                </div>
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Date de reprise</label>
                                    <input type="date" name="dateDebut" class="form-control" value="{{isset($absence)? $absence->dateDebut:''}}"/>
                                </div>
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Nombre de jour(s) souhaité(s)</label>
                                    <input type="number" name="dureeMission" class="form-control" value="{{isset($absence)? $absence->dureeMission:''}}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer pull-right">
                <button type="submit" class="btn {{isset($absence)?"btn-info":"btn-success"}} btn-sm">
                    <i class="zmdi zmdi-edit"></i>{{isset($absence)? "Modifier la demande":'Envoyer la demande'}}
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
                    <strong>Mes demandes d'absences</strong>
                </div>
                <div class="card-body" >
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderles" id="table_recrutement">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>STATUS</th>
                                <th>DEMANDEUR</th>
                                <th>DIRECTION</th>
                                <th>LISTE DES MODIFICATIONS</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($absences as $absence)
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
                                    <td>{{$modification->user->nom}} {{$modification->user->prenoms}}</td>
                                    <td>{{$modification->user->entite->libelle}}</td>
                                    <td>@foreach(json_decode($modification->list_modif) as $modif)
                                            <button type="button" class="btn btn-outline-primary" disabled>{{$modif}}</button>
                                    @endforeach
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            @if($modification->etat==1)
                                                <a href="{{route("absence.consulter",$modification->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{route("absence.modification",$modification->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <a  href="{{route("absence.supprimer",$modification->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>


                                            @elseif($modification->etat==2)
                                                <a href="{{route("absence.consulter",$absence->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="zmdi zmdi-eye"></i>
                                                </a>
                                            @elseif($modification->etat==3)

                                                <a href="{{route("absence.consulter",$absence->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="zmdi zmdi-eye"></i>
                                                </a>
                                            @elseif($modification->etat==4)
                                                <a href="{{route("absence.consulter",$absence->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="zmdi zmdi-eye"></i>
                                                </a>
                                                <a href="{{route("absence.supprimer",$absence->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
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
        $('#id_personne1').select2({ placeholder: 'Selectionner une personne'});
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
        $('#id_personne1').change(function(){
            vider();
           var id_personne =$('#id_personne1').val();
            $.get("../modifications/lapersonne_contrat/"+id_personne,function(data){
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
                $.get("../listercat/"+id_definition,function(data){
                    console.log(data);
                    var lesOptions;
                    $.each(data, function( index, value ) {
                        lesOptions+="<option value='"+value.libelle+"'>"+value.libelle+"</option>" ;
                    });
                    $("#dm_id_categorie").empty();
                    $("#dm_id_categorie").append(lesOptions);
                });

                $("#dm_id_categorie").val(data[0].id_categorie);
                $("#dm_id_categorie_initial").val(data[0].id_categorie);

            });
        });
        $("#dm_id_definition").change(function (e) {
            // alert("test");
            var id_definition=  $("#dm_id_definition").val();
            $.get("../listercat/"+id_definition,function(data){
                console.log(data);
                var lesOptions;
                $.each(data, function( index, value ) {
                    lesOptions+="<option value='"+value.libelle+"'>"+value.libelle+"</option>" ;
                });
                $("#dm_id_categorie").empty();
                $("#dm_id_categorie").append(lesOptions);
            });

        });

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