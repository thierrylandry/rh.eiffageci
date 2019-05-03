@extends('layouts.app')
@section('page')

                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Tableau de bord</h2>
                        </div>

                    </div>
                </div>
                </br>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="au-card m-b-30">
                            <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Effectifs globaux Projet ESF</h3>
                                <canvas id="effectif_globaux"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="au-card m-b-30">
                            <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Effectifs locaux EGC CI</h3>
                                <canvas id="effectif_locaux"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="au-card m-b-30">
                            <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Répartition H/F - Personnel local EGC CI</h3>
                                <canvas id="repartition_h_f"></canvas>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="au-card m-b-30">
                            <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Tranche d'Age</h3>
                                <canvas id="tranche_age"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="au-card m-b-30">
                            <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Ancienneté locaux EGC CI</h3>
                                <canvas id="anciennete_locaux"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="au-card m-b-30">
                            <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Qualification contractuelle  personnel local EGC CI</h3>
                                <canvas id="qualification_contractuel"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">


                    <div class="col-lg-4">
                        <div class="au-card m-b-30">
                            <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Nationalités - Personnel local EGC CI</h3>
                                <canvas id="nationalite"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="au-card m-b-30">
                            <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Services - Personnel local EGC CI</h3>
                                <canvas id="service_personnel"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="au-card m-b-30">
                            <div class="au-card-inner">
                                <h3 class="title-2 m-b-40">Bilan Entrées et Sorties EGC CI</h3>
                                <canvas id="bilan"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p>Copyright © 2019 Eiffage. All rights reserved.</p>
                        </div>
                    </div>
                </div>
<input type="text" value="{{isset($json_eff_globaux)?$json_eff_globaux:''}}" id="json_eff_globaux">
<input type="text" value="{{isset($json_entite)?$json_entite:''}}" id="json_entite">
<input type="text" value="{{isset($json_h_f)?$json_h_f:''}}" id="json_h_f">

@endsection