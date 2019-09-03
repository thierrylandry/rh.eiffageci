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
        <div class="col-sm-10">

        </div>
        <div class=" col-sm-2 pull-right">
            <a href="{{route('gestionmateriel')}}" class="btn btn-info">
                <i class="zmdi zmdi-plus"></i> GERER LES EQUIPEMENTS</a>
        </div>

    </div>
    </br>
    <div class="row">

        <div class="col-sm-12">
            <div class="card"  style="height: 100% !important">
                <div class="card-header">
                    <strong>{{isset($avantage)?'Modifier une attribution':'Attribuer un équipement'}}</strong>
                </div>
                <div class="card-body card-block">

                    <form method="post" action="{{route(isset($avantage)?'modifier_avantage':'save_avantage')}}">
                        <div class="row">
                            @csrf

                            <input type="hidden" id="id" name="id" value="{{isset($avantage)?$avantage->id:''}}" />
                            <div class="col-sm-3">
                                <div class="form-group"  >
                                    <img src="{{Storage::url(isset($equipement)?'app/images/'.strtolower($equipement->type_equipement->libelle).'.png':'app/images/defaut.png')}}" id="rendu_img"style=";height: 200px;" class="fa fa-user"/>
                                </div>

                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="text-input" class=" form-control-label">Choisir l'équipement</label>
                                    <select name="equipement_id" id="equipement_id" required class="form-control">
                                        <option value='' selected>Choisir l'équipement</option>
                                        @foreach($equipements as $equipement)
                                            <option value="{{$equipement->id}}">{{$equipement->type_equipement->libelle}} - {{$equipement->type_equipement->libelleCode}}: {{$equipement->code}} @if($equipement->id_type_equipement==2) - TYPE :{{$equipement->TypePC}} SACOCHE : @if($equipement->saccoche==1) oui @else oui @endif @endif</option>
                                            @endforeach


                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group"  >
                                    <label for="text-input" class=" form-control-label">Employé</label>
                                    <select name="employe" id="employe" required class="form-control">
                                        <option value="" {{isset($equipement) &&$equipement->TypePC==''?'selected':''}}>choisir</option>
                                        @foreach($employes as $employe)
                                            <option value="{{$employe->id}}"> {{$employe->matricule.' '.$employe->nom.' '.$employe->prenom}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="table-data__tool  pull-right">
                                    <div class="table-data__tool-right">
                                        <button type="submit" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="fas fa-plus-circle"></i>
                                            Attribuer un équipement</button>
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

            <div class="table-responsive m-b-40">
                <table class="table table-borderles" id="table_employe">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>MATRICULE</th>
                        <th>NOM & PRENOM</th>
                        <th>TYPE D'EQUIPEMENT</th>
                        <th>CODE</th>
                        <th>DATE ATTRIBUTION</th>
                        <th>DATE RETOUR</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach($avantages as $avantage)
                                <tr>
                                <td>{{$avantage->id}}</td>
                                <td>{{$avantage->personne->matricule}}</td>
                                <td>{{$avantage->personne->nom}} {{$avantage->personne->prenom}}</td>
                                <td>{{$avantage->equipement->type_equipement->libelle}}</td>
                                <td>{{$avantage->equipement->type_equipement->libelleCode}} :{{$avantage->equipement->code}}</td>
                                <td>{{$avantage->dateDotation}}</td>
                                <td>{{$avantage->retour}}</td>
                                <td> <a class="btn btn-primary retourner" href="#" data-toggle="modal" data-target="#smallmodal"><i class="fas fa-history"></i> Retourner</a><a onclick="" class="btn btn-danger" href="{{route('supprimer_equipement',['id'=>$equipement->id])}}"><i class="fas fa-trash"></i></a></td>
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
    <script src="{{ asset("js/select2.full.js") }}"></script>
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

        $("#equipement_id").change(function() {

            var valeur=$('#equipement_id :selected').html();
            // alert($('#id_type_equipement :selected').html());
            // $('#rendu_img').attr('src','images/user.png');
            valeur=valeur.split('-')[0].replace(' ','');
         //   alert($('#equipement_id :selected').val());
            if($('#equipement_id :selected').val()!=''){
                $('#rendu_img').attr('src','' +'/rh.eiffageci/storage/app/images/'+valeur.split('-')[0].toLowerCase()+'.png' );
            }else{
                $('#rendu_img').attr('src','{{Storage::url('app/images/defaut.png')}}');
            }

        });

    </script>

    <script>

        $(document).ready(function() {

            $(".retourner").click(function (){
                var data = table.row($(this).parents('tr')).data();
                //  var id_bc= $("#id_bc").val();
                console.log(data[0]);
                $('#id_avantages').val(data[0]);


            });

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
            }).column(0).visible(false);
            //table.DataTable().draw();
        } );
        $(".current").click(function (){
            alert("eee");
        });
        $('#employe').select2({ placeholder: 'Select un employé'});
        $('#equipement_id').select2({ placeholder: 'Select un équipement'});
    </script>
@endsection