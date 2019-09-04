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
                <h2 class="title-1">LISTE DES EQUIPEMENTS </h2>
            </div>
            <div class="table-data__tool  pull-right">
                <div class="table-data__tool-right">
                    <a href="{{route('avantages')}}" class="btn btn-info">
                        PRECEDENT</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card"  style="height: 100% !important">
                <div class="card-header">
                    <strong>Ajouter un equipement</strong>
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
                                    @foreach($type_equipements as $type)
                                    <option value="{{$type->id}}"  {{isset($equipement) && $equipement->id_type_equipement==$type->id?'selected':''}}>{{$type->libelle}}</option>
                                   @endforeach

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
                                    <option value="Portable" {{isset($equipement) &&$equipement->TypePC=='LAPTOP'?'selected':''}}>LAPTOP</option>
                                    <option value="Bureau" {{isset($equipement) &&$equipement->TypePC=='DESKTOP'?'selected':''}}>DESKTOP</option>
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

            <div class="table-responsive m-b-40">
                <table class="table table-borderles" id="table_employe">
                    <thead>
                    <tr >
                        <th>id</th>
                        <th>IMAGE</th>
                        <th>TYPE EQUIPEMENT</th>
                         <th>CODE</th>
                         <th>TYPE PC</th>
                        <th>SACOCHE</th>
                        <th>ACTION</th>
                    </tr>
                    </thead>
                    <tbody>

                                    @foreach($equipements as $equipement)
                                        <tr style="{{ $equipement->etat==0?'background-color: grey; color: white;':''}}">
                                            <td>{{$equipement->id}}</td>
                                        <td> <img src="{{Storage::url('app/images/'.$equipement->type_equipement->image)}}" width="30px;" height="30px;"/> </td>
                                    <td>{{$equipement->type_equipement->libelle}}</td>
                                          <td>{{$equipement->code}}</td>
                                        <td>{{$equipement->TypePC}}</td>
                                        <td>@if($equipement->saccoche==1)AVEC @else SANS @endif</td>
                                        <td style="text-align: center;"> <a class="btn btn-primary btn_historique"  href="#" data-toggle="modal" data-target="#modalhistorique"><i class="fas fa-history"></i> Historique</a> @if($equipement->etat==1)<a class="btn btn-info" href="{{route('updateMateriel',['id'=>$equipement->id])}}"><i class="fas fa-edit"></i> Modifier</a><a onclick="" class="btn btn-danger" href="{{route('supprimer_equipement',['id'=>$equipement->id])}}"><i class="fas fa-trash"></i></a> @endif </td>
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
                    console.log(input.files[0]);
                    console.log(input.files[0].type);
                    if(input.files[0].type=="image/jpeg" || input.files[0].type=="image/png" ){
                        if(input.files[0].size<=1000024){

                            console.log('cool');
                            $('#rendu_img').attr('src', e.target.result);
                        }else{
                            alert('trop volumineux');

                            input.value='';
                            $('#rendu_img').attr('src','images/user.png');
                        }
                    }else{
                        alert('le ficher doit être de type jpeg ou png exclusivement');

                        input.value='';
                        $('#rendu_img').attr('src','{{Storage::url('app/images/defaut.png')}}');
                    }


                }

                reader.readAsDataURL(input.files[0]);

            }else{
                $('#rendu_img').attr('src','images/user.png');
            }
        }

        $("#id_type_equipement").change(function() {

            var valeur=$('#id_type_equipement :selected').html();
           // alert($('#id_type_equipement :selected').html());
           // $('#rendu_img').attr('src','images/user.png');
            if($('#id_type_equipement :selected').val()!=''){
                $('#rendu_img').attr('src','' +'/rh.eiffageci/storage/app/images/'+valeur.toLowerCase()+'.png' );
            }else{
                $('#rendu_img').attr('src','{{Storage::url('app/images/defaut.png')}}');
            }

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
            }).column(0).visible(false);

            $(".btn_historique").click(function (){
                var data = table.row($(this).parents('tr')).data();
                //  var id_bc= $("#id_bc").val();
                console.log(data);
                table1.clear().draw();
                $.get('historique_passages/'+data[0],function(tab,status){
                    console.log(tab);
                 //   table1
                    $.each(tab, function( indexi, value ) {
                        table1.row.add( [
                            value.matricule,
                            value.nom,
                            value.prenom,
                            value.dateDotation,
                            value.retour,
                        ] ).draw( false );


                    });
                });




            });
            var table1= $('#table_historique').DataTable({
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