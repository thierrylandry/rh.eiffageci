@extends('layouts.app')
@section('gestion_rh')
    active
@endsection
@section('pole_demande_block')
    style="display: block;"
@endsection
@section('page')
    <style>
        .grey{ background-color: lightgrey !important;}
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">  </h2>
            </div>
        </div>
    </div>

    <div class="row">
        <a href="{{route("lister_personne_active")}}"  class="col-sm-3">
            <div >
                <div class="card" style="color: green">


                    <div class="card-body" style="text-align: center;">
                        <i class="fas fa-users fa-10x"></i>
                        </br></br>
                        <h4 class="card-title mb-3">Personnes Actives</h4>
                        </br>
                        <p class="card-text" style="color: #0a0a0a">Consulter la liste du personnel disposant d'un contrat en cours...
                        </p>
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </a>
        <a href="{{route("lister_personne_non_active")}}"  class="col-sm-3">

            <div >
                <div class="card" style="color: red">


                    <div class="card-body" style="text-align: center;">
                        <i class="fas fa-users fa-10x"></i>
                        </br></br>
                        <h4 class="card-title mb-3">Personnes non actives</h4>
                        </br>
                        <p class="card-text" style="color: #0a0a0a">Consulter la liste du personnel dont le contrat est terminé...
                        </p>
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </a>

        <a href="{{route("lister_personne")}}"  data-placement="top" class="col-sm-3">
            <div >
                <div class="card" style="color: deepskyblue">


                    <div class="card-body" style="text-align: center;">
                        <i class="fas fa-users fa-10x"></i>
                        </br>
                        </br>
                        <h4 class="card-title mb-3">Tout le personnel</h4>
                        </br>
                        <p class="card-text" style="color: #0a0a0a">Consulter la liste du personnel...
                        </p>
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </a>
        <a href="{{route('recrutement.avenant_general')}}"   class="col-sm-3">
            <div >
                <div class="card" style="color: black">


                    <div class="card-body" style="text-align: center;">
                        <i class="fas fa-book fa-10x"></i>
                        </br></br>
                        <h4 class="card-title mb-3">AVENANT GENERAL</h4>
                        </br>
                        <p class="card-text" style="color: #0a0a0a">Permet de générer des demandes d'avenant Groupé
                        </p>
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </a>
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
@endsection