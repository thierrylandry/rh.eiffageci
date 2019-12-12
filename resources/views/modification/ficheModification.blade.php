@extends('layouts.app')
@section('modification.demande')
    active
@endsection
@section('modifications')
    style="display: block;"
@endsection
@section('page')
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
                        <a href="{{route('modifications.demande')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
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
            <input type="hidden" id="text-input" name="slug" placeholder="Nom" value="{{isset($modification)? $modification->slug:''}}" class="form-control" required>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="height: 100% !important">
                        <div class="card-header">
                            <strong>Information employé</strong>
                        </div>
                        <div class="card-body" >
                            <div class="row form-group">

                                <div class="col-12 col-md-6">
                                    <label for="text-input" class=" form-control-label">Personne concernée</label>
                                    <select class="form-control" id="id_personne1" name="id_personne" >
                                        <option value=""></option>
                                        @foreach($personnes as $personne)
                                            <option value="{{$personne->id}}" {{isset($modification) && $modification->id_personne==$personne->id?"selected":Auth::user()->id_entite==$personne->id?"selected":""}} >{{$personne->nom }} {{$personne->prenom }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12 col-md-3">
                                    <label for="text-input" class=" form-control-label">Matricule</label>
                                   <input type="text" name="matricule" id="matricule1" class="form-control" readonly/>
                                </div>

                                <div class="col-12 col-md-3">
                                    <label for="text-input" class=" form-control-label">Service</label>

                                    <select class="form-control" id="service1" name="service">
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
                                    <select class="form-control" name="id_fonction" id="id_fonction1" required>
                                        @foreach($fonctions as $fonction)
                                            <option value="{{$fonction->id}}" {{isset($modification) && $modification->id_fonction==$fonction->id?"selected":""}}>{{$fonction->libelle}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Type de contrat</label>
                                    <input type="hidden" id="id_type_contrat1_initial"  value="{{isset($modification)?$modification->id_type_contrat:""}}">
                                    <select class="form-control" name="id_type_contrat"  id="id_type_contrat1" required>
                                        @foreach($typecontrats as $typecontrat)
                                            <option value="{{$typecontrat->id}}" {{isset($modification) && $modification->id_type_contrat==$typecontrat->id?"selected":""}}>{{$typecontrat->libelle}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Date de debut de contrat</label>
                                    <input type="date" name="datedebutc" id="datedebutc1" class="form-control" value="{{isset($modification)? $modification->datedebutc:''}}" readonly/>
                                </div>
                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Date de fin de contrat</label>
                                    <input type="date" name="datefinc1" id="datefinc1" class="form-control" value="{{isset($modification)? $modification->datefinc:''}}"/>
                                </div>

                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Définition</label>
                                    <select class="form-control" name="id_definition" id="dm_id_definition" required>
                                        @foreach($definitions as $definition)
                                            <option value="{{$definition->id}}" {{isset($definition) && $definition->id_categorie==$definition->id?"selected":""}}>{{$definition->libelle}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Catégorie profesionnelle</label>
                                    <select class="form-control" name="id_categorie" id="dm_id_categorie" required>
                                    </select>
                                </div>
                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Régime</label>
                                    <select class="form-control" name="regime" id="regime1" required>
                                        <option value="40H">40H</option>
                                        <option value="44H">44H</option>
                                    </select>
                                </div>
                                <div class=" col-lg-4">
                                    <label for="text-input" class=" form-control-label">Budget mensuel / FCFA</label>
                                    <input type="text" name="budgetMensuel" id="dm_budgetMensuel" class="form-control" value="{{isset($modification)? $modification->budgetMensuel:''}}"/>
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
                            @foreach($modifications as $modification)
                                <tr>
                                    <td>{{$modification->slug}}</td>
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
                                    <td>{{$modification->id}}</td>
                                    <td>{{$modification->user->nom}} {{$modification->user->prenoms}}</td>
                                    <td>{{$modification->user->entite->libelle}}</td>
                                    <td>{{$modification->user->service->libelle}}</td>
                                    <td>{{$modification->posteAPouvoir}}</td>
                                    <td>{{$modification->type_contrat->libelle}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            @if($modification->etat==1)
                                                <a href="{{route("modification.consulter",$modification->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{route("modification.modification",$modification->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <a  href="{{route("modification.supprimer",$modification->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>


                                            @elseif($modification->etat==2)
                                                <a href="{{route("modification.consulter",$modification->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="zmdi zmdi-eye"></i>
                                                </a>
                                            @elseif($modification->etat==3)

                                                <a href="{{route("modification.consulter",$modification->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="zmdi zmdi-eye"></i>
                                                </a>
                                            @elseif($modification->etat==4)
                                                <a href="{{route("modification.consulter",$modification->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                    <i class="zmdi zmdi-eye"></i>
                                                </a>
                                                <a href="{{route("modification.supprimer",$modification->slug)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
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
        $('#id_personne1').change(function(){
           var id_personne =$('#id_personne1').val();
            $.get("../modifications/lapersonne_contrat/"+id_personne,function(data){
                console.log(data);
                listmodifavenant=    data['Listmodifavenants'][0];
                console.log(listmodifavenant);
                $("#service1").val(data[0].service);
                $("#matricule1").val(data[0].matricule);
                $("#id_fonction1").val(data[0].fonction);
                $("#id_type_contrat1").val(data['lecontrat'][0].id_type_contrat);
                $("#id_type_contrat1_initial").val(data['lecontrat'][0].id_type_contrat);
                $("#datefinc1").val(data[0].datefinc);
                $("#datedebutc1").val(data[0].datedebutc);
                $("#regime1").val(data[0].regime);
                $("#dm_id_definition").val(data[0].id_definition);

                var tab= $.parseJSON(data[0].valeurSalaire);
                var somme=0;
                $.each(tab,function(index, value ){
                    var x=value.valeur;
                    somme=somme+ parseInt(x);
                })
                $("#dm_budgetMensuel").val(somme);


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

        //changer le type de contrat
        $("#id_type_contrat1").change(function(e){
            id_type_contrat1_initial=$("#id_type_contrat1_initial").val();
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