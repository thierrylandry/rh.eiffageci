@extends('layouts.app')
@section('pole_demande')
    active
@endsection
@section('pole_demande_block')
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
                <h2 class="title-1">CONGES - {{isset($conge)?"MODIFICATION DE LA DEMANDE ":"DEMANDE D'ABSENCES"}}</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <a href="{{route('conges.demande')}}" class="card col-sm-4">
            <div style="color: orange">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-plus fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Demande</h4>
                </div>
            </div>
        </a>
        <a href="{{route('conges.validation')}}" class="card col-sm-4">
            <div   style="color: orange">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-clipboard-check fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Validation</h4>
                </div>

            </div>
        </a>
        <a href="{{route('conges.gestion')}}" class="card col-sm-4">
        <div    style="color: orange">
            <div class="card-body" style="text-align: center;">
                <i class="fas fa-list-ol fa-3x"></i>
                </br></br>
                <h4 class="card-title mb-3">Gestion</h4>
            </div>

        </div>
        </a>
    </div>
    </br>
    <div class="table-data__tool">
        <div class="table-data__tool-left">
            <div class="table-data__tool  pull-right">
                @if(isset($conge))
                    <div class="table-data__tool-right">
                        <a href="{{route('conges.demande')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>DEMANDER UN CONGE</a>
                    </div>
                @endif
            </div>
        </div>
        <!--place ici les bouton -->
    </div>
    <div class="row">

        <form action="{{isset($conge)?route('conges.modifier'):route('conges.enregistrer')}}" method="post" class="form-horizontal col-lg-12">
            @csrf
            <input type="hidden" id="text-input" name="id" placeholder="Nom" value="{{isset($conge)? $conge->id:''}}" class="form-control">

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
                                    @if(isset($conge))
                                        <input class="form-control" value="{{$conge->personne->nom." ".$conge->personne->prenom}}" disabled/>
                                    @elseif(!isset($conge) && isset(Auth::user()->id_personne) && !Auth::user()->hasRole('Ressource_humaine'))
                                        <input type="text" class="form-control" value="{{isset(Auth::user()->id_personne)?Auth::user()->nom.' '.Auth::user()->prenoms:''}}" disabled/>
                                        <input type="hidden" id="id_personne1" name="id_personne" value="{{isset(Auth::user()->id_personne)?Auth::user()->id_personne:''}}" />
                                    @elseif(!isset($conge) && Auth::user()->hasRole('Ressource_humaine'))
                                        <select class="form-control" id="id_personne1" name="id_personne">
                                            <option value="">Selectionner une personne</option>

                                            @foreach($personnes as $personne)
                                                <option value="{{$personne->id}}" {{!isset($conge) && Auth::user()->id_personne==$personne->id?'selected':''}} {{isset($conge) && $conge->id_personne==$personne->id?"selected":""}} >{{$personne->nom }} {{$personne->prenom }}</option>
                                            @endforeach

                                        </select>
                                    @endif
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="text-input" class=" form-control-label">Matricule</label>
                                   <input type="text" name="matricule" id="matricule1" class="form-control" value="{{isset($conge)?$conge->personne->matricule:''}}" readonly/>
                                </div>

                                <div class=" col-12 col-md-4">
                                    <label for="text-input" class=" form-control-label">Direction</label>
                                    <input class="form-control" name="id_entite" id="id_entite" value="{{isset($conge)?$conge->personne->entite->libelle:''}}" readonly/>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="text-input" class=" form-control-label">Service</label>
                                    <input class="form-control" id="serviceabs" name="serviceabs" value="{{ isset($conge)?$conge->personne->contrat_renouvelles->where('etat','=',1)->first()->service->libelle:''}}" readonly/>
                                </div>

                                <div class=" col-12 col-md-4">
                                    <label for="text-input" class=" form-control-label">Fonction</label>
                                    <input class="form-control" name="id_fonction" id="id_fonctionabs" value="{{isset($conge)?$conge->personne->fonction()->first()->libelle:''}}" readonly/>
                                </div>

                                <div class=" col-12 col-md-4">
                                    <label for="text-input" class=" form-control-label">Date d'embauche</label>
                                    <input type="date" class="form-control" name="dateEmbauhe" id="dateEmbauhe" value="{{isset($conge)?$conge->personne->contrat_renouvelles->where('etat','=',1)->first()->datedebutc:''}}" readonly/>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="text-input" class=" form-control-label">Adresse pendant les congés</label>
                                    <input type="text" name="adresse_pd_conges" id="adresse_pd_conges" class="form-control" value="{{isset($conge)?$conge->adresse_pd_conges:''}}" required/>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="text-input" class=" form-control-label">Contact téléphonique</label>
                                    <input type="text" name="contact_telephonique" id="contact_telephonique" class="form-control" value="{{isset($conge)?$conge->contact_telephonique:''}}"/>
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
                            <strong>Information</strong>
                        </div>
                        <div class="card-body" >
                            <div class="row">
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Nombre de jour de congés acquis</label>
                                    <input class="form-control" id="nbrjouracqui" name="nbrjouracqui" value="" readonly/>
                                </div>
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Nombre de jour de congé accordé</label>
                                    <input class="form-control" id="nbrjouraccorde" name="nbrjouraccorde" value="" readonly/>
                                </div>
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Date de retour dernier congés</label>
                                    <input type="date" id="dateretourdernierconges"  class="form-control" value="{{isset($conge)? $conge->jour:''}}" required readonly/>
                                </div>
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Date de reprise dernier congés</label>
                                    <input type="date" id="datereprisedernierconges"  class="form-control" value="{{isset($conge)? $conge->jour:''}}" required readonly/>
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
                            <strong>Congé demandée</strong>
                        </div>
                        <div class="card-body" >
                            <div class="row">
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Motif de la demande</label>
                                    <select class="form-control" id="id_motif_demande" name="id_motif_demande" required>
                                        <option value="">Selectionner une motif</option>
                                        @foreach($type_motifs as $type_motif)
                                            <option value="{{$type_motif->id}}" {{isset($conge) && $conge->id_motif_demande==$type_motif->id?"selected":""}} >{{$type_motif->libelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-lg-3">
                                     Solde

                                    <label class="switch switch-text switch-success">
                                        <input type="checkbox" name="solde" class="switch-input" checked="{{isset($conge)&& $conge->solde=1?1:0}}">
                                        <span data-on="OUI" data-off="NON" class="switch-label" style="font-weight: bold"></span>

                                    </label>
                                </div>
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Nombre de jour(s) souhaité(s)</label>
                                    <input type="number" name="jour" id="jour" class="form-control" value="{{isset($conge)? $conge->jour:''}}" required readonly/>
                                </div>

                            </div>
                            <div class="row">
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Date de départ souhaité</label>
                                    <input type="date" name="debut" id="debut" class="form-control date" value="{{isset($conge)? $conge->debut:''}}" required/>
                                </div>
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Date de fin souhaité</label>
                                    <input type="date" name="fin" id="fin" class="form-control date" value="{{isset($conge)? $conge->fins:''}}" required/>
                                </div>
                                <div class=" col-lg-3">
                                    <label for="text-input" class=" form-control-label">Date de reprise</label>
                                    <input type="date" name="reprise" id="reprise" class="form-control" value="{{isset($conge)? $conge->reprise:''}}" required/>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer pull-right">
                <button type="submit" class="btn {{isset($conge)?"btn-info":"btn-success"}} btn-sm">
                    <i class="zmdi zmdi-edit"></i>{{isset($conge)? "Modifier la demande":'Envoyer la demande'}}
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
                    <strong>Mes demandes de congés</strong>
                </div>
                <div class="card-body" >
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderles" id="table_recrutement">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>STATUS</th>
                                <th>SOLDE</th>
                                <th>MOTIF DE LA DEMANDE</th>
                                <th>DEMANDEUR</th>
                                <th>TITULAIRE</th>
                                <th>DATE DE DEPART SOUHAITE</th>
                                <th>DATE DE FIN SOUHAITE</th>
                                <th>DATE DE REPRISE</th>
                                <th>NOMBRE DE JOUR</th>
                                <th>ADRESSE PENDANT LES CONGES</th>
                                <th>CONTACT TELEPHONIQUE</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($conges as $conge)
                                <tr>
                                    <td>{{$conge->id}}</td>
                                    <td>    @if($conge->etat==1)
                                            <i class=" fa fa-check-circle-o" style="background-color: red"></i>
                                        @elseif($conge->etat==2)
                                            <i class=" fa fa-check-circle-o" style="background-color: orange"></i>
                                        @elseif($conge->etat==3)
                                            <i class=" fa fa-check-circle-o" style="background-color: green"></i>
                                        @elseif($conge->etat==4)
                                            <i class=" fa fa-check-circle-o" style="background-color: black"></i>
                                        @endif
                                        {{isset($conge->type_permission)?$conge->type_permission->libelle:''}}
                                    </td>
                                    <td> <label class="switch switch-text switch-success"><input type="checkbox"class="switch-input" @if($conge->solde==1)checked @endif >
                                            <span data-on="OUI" data-off="NON" class="switch-label" style="font-weight: bold"></span></label></td>
                                    <td>{{$conge->Type_conge->libelle}}</td>
                                    <td>{{$conge->user->nom}} {{$conge->user->prenoms}}</td>
                                    <td>{{isset($conge->personne->nom)?$conge->personne->nom:''}} {{isset($conge->personne->prenom)?$conge->personne->prenom:''}}</td>
                                    <td>{{$conge->debut}}</td>
                                    <td>{{$conge->fin}}</td>
                                    <td>{{$conge->reprise}}</td>
                                    <td>{{$conge->jour}}</td>
                                    <td>{{$conge->adresse_pd_conges}}</td>
                                    <td>{{$conge->contact_telephonique}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            @if($conge->etat==1)
                                                <a href="{{route("conges.modification",$conge->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <a  href="{{route("conges.supprimer",$conge->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>


                                            @elseif($conge->etat==2)

                                            @elseif($conge->etat==3)

                                            @elseif($conge->etat==4)
                                                <a href="{{route("conges.supprimer",$conge->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
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
        @if(!isset($modification) && Auth::user()->hasRole('Ressource_humaine'))
         $('#id_personne1').select2({ placeholder: 'Selectionner une personne'});
                @endif
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

            $("#matricule1").val("");
            $("#id_fonction1").val("");
            $("#id_type_contrat1").val("");
            $("#datefinc1").val("");
            $("#datedebutc1").val("");
            $("#regime1").val("");
            $("#dm_id_definition").val("");
            $("#dm_id_categorie").val("");
            $('#Ecran_affiche_liste').empty();
            if($(".form-control").hasClass('modifie')){
                $(".form-control").removeClass('modifie')
            }
        }
        auchangement();
        function   auchangement(){
            vider();
            var id_personne =$('#id_personne1').val();
            var route="{{asset('')}}";
            $.get(route+"/modifications/lapersonne_contrat/"+id_personne,function(data){
                console.log(data);
                listmodifavenant=    data['Listmodifavenants'][0];
                console.log(listmodifavenant);
                $("#serviceabs").val( data['leservice'][0].libelle);
                $("#matricule1").val(data[0].matricule);
                $("#id_fonctionabs").val( data['lafonction'][0].libelle);
                $("#id_entite").val(data[0].id_entite);
                $("#dateEmbauhe").val(data[0].datedebutc);

            });

            $.get(route+"/conges/information_conges_prec/"+id_personne,function(data){
                console.log(data);
                $("#nbrjouracqui").val( data['nombrecongesAqui']);
                $("#nbrjouraccorde").val( data['nombrecongesAccorde']);
                $("#dateretourdernierconges").val( data['dernierconge'].fins);
                $("#datereprisedernierconges").val( data['dernierconge'].reprise);
            });
        }
        $('#id_personne1').change(function(){
            auchangement();
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
        $(".date").change(function (e) {

            var debut=new Date($("#debut").val());
            var fin=new Date($("#fin").val());

            $('#reprise').val($("#fin").val());
// end - start returns difference in milliseconds
            var diff = new Date(fin - debut);

// get days
            var days = diff/1000/60/60/24;

            console.log(days);
            $('#jour').val(days);
        });
        $("#addtache").click(function (e) {
            $($("#tachetemplate").html()).appendTo($("#taches"));
        });

    </script>
@endsection