@extends('layouts.app')
@section('lister_personne')
    active
@endsection
@section('lister_personne_block')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">PERSONNE-LISTE</h2>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <div class="table-data__tool  pull-right">

            <div class="table-data__tool-right">
                <a href="{{route('Ajouter_personne')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                    <i class="zmdi zmdi-plus"></i>AJOUTER UNE PERSONNE</a>
            </div>
        </div>
        <div class="table-responsive table-responsive-data2">
            <table class="table  table-earning" id="table_employe">
                <thead>
                <tr>
                    <th>slug</th>
                    <th>NOM & PRENOM</th>
                    <th>SEXE</th>
                    <th>NATIONNALITE</th>
                    <th>ENTITE</th>
                    <th>SOCIETE</th>
                    <th>CONTACT</th>
                    <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
    @foreach($personnes as $personne)
                <tr class="tr-shadow">
                    <td>{{$personne->slug}}</td>
                    <td>{{$personne->nom.' '.$personne->prenom}}</td>
                    <td>{{$personne->sexe=='M'? 'Masculin':'Féminin'}}</td>
                    <td>@foreach($payss as $pays)
                            @if($pays->id==$personne->nationalite)
                            {{$pays->nom_fr_fr}}
                            @endif
                        @endforeach</td>
                    <td>
                        @if($personne->entite==1)
                            PHB
                            @else
                            DIRECTION CI
                        @endif
                    </td>
                    <td>@foreach($societes as $societe)
                            @if($personne->id_societe==$societe->id)
                                {{$societe->libellesoc}}
                            @endif
                                @endforeach</td>
                    <td>{{$personne->email}} {{$personne->contact}}</td>
                    <td> <div class="table-data-feature">
                            <a href="{{route('detail_personne',['slug'=>$personne->slug])}}" class="item" data-toggle="tooltip" data-placement="top" title="Plus d'info">
                            <i class="zmdi zmdi-more"></i>
                            </a>
                            <a href="{{route('document_administratif',['slug'=>$personne->slug])}}" class="item" data-toggle="tooltip" data-placement="top" title="Document administratif">
                                <i class="zmdi zmdi-folder-person"></i>
                            </a>
                            <a href="{{route('supprimer_personne',['slug'=>$personne->slug])}}" onclick="if(confirm('Voulez vous supprimer?')){}else{ e.preventDefault()}" class="item" data-toggle="tooltip" data-placement="top" title="Supprimer">
                                <i class="zmdi zmdi-delete"></i>
                            </a>
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
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            language: {
                url: "{{ asset('public/js/French.json')}}"
            },
            "order": [[ 1, "desc" ]],
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