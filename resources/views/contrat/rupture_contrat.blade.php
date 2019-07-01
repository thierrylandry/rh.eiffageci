@extends('layouts.app')
@section('document_administratif')
    active
@endsection
@section('document_administratif_block')
    style="display: block;"
@endsection
@section('page')
    <style>
        .steps-form-2 {
            display: table ;
            width: 100%;
            position: relative; }
        .steps-form-2 .steps-row-2 {
            display: table-row; }
        .steps-form-2 .steps-row-2:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 2px;
            background-color: #7283a7; }
        .steps-form-2 .steps-row-2 .steps-step-2 {
            display: table-cell;
            text-align: center;
            position: relative; }
        .steps-form-2 .steps-row-2 .steps-step-2 p {
            margin-top: 0.5rem; }
        .steps-form-2 .steps-row-2 .steps-step-2 button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important; }
        .steps-form-2 .steps-row-2 .steps-step-2 .btn-circle-2 {
            width: 70px;
            height: 70px;
            border: 2px solid #59698D;
            background-color: white !important;
            color: #59698D !important;
            border-radius: 50%;
            padding: 22px 18px 15px 18px;
            margin-top: -22px; }
        .steps-form-2 .steps-row-2 .steps-step-2 .btn-circle-2:hover {
            border: 2px solid #4285F4;
            color: #4285F4 !important;
            background-color: white !important; }
        .steps-form-2 .steps-row-2 .steps-step-2 .btn-circle-2 .fa {
            font-size: 1.7rem; }

    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">CONTRAT - RUPTURE</h2>
            </div>
        </div>
    </div>
    </br>

    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h4 class="title-1">  {{" NOM : ". $personne->nom." ".$personne->prenom}}</h4>
            </div>
            <div class="table-data__tool  pull-right">
                <div class="table-data__tool-right">

                    <a href="{{url()->previous()}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="zmdi zmdi-long-arrow-return"></i>Retour</a>
                </div>&nbsp;
            </div>
        </div>

    </div>

    </br>

    @if(isset($contrat))
        <form action="{{route('rompre')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
            @else
                <form action="{{route('save_contrat')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @endif
                    @csrf
                    <input type="hidden" id="text-input" name="slug" placeholder="Nom" value="{{isset($personne)? $personne->slug:''}}" class="form-control" required>
                    <input type="hidden" id="text-input" name="id_contrat" placeholder="Nom" value="{{isset($contrat)? $contrat->id:''}}" class="form-control" required>

                    <div class="row">
                        <div class="col-sm-6 top-campaign ">

                            <div class="">


                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="text-input" class=" form-control-label">Date depart définitif :</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="date" name="departdefinitif" class="form-control" value="{{isset($contrat)?$contrat->departDefinitif:''}}" />
                                        </div>
                                    </div>

                            </div>


                        </div>
                    </div>
                    <div class="card-footer pull-right">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="zmdi zmdi-edit"></i> Enregistrer
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm" id="reset">
                            <i class="fa fa-ban"></i> Réinitialiser
                        </button>
                    </div>
                </form>

@endsection