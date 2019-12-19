@extends('layouts.app')

@if($mode=="gestion")
        @section('modification.gestion')
            active
        @endsection
@else
@section('modification.validation')
    active
@endsection
@endif
@section('modifications')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">MODIFICATION - LISTE DES DEMANDES DE MODIFICATIONS</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" >
            <!-- DATA TABLE -->
            <div class="table-data__tool  pull-right">
                @if(Auth::user() != null && Auth::user()->hasRole('Recrutements') || Auth::user()->hasRole('Demande_recrutement'))
                <div class="table-data__tool-right">
                    <a href="{{route('modification.demande')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>DEMANDER UNE MODIFICATION</a>
                </div>
                    @endif
            </div>
            <div class="table-responsive m-b-40">
                <table class="table table-borderles" id="table_recrutement">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>STATUS</th>
                        <th>TYPE MODIFICATION</th>
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
                            <td>{{$modification->personne->nom}} {{$modification->personne->prenoms}}</td>
                            <td>{{$modification->user->entite->libelle}}</td>
                            <td>

                                   @foreach(json_decode($modification->list_modif) as $modif)
                                       <button type="button" class="btn btn-outline-primary" disabled>{{$modif}}
                                       </button>
                                   @endforeach
                            </td>
                            <td>
                                <div class="table-data-feature">
                                    @if($modification->etat==1)
                                        @if($mode=="validation")
                                            <a href="{{route('modification.ActionValider',$modification->id)}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Send">
                                                <i class="zmdi zmdi-mail-send"></i> Valider
                                            </a>&nbsp;
                                            <a href="#" class="btn btn-danger btn_rejeter" data-toggle="modal" data-target="#modalrefusdmd" data-placement="top" title="Rejeter">
                                                <i class="zmdi zmdi zmdi-close"></i> Rejeter
                                            </a>&nbsp;
                                        @endif
                                    @if($mode!="validation")
                                        <a href="{{route("modification.modification",$modification->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>

                                        <a  href="{{route("modification.supprimer",$modification->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>
                                        @endif


                                    @elseif($modification->etat==2)
                                        <a href="{{route("modification.consulter",$modification->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-eye"></i>
                                        </a>
                                        <a href="{{route('affiche_contrat',['id'=>$modification->id])}}" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Plus d'info">
                                            <i class="zmdi zmdi-edit"></i> Créer le document
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
            <!-- END DATA TABLE -->
        </div>
    </div>
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
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ]
            }).column(0).visible(false).column(9).visible(false);
            //table.DataTable().draw();

           // $("#slugrecrutement").
            $(".btn_rejeter").click(function(e){

                var data = table.row($(this).closest('tr')).data();
                var slug=data[Object.keys(data)[0]];
                $("#slugrecrutement").val(slug);
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