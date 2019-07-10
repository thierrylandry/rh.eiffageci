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
            width: 250px;
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
                <h2 class="title-1">PERSONNE-DOCUMENT ADMINISTRATIF</h2>
            </div>
        </div>
    </div>
    </br>
    <div class="row">
        <div class="col-sm-12">
            <h2 class="text-center font-bold pt-4 pb-5 mb-5"><strong>Etape 2</strong></h2>

            <!-- Stepper -->
            <div class="steps-form-2">
                <div class="steps-row-2 setup-panel-2 d-flex justify-content-between">
                    <div class="steps-step-2 active" >
                        <button href="#step-1" type="button" style="background-color: gainsboro!important;"  class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Basic Information"><i class="fa fa-user" aria-hidden="true"></i></button>
                    </div>
                    <div class="steps-step-2">
                        <button disabled type="button"  class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Personal Data"><i class="fa fa-folder" aria-hidden="true"></i></button>
                    </div>
                    <div class="steps-step-2">
                        <button href="#step-3" type="button" style="background-color: gainsboro !important;" class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Terms and Conditions"><i class="fa fa-file-text" aria-hidden="true"></i></button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </br>

    <form action="{{route('save_document_new_user')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <input type="hidden" id="text-input" name="slug" placeholder="Nom" value="{{isset($personne)? $personne->slug:''}}" class="form-control" required>

<div class="row">
    <div class="col-lg-12">
        <!-- TOP CAMPAIGN-->
        <div class="top-campaign">
            <h3 class="title-3 m-b-30">{{$personne->nom.' '.$personne->prenom}}</h3>
            <div class="table-responsive">
                <table class="table table-top-campaign">
                    <tbody>
                    @foreach($list_administratif as $list)
                        <tr>
                            <td>{{$i=$loop->index + 1}}</td>
                            <td>{{$list->libelle}}</td>
                            <td> <label class="au-checkbox"> <input type="checkbox"  name="existance_{{$list->id}}" value="1" @foreach($doc_admins as $doc)
                                        @if($doc->type_doc==$list->id)
                                            {{'checked'}}
                                                @endif
                                            @endforeach> <span class="au-checkmark"></span></label></td>
                            <td> @foreach($doc_admins as $doc)
                                    @if($doc->type_doc==$list->id && $doc->pj!="")
                                        <a target="_blank" href="{{route('download_doc',[$personne->slug,str_replace('.','_',$doc->pj)])}}">{{$doc->pj}}</a> <a class="btn btn-danger" href="{{route('supprimer_doc',[$personne->slug,str_replace('.','_',$doc->pj),$list->id])}}">Supprimer</a>
                                        @break;
                                    @endif
                                @endforeach <input type="file" name="pj_{{$list->id}}"/></td>
                        </tr>
                        @if($i==8)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endif
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!--  END TOP CAMPAIGN-->
    </div>
</div>
        <div class="card-footer pull-right">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="zmdi zmdi-edit"></i> Enregistrer & suivant
            </button>
            <button type="reset" class="btn btn-danger btn-sm" id="reset">
                <i class="fa fa-ban"></i> Réinitialiser
            </button>
        </div>
    </form>

@endsection