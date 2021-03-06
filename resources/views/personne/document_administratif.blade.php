@extends('layouts.app')
@section('document_administratif')
    active
@endsection
@section('document_administratif_block')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">PERSONNE-DOCUMENT ADMINISTRATIF</h2>
            </div>
        </div>
    </div>
    </br>
    @include('personne.menu_retour')
    <form action="{{route('save_document')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
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