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


                    <div class="col-sm-6">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Salaire catégoriel </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min="0" onchange="calculsal()"  value=""  name="salCategoriel" id="salCategoriel" placeholder="Salaire catégoriel" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Sursalaire</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min="0" onchange="calculsal()"  value=""  name="sursalaire" id="sursalaire" placeholder="Sursalaire" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Transport</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min="0" onchange="calculsal()"  value=""  name="transport" id="transport" placeholder="Transport" class="form-control" required>
                            </div>
                        </div><div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Logement</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min="0" onchange="calculsal()"  value=""  name="logement" id="logement" placeholder="Logement" class="form-control" required>
                            </div>
                        </div><div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Salissure</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min="0" onchange="calculsal()"  value="" id="salissure" name="salissure" placeholder="Salissure" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Tenue de travail</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min="0" onchange="calculsal()"  value="" id="tenueTravail" name="tenueTravail" placeholder="Tenue de travail" class="form-control" required>
                            </div>
                        </div>

                    </div>
                <div class="col-sm-6">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Retenue</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" min="0" onchange="calculsal()"  value="" id="retenue" name="retenue" placeholder="Retenue" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Salaire brut</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" min="0" onchange="calculsal()"  value="" id="salebrute"  name="salebrute" placeholder="Salaire brut" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Salaire net</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" min="0" onchange="calculsal()"  value="" id="salenet" name="salenet" placeholder="Salaire net" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Date de debut</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="date"  id="text-input" name="dateDebutS" placeholder="Date de début" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Contrat</label>
                        </div>
                        <div class="col-12 col-md-9">
                           <select class="form-control" required noSelectedText="Selectionner un contrat" name="id_contrat">
                               @foreach($contrats as $contrat)
                                   <option value="{{$contrat->id}}"> {{"Période de ".$contrat->datedebutc." ".$contrat->datefinc}}</option>
                                   @endforeach
                           </select>
                        </div>
                    </div>

                </div>

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

        $("#photo").change(function() {
            readURL(this);
        });
        $("#reset").click(function() {
            $('#rendu_img').attr('src','images/user.png');
        });
    </script>
@endsection