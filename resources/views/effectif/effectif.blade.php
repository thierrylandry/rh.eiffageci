@extends('layouts.app')
@section('lister_effectif')
    active
@endsection
@section('lister_effectif_block');
style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">EFFECTIF - DETAIL </h2>
            </div>
        </div>
    </div>
    </br>
    <div class="row">
            <div class="col-lg-6">
                <h3>Autre partenaire</h3>
                <form action="" method="post"  class="form-horizontal">
                    @csrf
                    @foreach($effectifs as  $effectif)
                <div class="card" style="height: 100% !important">
                    <div class="card-body" >
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <input type="hidden" id="text-input" name="id_partenaire" placeholder="Nom" value="{{isset($effectif)? $effectif->id:''}}" class="form-control" readonly required>

                                <label for="text-input" class=" form-control-label">Nom *</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="nom" placeholder="Nom" value="{{isset($effectif)? $effectif->nom:''}}" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Effectif *</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" id="text-input" name="effectif" placeholder="Effectif" class="form-control" value="{{isset($effectif)? $effectif->effectif:''}}" required>
                            </div>
                        </div>
                    </div>
                </div>
                    @endforeach
                    <input type="submit" class="btn btn-success pull-right" value="ENREGISTRER" />
                    </form>
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
@endsection