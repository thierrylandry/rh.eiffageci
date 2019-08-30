@extends('layouts.app')
@section('avantages')
    active
@endsection
@section('avantages_block')
    style="display: block;"
@endsection
@section('page')


    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">LISTE DES AVANTAGES OCTROYTES </h2>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="card"  style="height: 100% !important">
                <div class="card-header">
                    <strong>Attribuer un équipement</strong>
                </div>
                <div class="card-body card-block">

                    <form method="post" action="{{route(isset($equipement)?'modifier_equipement':'save_materiel')}}">
                        <div class="row">
                            @csrf

                            <input type="hidden" id="id" name="id" value="{{isset($equipement)?$equipement->id:''}}" />
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="text-input" class=" form-control-label">Type d'équipement</label>
                                    <select name="id_type_equipement" id="id_type_equipement" required class="form-control">
                                        <option value="" selected>Choisir le type d'équipement</option>


                                    </select>
                                </div>
                                <div class="form-group"  >
                                    <img src="{{Storage::url(isset($equipement)?'app/images/'.strtolower($equipement->type_equipement->libelle).'.png':'app/images/defaut.png')}}" id="rendu_img"style=";height: 200px;" class="fa fa-user"/>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group"  >
                                    <label>Code</label>
                                    <input type="text" id="code" name="code" value="{{isset($equipement)?$equipement->code:''}}" placeholder="Code" class="form-control">

                                </div>
                                <div class="form-group"  >
                                    <label for="text-input" class=" form-control-label">Type PC</label>
                                    <select name="TypePC" id="TypePC" required class="form-control">
                                        <option value="" {{isset($equipement) &&$equipement->TypePC==''?'selected':''}}>choisir</option>
                                        <option value="Portable" {{isset($equipement) &&$equipement->TypePC=='Portable'?'selected':''}}>Portable</option>
                                        <option value="Bureau" {{isset($equipement) &&$equipement->TypePC=='Bureau'?'selected':''}}>Bureau</option>
                                    </select>
                                </div>
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Saccoche</label>
                                </div>
                                <div class="col col-md-8">
                                    <div class="form-check">
                                        <div class="radio">
                                            <label for="radio1" class="form-check-label ">
                                                <input type="radio"  name="saccoche" value="1" class="form-check-input" {{isset($equipement) &&$equipement->saccoche=='1'?'checked':''}} >Oui
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label for="radio2" class="form-check-label ">
                                                <input type="radio"  name="saccoche" value="0" class="form-check-input"  {{isset($equipement) &&$equipement->saccoche=='0' || !isset($equipement)?'checked':''}}>Non
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-data__tool  pull-right">
                                    <div class="table-data__tool-right">
                                        <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            ENREGISTRER</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>
    </br>
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool  pull-right">
                <div class="table-data__tool-right">
                    <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#mediumModal">
                        <i class="fas fa-plus-circle"></i>
                        Attribuer un équipement</a>
                </div>
                &nbsp;
                <div class="table-data__tool-right">
                    <a href="{{route('gestionmateriel')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-plus"></i>GERER LES EQUIPEMENTS</a>
                </div>

            </div>
            <div class="table-responsive m-b-40">
                <table class="table table-borderles" id="table_employe">
                    <thead>
                    <tr>
                        <th>MATRICULE</th>
                        <th>NOM & PRENOM</th>
                        <th>SEXE</th>
                        <th>NATIONALITE</th>
                        <th>FONCTION</th>
                        <th>ENTITE</th>
                        <th>SOCIETE</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>

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
                columnDefs: [
                    { responsivePriority: 1, targets: 0 },
                    { responsivePriority: 2, targets: -1 }
                ]
            });
            //table.DataTable().draw();
        } );
        $(".current").click(function (){
            alert("eee");
        });
    </script>
@endsection