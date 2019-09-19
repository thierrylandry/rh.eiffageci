@extends('layouts.app')
@section('epi')
    active
@endsection
@section('epi_block')
    style="display: block;"
@endsection
@section('page')
    <style>
        .grey{ background-color: lightgrey !important;}
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">  LISTE DES EPI</h2>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool  pull-right">
                <div class="table-data__tool-right">

                    <a href="" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-long-arrow-return"></i>Retour</a>
                </div>&nbsp;
                <div class="table-data__tool-right">

                    <a  class="au-btn au-btn-icon au-btn--green au-btn--small"  href="#" data-toggle="modal" data-target="#modal_add_epi">
                        <i class="zmdi zmdi-plus"></i>AJOUTER UN EPI</a>
                </div>
            </div>

            <div class="table-responsive table-responsive-data2">
                <table class="table  table-earning" id="table_employe">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th class="">image</th>
                        <th class="">Libelle</th>
                        <th>Quantite</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($equipements as $equipement)

                        <tr>
                            <td>
                                {{$equipement->id}}
                            </td>
                            <td>
                               <img  src="{{Storage::url('app/images/'.$equipement->image)}}" width="100px" height="100px"/>
                            </td>
                            <td>
                                {{$equipement->libelle}}
                            </td>
                            <td>
                                {{$equipement->qte}}
                            </td>
                            <td>
                                <a href="" class="btn btn-info">Approvisionner</a>
                                <a href="" class="btn btn-info">Attribution</a>
                                <a href="" class="btn btn-error">Suppression</a>
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
                    $('#rendu_img1').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }else{
                $('#rendu_img1').attr('src','images/user.png');
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
                "order": [[ 1, "desc" ]],
                "ordering":true,
                "paging": false,
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