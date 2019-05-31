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
        <div class="col-sm-6">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
            <div class="table-responsive table-responsive-data2">
                <table class="table  table-earning" id="table_employe">
                    <thead>
                    <tr>
                        <th>PHB</th>
                        <th>EFFECTIF</th>
                    </tr>
                    </thead>
                    <tbody>

                            <tr class="tr-shadow">
                                <td>EXPATRIE</td>
                                <td>{{count($effectif_phb_exp)}}</td>
                            </tr>
                            <tr class="tr-shadow">
                                <td>LOCAUX</td>
                                <td>{{count($effectif_phb_locaux)}}</td>
                            </tr>
                            <tr class="tr-shadow">
                                <td>HOMME</td>
                                <td>{{count($effectif_phb_homme)}}</td>
                            </tr>
                            <tr class="tr-shadow">
                                <td>FEMME</td>
                                <td>{{count($effectif_phb_femme)}}</td>
                            </tr>
                            <tr class="tr-shadow">
                                <td>TOTAL PHB</td>
                                <td>{{count($effEiffage)}}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
            </div>
            </div>
            <!--fdgfgfdf-->
        </div>
        <div class="col-sm-6">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class="table  table-earning" id="table_employe">
                            <thead>
                            <tr>
                                <th>DIRECTION CI</th>
                                <th>EFFECTIF</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr class="tr-shadow">
                                <td>EXPATRIE</td>
                                <td>{{count($effectif_dir_exp)}}</td>
                            </tr>
                            <tr class="tr-shadow">
                                <td>LOCAUX</td>
                                <td>{{count($effectif_dir_locaux)}}</td>
                            </tr>
                            <tr class="tr-shadow">
                                <td>HOMME</td>
                                <td>{{count($effectif_dir_homme)}}</td>
                            </tr>
                            <tr class="tr-shadow">
                                <td>FEMME</td>
                                <td>{{count($effectif_dir_femme)}}</td>
                            </tr>
                            <tr class="tr-shadow">
                                <td>TOTAL DIRECTION CI</td>
                                <td>{{count($effectif_dir)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--fdgfgfdf-->
        </div>
        <div class="col-sm-6">
            <div class="card" style="height: 100% !important">
                <div class="card-body" >
                    <div class="table-responsive table-responsive-data2">
                        <table class="table  table-earning" id="table_employe">
                            <thead>
                            <tr>
                                <th>SPIE FONDATIONS</th>
                                <th>EFFECTIF</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr class="tr-shadow">
                                <td>EXPATRIE</td>
                                <td>{{count($effectif_spie_exp)}}</td>
                            </tr>
                            <tr class="tr-shadow">
                                <td>LOCAUX</td>
                                <td>{{count($effectif_spie_locaux)}}</td>
                            </tr>
                            <tr class="tr-shadow">
                                <td>HOMME</td>
                                <td>{{count($effectif_spie_homme)}}</td>
                            </tr>
                            <tr class="tr-shadow">
                                <td>FEMME</td>
                                <td>{{count($effectif_spie_femme)}}</td>
                            </tr>
                            <tr class="tr-shadow">
                                <td>TOTAL PHB</td>
                                <td>{{count($effspietotal)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--fdgfgfdf-->
        </div>


            <div class="col-lg-6">
                <h3>Autre partenaire</h3>
                <form action="{{route('modifier_effectif')}}" method="post"  class="form-horizontal">
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