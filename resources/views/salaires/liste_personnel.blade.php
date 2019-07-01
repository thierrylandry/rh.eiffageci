@extends('layouts.app')
@section('salaires')
    active
@endsection
@section('lister_personne_block')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">PERSONNE-LISTE </h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool  pull-right">
            </div>
            <div class="table-responsive table-responsive-data2">
                <table class="table  table-earning" id="table_employe">
                    <thead>
                    <tr>
                        <th>slug</th>
                        <th>NOM & PRENOM</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if( isset($personnes))
                    @foreach($personnes as $personne)
                        <tr class="tr-shadow">
                            <td>{{$personne->slug}}</td>
                            <td>{{$personne->nom.' '.$personne->prenom}}</td>

                            <td> <div class="table-data-feature">
                                    <a href="{{route('liste_salaire',['slug'=>$personne->slug])}}" class="item" data-toggle="tooltip" data-placement="top" title="Plus d'info">
                                        <i class="fa fa-money-bill-alt" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                        @endif
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
@endsection