@extends('layouts.app')
@section('pole_demande')
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
        <a href="#"  data-toggle="modal" data-target="#polerecrutement" data-placement="top" class="col-sm-3">
            <div >
                <div class="card" style="color: green">


                    <div class="card-body" style="text-align: center;">
                        <i class="fas fa-user-plus fa-10x"></i>
                        </br></br>
                        <h4 class="card-title mb-3">Recrutement</h4>
                        </br>
                        <p class="card-text" style="color: #0a0a0a">Effectuez et gérer vos demandes de recrutement
                        </p>
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </a>
            <a href="#"  data-toggle="modal" data-target="#polemodification" data-placement="top" class="col-sm-3">

            <div >
                <div class="card" style="color: deepskyblue">


                    <div class="card-body" style="text-align: center;">
                        <i class="fas fa-user fa-10x"></i>
                        </br></br>
                        <h4 class="card-title mb-3">Renouvellement & avenant</h4>
                        </br>
                        <p class="card-text" style="color: #0a0a0a">Effectuez et gérer vos renouvellement et avenant de contrat
                        </p>
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </a>
        
        <a href="#"  data-toggle="modal" data-target="#poleabsence" data-placement="top" class="col-sm-3">
            <div >
                <div class="card" style="color: yellow">


                    <div class="card-body" style="text-align: center;">
                        <i class="fas fa-calendar fa-10x"></i>
                        </br>
                        </br>
                        <h4 class="card-title mb-3">Absence</h4>
                        </br>
                        <p class="card-text" style="color: #0a0a0a">Demander,consulter et gérer vos absences
                        </p>
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </a>
        <a href="#"  data-toggle="modal" data-target="#poleavion" data-placement="top" class="col-sm-3">
            <div >
                <div class="card" style="color: red">


                    <div class="card-body" style="text-align: center;">
                        <i class="fab fa-avianex fa-10x"></i>
                        </br></br>
                        <h4 class="card-title mb-3">Billet d'avion</h4>
                        </br>
                        <p class="card-text" style="color: #0a0a0a">Gérez vos demandes de billet d'avion
                        </p>
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </a>
        <a href="#"  data-toggle="modal" data-target="#poleconges" data-placement="top" class="col-sm-3">
            <div >
                <div class="card" style="color: orange">


                    <div class="card-body" style="text-align: center;">
                        <i class="fas fa-calendar fa-10x"></i>
                        </br></br>
                        <h4 class="card-title mb-3">Congé</h4>
                        </br>
                        <p class="card-text" style="color: #0a0a0a">Gérez vos demandes de congé
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