@extends('layouts.app')
@section('lister_partenaire')
    active
@endsection
@section('lister_partenaire_block');
style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">PARTENAIRE - LISTE</h2>
            </div>
            <div class="table-data__tool  pull-right">
                <div class="table-data__tool-right">

                    @if(isset($partenaire))
                        <a href="{{route('lister_partenaire')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>Ajouter</a>
                    @endif
                </div>&nbsp;
            </div>
        </div>
    </div>

    </br>
    <div class="row">

        <div class="col-sm-12">

            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>{{isset($partenaire)? 'Modifier un partenaire':'Ajouter un partenaire'}}</strong>
                </div>
                <div class="card-body" >
                    <form action="{{route(isset($partenaire)? 'modifier_partenaire':'enregistrer_partenaire')}}" method="post">
                        @csrf
                        <input type="hidden" id="text-input" name="id_partenaire" placeholder="Nom" value="{{isset($partenaire)? $partenaire->id:''}}" class="form-control" required>
                                <div class="card" style="height: 100% !important">
                                    <div class="card-body" >
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Libelle </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="text-input" name="libelle" placeholder="Libelle" value="{{isset($partenaire)? $partenaire->nom:''}}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Effectif homme *</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="number" id="homme" name="homme" placeholder="Effectif" class="form-control" value="{{isset($partenaire)? $partenaire->homme:''}}" min="0" required>
                                            </div>
                                        </div> <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label"> Effectif femme *</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="number" id="femme" name="femme" placeholder="Effectif" class="form-control" value="{{isset($partenaire)? $partenaire->femme:''}}" min="0" required>
                                            </div>
                                        </div> <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Effectif total*</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="number" id="effectif" name="effectif" placeholder="Effectif" class="form-control" value="{{isset($partenaire)? $partenaire->effectif:''}}" min="0" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <div class="card-footer pull-right">
                            <button type="submit" class="btn btn-{{isset($partenaire)? 'primary':'success'}} btn-sm">
                                <i class="zmdi zmdi-edit"></i> {{isset($partenaire)? 'Modifier':'Enregistrer'}}
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm" id="reset">
                                <i class="fa fa-ban"></i> Réinitialiser
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-responsive table-responsive-data2">
                <table class="table  table-earning" id="table_employe">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>NOM</th>
                        <th>EFFECTIF HOMME</th>
                        <th>EFFECTIF FEMME</th>
                        <th>EFFECTIF TOTAL</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($partenaires as $partenaire)
                        <tr class="tr-shadow">
                            <td>{{$partenaire->id}}</td>
                            <td>{{$partenaire->nom}}</td>
                            <td>{{$partenaire->homme}}</td>
                            <td>{{$partenaire->femme}}</td>
                            <td>{{$partenaire->effectif}}</td>
                            <td> <div class="table-data-feature">
                                    <a href="{{route('detail_partenaire',['id'=>$partenaire->id])}}" class="item" data-toggle="tooltip" data-placement="top" title="Plus d'info">
                                        <i class="zmdi zmdi-more"></i>
                                    </a>
                                    <a href="{{route('detail_partenaire',['id'=>$partenaire->id])}}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Supprumer">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                                <div class="table-data-feature">

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
        //code du calcule de somme
        $("#homme").change(function() {
            //readURL(this);
            var homme=$(this).val();
            var femme=$("#femme").val();
            var tot= parseInt(homme)+parseInt(femme);
            $("#effectif").val(tot);
        });
        $("#femme").change(function() {
            var femme=$(this).val();
            var homme=$("#homme").val();
            var tot= parseInt(homme)+parseInt(femme);
            $("#effectif").val(tot);
        });
        $("#reset").click(function() {
            $('#rendu_img').attr('src','images/user.png');
        });
    </script>
    <script>
        $(document).ready(function() {
            var table= $('#table_employe').DataTable({
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
@endsection