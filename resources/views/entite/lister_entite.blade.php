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
                <h2 class="title-1">ENTITE - LISTE</h2>
            </div>
            <div class="table-data__tool  pull-right">
                <div class="table-data__tool-right">

                    @if(isset($entite))
                        <a href="{{route('lister_entite')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>Ajouter</a>
                    @endif
                </div>&nbsp;
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>{{isset($entite)? 'Modifier une entite':'Ajouter une entite'}}</strong>
                </div>
                <div class="card-body" >
                    <form action="{{route(isset($entite)? 'modifier_entite':'enregistrer_entite')}}" method="post">
                        @csrf
                        <input type="hidden" id="text-input" name="id_entite" placeholder="Nom" value="{{isset($entite)? $entite->id:''}}" class="form-control" required>
                                <div class="card" style="height: 100% !important">
                                    <div class="card-body" >
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="text-input" class=" form-control-label">Libelle </label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="text-input" name="libelle" placeholder="Libelle" value="{{isset($entite)? $entite->libelle:''}}" class="form-control" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                        <div class="card-footer pull-right">
                            <button type="submit" class="btn btn-{{isset($entite)? 'primary':'success'}} btn-sm">
                                <i class="zmdi zmdi-edit"></i> {{isset($entite)? 'Modifier':'Enregistrer'}}
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm" id="reset">
                                <i class="fa fa-ban"></i> Réinitialiser
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <!-- DATA TABLE -->
            <div class="table-responsive table-responsive-data2">
                <table class="table  table-earning" id="table_employe">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>LIBELLE</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($entites as $entite)
                        <tr class="tr-shadow">
                            <td>{{$entite->id}}</td>
                            <td>{{$entite->libelle}}</td>
                            <td> <div class="table-data-feature">
                                    <a href="{{route('detail_entite',['id'=>$entite->id])}}" class="item" data-toggle="tooltip" data-placement="top" title="Plus d'info">
                                        <i class="zmdi zmdi-more"></i>
                                    </a>
                                    <a href="{{route('detail_entite',['id'=>$entite->id])}}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Supprumer">
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