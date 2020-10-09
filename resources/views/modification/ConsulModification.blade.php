@extends('layouts.app')
@section('pole_demande')
    active
@endsection
@section('pole_demande_block')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <a href="{{route('modification.demande')}}" class="card col-sm-4">
            <div style="color: deepskyblue">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-plus fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Demande</h4>
                </div>
            </div>
        </a>
        <a href="{{route('modification.validation')}}" class="card col-sm-4">
            <div    style="color: deepskyblue">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-clipboard-check fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Validation</h4>
                </div>

            </div>
        </a>
        <a href="{{route('modification.gestion')}}" class="card col-sm-4">
            <div    style="color: deepskyblue">
                <div class="card-body" style="text-align: center;">
                    <i class="fas fa-list-ol fa-3x"></i>
                    </br></br>
                    <h4 class="card-title mb-3">Gestion</h4>
                </div>

            </div>
        </a>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">DEMANDE DE MODIFICATION N°{{$modification->id}}</h2>
            </div>
        </div>
    </div>
    <div class="row">

    </div>
    <div class="table-data__tool">
        <div class="table-data__tool-left">
            <div class="table-data__tool  pull-right">
                @if(isset($modification))
                    <div class="table-data__tool-right">
                        <a href="{{back()->getTargetUrl()}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-long-arrow-return"></i>RETOUR</a>
                    </div>
                @endif
            </div>
        </div>
        <!--place ici les bouton -->
    </div>
<div class="row">

    <div class="col-lg-12">
        <div class="card" style="height: 100% !important">
            <div class="card-header">
                <strong>Liste des modifications</strong>
            </div>
            <div class="card-body" >
                <div class="row">

                    <div class="col-sm-12">
                        <div class="row">
                            @if(isset($modification))
                                <table border="1" style="border:1px; text-align: center" width="100%">
                                    @foreach(json_decode($modification->list_modif) as $modif)

                                        @switch($modif)
                                        @case("Le service")


                                        <tr>
                                            <td colspan="2">{{$modif}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Nouvelle valeur</td>
                                            <td width="50%">Ancienne valeur</td>
                                        </tr>
                                        <tr>
                                            <td style="color: #00a2e3;">{{isset($modification)?$modification->service()->first()->libelle:''}}</td>
                                            <td>{{isset($contrat)?$contrat->service()->first()->libelle:''}}</td>
                                        </tr>



                                        @break

                                        @case("La durée hebdomadaire de travail")
                                        <tr>
                                            <td colspan="2">{{$modif}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Nouvelle valeur</td>
                                            <td width="50%">Ancienne valeur</td>
                                        </tr>
                                        <tr>
                                            <td style="color: #00a2e3;">{{isset($modification)?$modification->regime:''}}</td>
                                            <td>{{isset($modification)?$modification->regime_initial:''}}</td>
                                        </tr>

                                        @break
                                        @case("La fonction")
                                        <tr>
                                            <td colspan="2">{{$modif}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Nouvelle valeur</td>
                                            <td width="50%">Ancienne valeur</td>
                                        </tr>
                                        <tr>
                                            <td style="color: #00a2e3;">{{isset($modification->fonction()->first()->libelle)?$modification->fonction()->first()->libelle:''}}</td>
                                            <td>{{isset($modification->fonction_initial()->first()->libelle)?$modification->fonction_initial()->first()->libelle:''}}</td>
                                        </tr>

                                        @break
                                        @case("Le type de contrat")
                                        <tr>
                                            <td colspan="2">{{$modif}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Nouvelle valeur</td>
                                            <td width="50%">Ancienne valeur</td>
                                        </tr>
                                        <tr>
                                            <td style="color: #00a2e3;">{{isset($modification)?$modification->type_contrat->libelle:''}}</td>
                                            <td>{{isset($modification)?$modification->type_contrat_initial->libelle:''}}</td>
                                        </tr>

                                        @break
                                        @case("La date de fin")
                                        <tr>
                                            <td colspan="2">{{$modif}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Nouvelle valeur</td>
                                            <td width="50%">Ancienne valeur</td>
                                        </tr>
                                        <tr>
                                            <td style="color: #00a2e3;">{{isset($modification)?date("d-m-Y", strtotime($modification->dateFinC)):''}}</td>
                                            <td>{{isset($modification)?date("d-m-Y", strtotime($modification->datefinc_initial)):''}}</td>
                                        </tr>
                                        @break
                                        @case("La définition")
                                        <tr>
                                            <td colspan="2">{{$modif}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Nouvelle valeur</td>
                                            <td width="50%">Ancienne valeur</td>
                                        </tr>
                                        <tr>
                                            <td style="color: #00a2e3;">{{isset($modification->definition)?$modification->definition->libelle:''}}</td>
                                            <td>{{isset($contrat->definition)?$contrat->definition->libelle:''}}</td>
                                        </tr>

                                        @break
                                        @case("La catégorie")
                                        <tr>
                                            <td colspan="2">{{$modif}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Nouvelle valeur</td>
                                            <td width="50%">Ancienne valeur</td>
                                        </tr>
                                        <tr>
                                            <td style="color: #00a2e3;">{{isset($modification)?$modification->id_categorie:''}}</td>
                                            <td>{{isset($modification)?$modification->id_categorie_initial:''}}</td>
                                        </tr>

                                        @break
                                        @case("Les conditions de rémunérations")

                                        <tr>
                                            <td colspan="2">{{$modif}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Nouvelle valeur</td>
                                            <td width="50%">Ancienne valeur</td>
                                        </tr>
                                        <tr style="color: #00a2e3;">
                                            <td>{{isset($modification)?$modification->budgetMensuel:''}}</td>
                                            <td>
                                                <?php $affiche=0;
                                                if(isset($contrat->valeurSalaire)){
                                                    foreach(json_decode($contrat->valeurSalaire) as $valeurSalaire):
                                                        $affiche+=$valeurSalaire->valeur;
                                                    endforeach;
                                                    echo $affiche;
                                                }


                                                ?></td>
                                        </tr>

                                        @break
                                            @case("Le budget mensuel")

                                        <tr>
                                            <td colspan="2">{{$modif}}</td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Nouvelle valeur</td>
                                            <td width="50%">Ancienne valeur</td>
                                        </tr>
                                        <tr style="color: #00a2e3;">
                                            <td>{{isset($modification)?$modification->budgetMensuel:''}}</td>
                                            <td>
                                                <?php $affiche=0;
                                                if(isset($contrat->valeurSalaire)){
                                                    foreach(json_decode($contrat->valeurSalaire) as $valeurSalaire):
                                                        $affiche+=$valeurSalaire->valeur;
                                                    endforeach;
                                                    echo $affiche;
                                                }


                                                ?></td>
                                        </tr>

                                        @break
                                        @default

                                        @endswitch
                                    @endforeach
                                </table>
                            @endif
                        </div>
                        </br>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
    </br>
    </br>
    </br>
    </br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>Condition de rémunération</strong>
                </div>
                <div class="card-body" >
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset("vendor/jquery-3.2.1.min.js") }}"></script>
    <script type="application/javascript">
        $("#addfamille").click(function (e) {
            $($("#familletemplate").html()).appendTo($("#familles"));
        });
        $("#addpiece").click(function (e) {
            $($("#piecetemplate").html()).appendTo($("#pieces"));
        });
    </script>
@endsection
