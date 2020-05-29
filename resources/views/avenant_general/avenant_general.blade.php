@extends('layouts.app')

@section('pole_demande')
    active
@endsection
@section('pole_demande_block')
    style="display: block;"
@endsection


@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                        <h2 class="title-1">AVENANT GENERAL - LISTE  @foreach($entites as $enti)

                        @if($enti->id==Auth::user()->id_chantier_connecte)
                            {{$enti->libelle=="PHB"?"EIFFAGE ".$enti->libelle:$enti->libelle}}
                        @endif
                    @endforeach</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool  pull-right">
                <div class="table-data__tool-right">
                    <button class="btn btn-success valider" data-toggle="modal" data-target="#RVmodalcoisir"> <i class="zmdi zmdi-mail-send"></i> SOUMETTRE LA DEMANDE</button>

                    <a href="{{route('pole_de_demande')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-arrow-back"></i>POLE DE DEMANDE</a>
                </div>
            </div>
            <div class="table-responsive m-b-40">
                <table class="table table-borderles" id="table_employe">
                    <thead>
                    <tr>
                        <th>MATRICULE</th>
                        <th>MATRICULE</th>
                        <th>NOM & PRENOM</th>
                        <th>SEXE</th>
                        <th>NATIONALITE</th>
                        <th>FONCTION</th>
                        <th>ENTITE</th>
                        <th>SOCIETE</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($personnes as $personne)
                        <tr class="tr-shadow">
                            <td>{{isset($personne->matricule)?$personne->id:''}}</td>
                            <td>{{isset($personne->matricule)?$personne->matricule:''}}</td>
                            <td>{{$personne->nom.' '.$personne->prenom}}</td>
                            <td>{{$personne->sexe=='M'? 'Masculin':'Féminin'}}</td>
                            <td>{{$personne->pays->nom_fr_fr}}</td>
                            <td>
                                {{isset($personne->fonction()->first()->libelle)?$personne->fonction()->first()->libelle:''}}
                            </td>
                            <td>{{ $personne->getEntiteString() }}
                            </td>
                            <td>{{ $personne->id_unite ? $personne->societe->libelleUnite : ""}}</td>
                        </tr>
                    @endforeach
                    {{ $personnes->links() }}
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3">
                    <button class="btn btn-success valider" data-toggle="modal" data-target="#RVmodalcoisir"> <i class="zmdi zmdi-mail-send"></i> SOUMETTRE LA DEMANDE</button>

                </div>

            </div>
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
    </script>
    <script>

        $(document).ready(function() {
            var $selectListeAvenant= $('#liste_avenant').select2({ placeholder: 'Selectionner'});
            var table= $('#table_employe').DataTable({
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
            //table.DataTable().draw();
            $("#checkboxlisteavenant").click(function(){

                if($("#checkboxlisteavenant").is(':checked') ){
                    $("#liste_avenant > option").prop("selected","selected");
                }else{
                    $("#liste_avenant > option").removeAttr("selected");
                }
                $selectListeAvenant.trigger('change');
            });
            $('#table_employe tbody').on( 'click', 'tr', function () {
                $(this).toggleClass('selected');
            } );

            $('#button').click( function () {
                alert( table.rows('.selected').data().length +' row(s) selected' );
            } );
            $('.valider').click(function(e){

                var rows_selected = table.column(0).checkboxes.selected();
                console.log(rows_selected);
                var mavariable="";
                var route="{{asset('')}}"

                $.each(rows_selected, function(index, rowId){
                    // Create a hidden element
                    //  console.log(rowId);
                    mavariable=mavariable+','+rowId;

                });


                if(mavariable==""){
                    alert("Veuillez selectionner au moins un élément");
                    //  $("#RVmodal").modal('toggle');
                    // $('#RVmodal').modal('show');
                    $('#closebtn').trigger('click');
                }else{
                     $("#mavariable").val(mavariable);
                    var csrf_token = $('meta[name="csrf-token"]').attr('content');
             /*       $.post(route+"/avenant_collectif",{mavariable:mavariable,_token: "{{ csrf_token() }}"},
                            function (data) {
                                console.log(data);
                                if(data==""){
                                    //location.reload();
                                    alert("Demande d'avenant générale éffectué");
                                }
                            }
                    );*/
                }
                //console.log(mavariable);
            });
        } );
        $(".current").click(function (){
            alert("eee");
        });
    </script>
@endsection