@extends('layouts.app')
@section('lister_entite')
active
@endsection
@section('lister_entite_block');
style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">ENTITE-DETAIL </h2>
            </div>
        </div>
    </div>
    </br>
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-responsive table-responsive-data2">
                <form action="{{route('modifier_partenaire')}}" method="post"  class="form-horizontal">
                @csrf
                <input type="hidden" id="text-input" name="id_partenaire" placeholder="Nom" value="{{isset($partenaire)? $partenaire->id:''}}" class="form-control" required>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body" >
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nom *</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="nom" placeholder="Nom" value="{{isset($partenaire)? $partenaire->nom:''}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Homme *</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="number" id="text-input" name="homme" placeholder="Homme" class="form-control" value="{{isset($partenaire)? $partenaire->effectif:''}}" required>
                                    </div>
                                </div> <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Femme *</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="number" id="text-input" name="femme" placeholder="Femme" class="form-control" value="{{isset($partenaire)? $partenaire->effectif:''}}" required>
                                    </div>
                                </div> <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Effectif *</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="number" id="text-input" name="effectif" placeholder="Prénoms" class="form-control" value="{{isset($partenaire)? $partenaire->effectif:''}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                    <div class="card-footer pull-right">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="zmdi zmdi-edit"></i> Modifier
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm" id="reset">
                            <i class="fa fa-ban"></i> Réinitialiser
                        </button>
                    </div>
                </form>
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
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                language: {
                    url: "{{ asset('public/js/French.json')}}"
                },

                "ordering":true,
                "responsive": true,
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