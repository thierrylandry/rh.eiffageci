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

                <h2 class="title-1">{{" NOM : ". $personne->nom." ".$personne->prenom}}  SALAIRES-LISTE </h2>
            </div>
        </div>
    </div>
    <div class="table-data__tool">
        <div class="table-data__tool-left">
        </div>
        <div class="table-data__tool-right">
            <a href="{{back()->getTargetUrl()}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-long-arrow-return"></i>RETOUR</a>

        </div>
    </div>
    <form action="{{route('enregistrer_salaire')}}" method="post" class="col-sm-12">
        @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card"  style="height: 100% !important">

            <div class="card-body card-block">

            <div class="row">

<div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Demande de modification </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-control" required noSelectedText="Selectionner une demande de modification" name="id_modification" id="id_modification">
                                    <option value=""></option>
                                    @if(isset($modification))

                                            <option value="{{$modification->id}}"> {{$modification->contrat()->first()->libelle." Budget mensuel ".$modification->budgetMensuel}}</option>
                                    @endif
                                </select>
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Contrat</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-control" required noSelectedText="Selectionner un contrat" name="id_contrat" id="id_contrat">
                                    @if(isset($contrats))
                                        @foreach($contrats as $contrat)
                                            <option value="{{$contrat->id}}"> {{$contrat->type_contrat()->first()->libelle." Période de ".date("d-m-Y",strtotime($contrat->datedebutc))." ".date("d-m-Y",strtotime($contrat->datefinc))}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>

                        <div class="row form-group">
                            <div class="col col-md-5">
                                <label for="text-input" class=" form-control-label">Date de mise en application</label>
                            </div>
                            <div class="col-md-7">
                               <input type="date" name="dateDebutS" required />
                            </div>

                        </div>

                        <div id="rubriques" class="form-inline">
                            <?php $i=0; ?>
                            <div class=" form-control-label">
                                <label for="rubrique[]">Rubrique</label>
                                <div class="form-group col-sm-12">
                                    <select type="text" name="rubrique[]"  class="  type_c form-control input-field rubrique" readonly="true" style="width: 260px">
                                        @if(isset($rubrique_salaires))
                                            @foreach($rubrique_salaires as $rubrique_salaire)
                                                <?php $i++?>
                                                @if($i==1)
                                                    <option value="{{$rubrique_salaire->libelle}}" {{$i==1?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                @endif @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-control-label">
                                <label for="valeur[]">Valeur</label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="text" name="valeur[]" id="Salaire_de_base" class="valeur_c salaire_base form-control" placeholder="Valeur" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                            <div class=" form-control-label">
                                <label for="rubrique[]">Rubrique</label>
                                <div class="form-group col-sm-12">
                                    <select type="text" name="rubrique[]"  class="type_c form-control input-field" style="width: 260px">
                                        <?php $i=0; ?>
                                        @if(isset($rubrique_salaires))
                                            @foreach($rubrique_salaires as $rubrique_salaire)
                                                <?php $i++?>
                                                @if($i==2)
                                                    <option value="{{$rubrique_salaire->libelle}}" {{$i==2?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-control-label">
                                <label for="valeur[]">Valeur</label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="text" name="valeur[]" id="Sursalaire" class="valeur_c form-control" placeholder="Valeur" >
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                            <div class=" form-control-label">
                                <label for="rubrique[]">Rubrique</label>
                                <div class="form-group col-sm-12">
                                    <select type="text" name="rubrique[]"  class="type_c form-control input-field" style="width: 260px">
                                        <?php $i=0; ?>
                                        @if(isset($rubrique_salaires))
                                            @foreach($rubrique_salaires as $rubrique_salaire)
                                                <?php $i++?>
                                                @if($i==3)
                                                    <option value="{{$rubrique_salaire->libelle}}" {{$i==3?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-control-label">
                                <label for="valeur[]">Valeur</label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="text" name="valeur[]" id="Prime_de_salissure" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                            <div class=" form-control-label">
                                <label for="rubrique[]">Rubrique</label>
                                <div class="form-group col-sm-12">
                                    <select type="text" name="rubrique[]"  class="type_c form-control input-field" style="width: 260px">
                                        <?php $i=0; ?>
                                        @if(isset($rubrique_salaires))
                                            @foreach($rubrique_salaires as $rubrique_salaire)
                                                <?php $i++?>
                                                @if($i==4)
                                                    <option value="{{$rubrique_salaire->libelle}}" {{$i==4?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-control-label">
                                <label for="valeur[]">Valeur</label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="text" name="valeur[]" id="Prime_de_tenue_de_travail" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                            <div class=" form-control-label">
                                <label for="rubrique[]">Rubrique</label>
                                <div class="form-group col-sm-12">
                                    <select type="text" name="rubrique[]"  class="type_c form-control input-field" style="width: 260px">
                                        <?php $i=0; ?>
                                        @if(isset($rubrique_salaires))
                                            @foreach($rubrique_salaires as $rubrique_salaire)
                                                <?php $i++?>
                                                @if($i==5)
                                                    <option value="{{$rubrique_salaire->libelle}}" {{$i==5?"selected":""}}>{{$rubrique_salaire->libelle}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-control-label">
                                <label for="valeur[]">Valeur</label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="text" name="valeur[]" id="Prime_de_transport" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                            </br>

                        </div>
                        <h5>Rubrique Additionnelle</h5>
                        <div id="rubriques_petit" class="form-inline rubriques_petit" >

                        </div>
                        Ajouter une rubrique salariale
                        <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float addrubrique" id="addrubrique">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>
                        <div id="rubriquetemplate" class="row clearfix rubriquetemplate" style="display: none">

                            <div class=" form-control-label">
                                <label for="rubrique[]">Rubrique</label>
                                <div class="form-group col-sm-12">
                                    <select type="text" name="rubrique[]" class="type_c form-control input-field">
                                        <?php $i=0?>
                                        @if(isset($rubrique_salaires))
                                            @foreach($rubrique_salaires as $rubrique_salaire)
                                                <?php $i++;?>
                                                @if($i>=6)
                                                    <option value="{{$rubrique_salaire->libelle}}">{{$rubrique_salaire->libelle}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-control-label">
                                <label for="valeur[]">Valeur</label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="text" name="valeur[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                        </div>
                    </div>
                <div class="col-sm-3"></div>
            </div>

                </div>
                </div>
        </div>
    </div>
    <div class="card-footer pull-right">
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-dot-circle-o"></i> Enregistrer
        </button>
        <button type="reset" class="btn btn-danger btn-sm" id="reset">
            <i class="fa fa-ban"></i> Réinitialiser
        </button>
    </div>   </form>

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
        function calculsal(){
            var salCategoriel=$("#salCategoriel").val();
            if(salCategoriel==""){
                salCategoriel=0;
            }
            var sursalaire=$("#sursalaire").val();
            if(sursalaire==""){
                sursalaire=0;
            }
            var transport=$("#transport").val();
            if(transport==""){
                transport=0;
            }
            var logement=$("#logement").val();
            if(logement==""){
                logement=0;
            }
            var salissure=$("#salissure").val();
            if(salissure==""){
                salissure=0;
            }
            var tenueTravail=$("#tenueTravail").val();
            if(tenueTravail==""){
                tenueTravail=0;
            }
            var retenue=$("#retenue").val();
            if(retenue==""){
                retenue=0;
            }
            var salebrute= parseFloat(salCategoriel)+parseFloat(sursalaire)+parseFloat(transport)+parseFloat(logement)+parseFloat(salissure)+parseFloat(tenueTravail);
            $("#salebrute").val(salebrute);
            var salenet= parseFloat(salebrute)- parseFloat(retenue);
            $("#salenet").val(salenet);
        }
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
        calculsal();
        $("#photo").change(function() {
            readURL(this);
        });
        $("#reset").click(function() {
            $('#rendu_img').attr('src','images/user.png');
        });
        $("#id_contrat").change(function (e) {
            var id_contrat=  $("#id_contrat").val();
            $.get("../recsalairecat/"+id_contrat,function(data){
                console.log(data);
                var lesOptions;

                $("#salCategoriel").empty();
                $("#salCategoriel").val(data.salCategoriel);
                //  $("#id_categorie").trigger("chosen:updated");
                console.log(data.salCategoriel);
                calculsal();
            });
            //  alert("ddd");
        })
        var id_contrat=  $("#id_contrat").val();
        $.get("../recsalairecat/"+id_contrat,function(data){
            console.log(data);
            var lesOptions;


            $("#salCategoriel").empty();
            $("#salCategoriel").val(data.salCategoriel);
            //  $("#id_categorie").trigger("chosen:updated");
            calculsal();
        });

    </script>
    <script type="application/javascript">
        $(".addrubrique").click(function (e) {
            $($(".rubriquetemplate").html()).appendTo($(".rubriques_petit"));
        });

    </script>
@endsection