@extends('layouts.app')

@section('pole_demande')
    active
@endsection
@section('pole_demande_block')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <a href="{{route('absence.demande')}}" class="card col-sm-4">
            <div style="color: yellow">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-plus fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Demande</h4>
                </div>
            </div>
        </a>
        <a href="{{route('absence.validation')}}" class="card col-sm-4">
            <div   style="color: yellow">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-clipboard-check fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Validation</h4>
                </div>

            </div>
        </a>
        <a href="{{route('absence.gestion')}}" class="card col-sm-4">
            <div    style="color: yellow">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-list-ol fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Gestion</h4>
                </div>

            </div>
        </a>
    </div>

    <div class="row">
        <div class="col-md-12" >
            <!-- DATA TABLE -->
            <div class="table-data__tool  pull-right">

                <div class="table-data__tool-right">
                    <a href="{{route('absence.demande')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>DEMANDER UNE ABSENCE</a>
                </div>
            </div>
            <div class="table-responsive m-b-40">
                <table class="table table-borderles" id="table_recrutement">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>STATUS</th>
                        <th>DEMANDEUR</th>
                        <th>TITULAIRE</th>
                        <th>MOTIF</th>
                        <th>DATE DE DEPART SOUHAITE</th>
                        <th>DATE DE FIN SOUHAITE</th>
                        <th>DATE DE REPRISE</th>
                        <th>NOMBRE DE JOUR</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($absences as $absence)
                        <tr>
                            <td>{{$absence->id}}</td>
                            <td>    @if($absence->etat==1)
                                    <i class=" zmdi zmdi-circle-o" style="background-color: red"></i>
                                @elseif($absence->etat==2)
                                    <i class=" zmdi zmdi-circle-o" style="background-color: orange"></i>
                                @elseif($absence->etat==3)
                                    <i class=" zmdi zmdi-circle-o" style="background-color: green"></i>
                                @elseif($absence->etat==4)
                                    <i class=" zmdi zmdi-circle-o" style="background-color: black"></i>
                                @elseif($absence->etat==0)
                                    <i class="zmdi zmdi-circle-o" style="background-color: red" ></i>(En attente validation partiel)
                                @endif

                                {{isset($absence->type_permission)?$absence->type_permission->libelle:''}}
                            </td>
                            <td>{{$absence->nom_users}} {{$absence->prenoms_users}}</td>
                            <td>{{isset($absence->nom)?$absence->nom:''}} {{isset($absence->prenom)?$absence->prenom:''}} <a href="{{route('fiche_personnel',['slug'=>$absence->slug])}}" target="_blank">Consulter la fiche</a></td>
                            <td>{{isset($absence->motif_perso)?$absence->motif_perso:''}}</td>
                            <td><?php $date = new DateTime($absence->debut);
                                echo $date->format('d-m-Y');?></td>
                            <td><?php $date = new DateTime($absence->fin);
                                echo $date->format('d-m-Y');?></td>
                            <td><?php $date = new DateTime($absence->reprise);
                                echo $date->format('d-m-Y');?></td>
                            <td>{{$absence->jour}}</td>
                            <td>
                                <div class="table-data-feature">
                                    @if($absence->etat==1 || $absence->etat==0)
                                        @if($mode=="validation")
                                            <a href="{{route('absence.ActionValider',$absence->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Send">
                                                <i class="zmdi zmdi-mail-send"></i> Valider
                                            </a>&nbsp;
                                            <a href="#" class="btn btn-danger btn_rejeter" id="btn_rejeter_absence" data-toggle="modal" data-target="#modalrefusdemande" data-placement="top" title="Rejeter">
                                                <i class="zmdi zmdi zmdi-close"></i> Rejeter
                                            </a>&nbsp;
                                        @endif
                                            @if($mode=="validation")
                                        <a href="{{route("absence.modification",$absence->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a  href="{{route("absence.supprimer",$absence->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                            @endif

                                    @elseif($absence->etat==2)
                                        <a href="#" class="btn btn-warning btn_type_permission" data-toggle="modal" data-target="#modaltype_permission" data-placement="top" title="Préciser le type de permission">
                                            <i class="zmdi zmdi-format-indent-increase"></i> Préciser le type de permission
                                        </a>&nbsp;
                                        <a href="{{route("absence.supprimer",$absence->id)}}" class="item confirmons" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                    @elseif($absence->etat==3)
                                        <a href="#" class="btn btn-warning btn_type_permission" data-toggle="modal" data-target="#modaltype_permission" data-placement="top" title="Préciser le type de permission">
                                            <i class="zmdi zmdi-format-indent-increase"></i> Modifier le type de permission
                                        </a>&nbsp;
                                        <a href="{{route('absence.telecharger_doc_absence',$absence->id)}}" class="btn btn-error" target="_blank" title="Télécharger le document">
                                            <i class="zmdi zmdi-collection-pdf"></i> Télécharger le document
                                        </a>&nbsp;
                                        <a href="{{route("absence.supprimer",$absence->id)}}" class="item confirmons" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                    @elseif($absence->etat==4)
                                        <a href="{{route("absence.supprimer",$absence->id)}}" class="item confirmons" data-toggle="tooltip" data-placement="top" title="Delete">
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
            <!-- END DATA TABLE -->

        </div>
        @if($mode=="validation")
        <div class="row">
            <div class="col-sm-12">
                <button class="btn btn-success"  id="valider"> <i class="zmdi zmdi-mail-send"></i> Validation multiple</button>

            </div>

        </div>
           @endif
    </div>

    @if($mode=="validation")
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="overview-wrap">
                                <h2 class="title-1"><a data-toggle="collapse" data-parent="#accordion" href="#collapse1">ABSCENCE - HISTORIQUES DE NOS VALIDATIONS</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body">
        <div class="row">
            <div class="col-md-12" >
                <!-- DATA TABLE -->
                <div class="table-data__tool  pull-right">

                    <div class="table-data__tool-right">
                        <a href="{{route('absence.demande')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>DEMANDER UNE ABSENCE</a>
                    </div>
                </div>
                <div class="table-responsive m-b-40">
                    <table class="table table-borderles" id="table_recrutement_historique">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>STATUS</th>
                            <th>DEMANDEUR</th>
                            <th>TITULAIRE</th>
                            <th>MOTIF</th>
                            <th>DATE DE DEPART SOUHAITE</th>
                            <th>DATE DE FIN SOUHAITE</th>
                            <th>DATE DE REPRISE</th>
                            <th>NOMBRE DE JOUR</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($absences_valides_par_mois as $absence)
                            <tr>
                                <td>{{$absence->id}}</td>
                                <td>    @if($absence->etat==1)
                                        <i class=" fa fa-check-circle-o" style="background-color: red"></i>
                                    @elseif($absence->etat==2)
                                        <i class=" fa fa-check-circle-o" style="background-color: orange"></i> Accepté
                                    @elseif($absence->etat==3)
                                        <i class=" fa fa-check-circle-o" style="background-color: green"></i> traité
                                    @elseif($absence->etat==4)
                                        <i class=" fa fa-check-circle-o" style="background-color: black"></i> réfuser
                                    @elseif($absence->etat==0)
                                        <i class=" fa fa-check-circle-o" style="background-color: black"></i>
                                    @endif

                                    {{isset($absence->type_permission)?$absence->type_permission->libelle:''}}
                                </td>
                                <td>{{$absence->nom_users}} {{$absence->prenoms_users}}</td>
                                <td>{{isset($absence->nom)?$absence->nom:''}} {{isset($absence->prenom)?$absence->prenom:''}} <a href="{{route('fiche_personnel',['slug'=>$absence->slug])}}" target="_blank">Consulter la fiche</a></td>
                                <td>{{isset($absence->motif_perso)?$absence->motif_perso:''}}</td>
                                <td><?php $date = new DateTime($absence->debut);
                                    echo $date->format('d-m-Y');?></td>
                                <td><?php $date = new DateTime($absence->fin);
                                    echo $date->format('d-m-Y');?></td>
                                <td><?php $date = new DateTime($absence->reprise);
                                    echo $date->format('d-m-Y');?></td>
                                <td>{{$absence->jour}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE -->

            </div>

        </div>
                        </div>
                        </div>
                        </div>
                        </div>

    @endif
    <script src="{{ asset("js/jquery.min.js") }}"></script>
    <script src="{{ asset("js/dataTables.min.js") }}"></script>

    <script src="{{ asset("js/dataTables.checkboxes.js") }}"></script>
    <script src="{{ asset("js/dataTables.buttons.min.js") }}"></script>
    <script src="{{ asset("js/buttons.flash.min.js") }}"></script>
    <script src="{{ asset("js/jszip.min.js") }}"></script>
    <script src="{{ asset("js/dataTable.pdfmaker.js") }}"></script>
    <script src="{{ asset("js/vfs_fonts.js") }}"></script>
    <script src="{{ asset("js/buttons.html5.min.js") }}"></script>
    <script src="{{ asset("js/buttons.print.min.js") }}"></script>
    <script type="application/javascript">
        $("#addrubrique").click(function (e) {
            $($("#rubriquetemplate").html()).appendTo($("#rubriques_petit"));
        });
    </script>
    <script>


        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#rendu_img').attr('src', e.target.result);
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

        $("#btnsupprimer").click(function(e){
           if(confirm("Voulez vous supprimer?")){

           }else{
               e.preventDefault;
           }
        })

    </script>
    <script>

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
                "columnDefs": [
                    {
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true
                        }
                    },
                    { "width": "10%", "targets": 2 }
                ],
                "select": {
                    'style': 'multi'
                },
            });
            var table1= $('#table_recrutement_historique').DataTable({
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
                "columnDefs": [
                    {
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true
                        }
                    },
                    { "width": "10%", "targets": 2 }
                ],
                "select": {
                    'style': 'multi'
                },
            });
            //.column(0).visible(false)
            //table.DataTable().draw();


           // $("#slugrecrutement").
            $('.confirmons').click( function (e) {
                //   table.row('.selected').remove().draw( false );
                if(confirm("Voulez vous supprimer la demande d'absence?")){}else{e.preventDefault(); e.returnValue = false; return false; }
            } );
            $(".btn_rejeter").click(function(e){

                var data = table.row($(this).closest('tr')).data();
                var slug=data[Object.keys(data)[0]];
                $("#slugrecrutement").val(slug);
            });
            $("#btn_rejeter_absence").click(function(e){

                var data = table.row($(this).closest('tr')).data();
                var slug=data[Object.keys(data)[0]];
                var objet="absence";
                $("#id_dmd").val(slug);
                $("#objet").val(objet);
            });
            $(".btn_type_permission").click(function(e){

                var data = table.row($(this).closest('tr')).data();
                var slug=data[Object.keys(data)[0]];
                $("#id_abs").val(slug);
                $("#id_permission").val("");
                $.get("../absences/type_permission/"+slug,function(data){
                    console.log(data);
                    if(data){
                        var res=JSON.parse(data);
                        console.log(res);
                        $("#id_permission").val(res.id_type_permission);
                    }


                });

                $.get("../recrutements/monrecrutement/"+slug,function(data){
                    // alert(data.id_definition);
                    $(".id_definition").val(data.id_definition);
                    $(".id_categorie").val(data.id_categorie);
                    $(".regime").val(data.regime);
                });


            });
            function vider(){
                $("#id_definition1").val("");
                $("#id_categorie1").val("");
                $("#matricule").val("");
                $("#service").val("");
                $("#couverture_maladie").val();
                $("#type_contrat").val();
                $("#email").val("");
                $("#contact").val("");
                $("#dateDebutC").val("");
                $("#dateFinC").val("");
                $("#periode_essaie").val("");
                $("#position").val("");
                $("#id_personne").val("");
                $("#id_nature_contrat").val("");
                $("#service").val("");
                $("#regime").val("");
            }
            function information_modification(ici){
                var data = table.row($(ici).closest('tr')).data();
                var id=data[Object.keys(data)[0]];
                $.get("../information_modification/"+id,function(data){
                    console.log(data);

                    if(!data[2].id_categorie.empty){

                    }
                    $("#id_definition1").val(data[0].id_definition);
                    $("#id_categorie1").empty();

                    var lesOptions;
                    $.each(data[1], function( index, value ) {
                        lesOptions+="<option value='"+value.id+"'>"+value.libelle+"</option>" ;
                    });

                    $("#id_categorie1").append(lesOptions);
                    $("#id_categorie1").val(data[0].id_categorie);
                    $("#matricule").val(data[0].matricule);
                    $("#service").val(data[0].service);
                    $("#couverture_maladie").val(data[0].couvertureMaladie);
                    $("#type_contrat").val(data[0].id_type_contrat);
                    $("#email").val(data[0].email);
                    $("#contact").val(data[0].contact);
                    $("#dateDebutC").val(data[0].datedebutc);
                    $("#dateFinC").val(data[0].datefinc);
                    $("#periode_essaie").val(data.periode_essaie);
                    $("#position").val(data[0].position);
                    $("#id_personne").val(data[0].id_personne);
                    $("#service").val(data[0].id_service);
                    $("#regime").val(data[0].regime);


                });
            }
            $("#id_definition1").change(function (e) {
                var id_definition=  $("#id_definition1").val();
                $.get("../listercat/"+id_definition,function(data){
                    console.log(data);
                    var lesOptions;
                    $.each(data, function( index, value ) {
                        lesOptions+="<option value='"+value.libelle+"'>"+value.libelle+"</option>" ;
                    });
                    $("#id_categorie1").empty();
                    $("#id_categorie1").append(lesOptions);
                    //  $("#id_categorie").trigger("chosen:updated");

                });
                //  alert("ddd");
            });
            $("#modalbtnrenouvellement").click(function (e) {
                $typedoc=2;
                vider();
                $('#id_modification1').prop('readonly',true);
                information_modification(this);
                if($typedoc==2){
                    $("#titre_contrat").html("RENOUVELLEMENT DE CONTRAT")
                    $("#dateDebutC").prop('readonly',true);
                    $("#dateFinC").prop('readonly',false);
                    /*   $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);*/
                    $("#id_nature_contrat").val($typedoc);
                }else if($typedoc==3){
                    $("#titre_contrat").html("AVENANT DE CONTRAT")
                    $("#dateDebutC").prop('readonly',true);
                    $("#dateFinC").prop('readonly',true);
                    $("#id_nature_contrat").val($typedoc);
                    /*   $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);
                     $("#dateDebutC").prop('readonly',true);*/
                }


            });
            $(".btn_modal_condition_remuneration").click(function(e){

                var data = table.row($(this).closest('tr')).data();
                var slug=data[Object.keys(data)[0]];
                $("#slugConditionRemuneration").val(slug);
                $("#rubriques_petit").empty();

                $("#Salaire_de_base").val("");
                $("#Sursalaire").val("");
                $("#Prime_de_salissure").val("");
                $("#Prime_de_tenue_de_travail").val("");
                $("#Prime_de_transport").val("");

                $.get("../recrutements/liste_salaire/"+slug,function(data){
                    console.log(data[0]);
                    $("#Salaire_de_base").val(data[0][0].valeur);
                    $("#Sursalaire").val(data[0][1].valeur);
                    $("#Prime_de_salissure").val(data[0][2].valeur);
                    $("#Prime_de_tenue_de_travail").val(data[0][3].valeur);
                    $("#Prime_de_transport").val(data[0][4].valeur);

                    $("#rubriques_petit").append(data[1]);

                });

                $.get("../recrutements/monrecrutement/"+slug,function(data){
                   // alert(data.id_definition);
                    $(".id_definition").val(data.id_definition);
                    $(".id_categorie").val(data.id_categorie);
                    $(".regime").val(data.regime);
                });


            });
            $('#valider').click(function(e){
                var rows_selected = table.column(0).checkboxes.selected();
                console.log(rows_selected);
                var mavariable="";
                $.each(rows_selected, function(index, rowId){
                    // Create a hidden element
                    //  console.log(rowId);
                    mavariable=mavariable+','+rowId;

                });


                if(mavariable==""){
                    alert("Veuillez selectionner au moins un élément");
                    //  $("#RVmodal").modal('toggle');
                    // $('#RVmodal').modal('show');
                }else{
                   // $("#id_personnetype_contratrenouvellement").val(mavariable);
                    var csrf_token = $('meta[name="csrf-token"]').attr('content');
                    $.post("absences_validation_collective",{mavariable:mavariable,_token: "{{ csrf_token() }}"},
                            function (data) {
                                console.log(data);
                                if(data==""){
                                    location.reload();
                                }
                            }
                    );
                }
                //console.log(mavariable);
            });
        } );
        $(".current").click(function (){
            alert("eee");
        });

        function trouvezur_de_salaire_cat(){
            var categorieLibelle=  $(".id_categorie").val();
            var id_definition=  $(".id_definition").val();
            var regime=  $(".regime option:selected").html();
            $.get("../recrutements/macategorie/"+categorieLibelle+"/"+id_definition+"/"+regime,function(data){
                console.log(data);
                var lesOptions;
                if(data!=""){

                    $(".salaire_base").val(data.salCategoriel);

                }else{
                    $(".salaire_base").val("");
                }

                /*  $("#id_categorie").empty();
                 $("#id_categorie").append(lesOptions);*/
                //  $("#id_categorie").trigger("chosen:updated");

            });
        }
        $(".id_definition").change(function (e) {
           // alert("test");
            var id_definition=  $("#id_definition").val();
            $.get("../listercat/"+id_definition,function(data){
                console.log(data);
                var lesOptions;
                $.each(data, function( index, value ) {
                    lesOptions+="<option value='"+value.libelle+"'>"+value.libelle+"</option>" ;
                });
                $("#id_categorie").empty();
                $("#id_categorie").append(lesOptions);
                //  $("#id_categorie").trigger("chosen:updated");
                // pour trouver le salcategorielle
                trouvezur_de_salaire_cat();
            });

        });

        $(".id_categorie").change(function (e) {
            trouvezur_de_salaire_cat();
        })      ;
        $(".regime").change(function (e) {
            // alert("test");
            trouvezur_de_salaire_cat();
            //  alert("ddd");
        })
    </script>
@endsection
