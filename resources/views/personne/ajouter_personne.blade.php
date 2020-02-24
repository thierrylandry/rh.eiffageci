@extends('layouts.app')
@section('lister_personne'.$entite)
    active
    @endsection
@section('Ajouter_personne_block')
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
            border-radius: 100%;
            padding: 22px 18px 15px 18px;
            margin-top: -22px; }
        .steps-form-2 .steps-row-2 .steps-step-2 .btn-circle-2:hover {
            border: 2px solid #4285F4;
            color: #4285F4 !important;
            background-color: white !important; }
        .steps-form-2 .steps-row-2 .steps-step-2 .btn-circle-2 .fa {
            font-size: 1.7rem; }

        .lescheckeurs {
            height: 50px;
            width: 50px;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">PERSONNE-AJOUTER</h2>
            </div>
        </div>
    </div>
    </br>
    <div class="row">
        <div class="col-sm-12">
            <h2 class="text-center font-bold pt-4 pb-5 mb-5"><strong>Etape 1</strong></h2>

            <!-- Stepper -->
            <div class="steps-form-2">
                <div class="steps-row-2 setup-panel-2 d-flex justify-content-between">
                    <div class="steps-step-2 active" >
                        <button href="#step-1" type="button"  class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Basic Information"><i class="fa fa-user" aria-hidden="true"></i></button>
                    </div>
                    <div class="steps-step-2">
                        <button disabled type="button" style="background-color: gainsboro!important;" class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Personal Data"><i class="fa fa-folder" aria-hidden="true"></i></button>
                    </div>
                    <div class="steps-step-2">
                        <button href="#step-3" type="button" style="background-color: gainsboro !important;" class="btn btn-blue-grey btn-circle-2 waves-effect" data-toggle="tooltip" data-placement="top" title="Terms and Conditions"><i class="fa fa-file-text" aria-hidden="true"></i></button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </br>
    <div class="table-data__tool">
        <div class="table-data__tool-left">
        </div>
        <div class="table-data__tool-right">
            <a href="{{route('lister_personne',$entite)}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-view-list"></i>LISTER LES PERSONNES</a>
        </div>
    </div>
    <form action="{{route('enregistrer_personne')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf

        <div class="row">
            <div class="col-sm-12"   >
                <div class="card" style="height: 100% !important" >
                    <div class="card-header">
                        <strong>Les Entretiens </strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row">
                            <div class="col-sm-4" style="text-align: center">
                                <div>
                                    <label for="text-input" class=" form-control-label">Entretien du chef de service</label>
                                </div>
                                <div>
                                    <input type="checkbox" value="1" name="entretien_cs" class="lescheckeurs" {{isset($personne) && $personne->entretien_cs==1?'checked':''}}>
                                </div>
                            </div>
                            <div class="col-sm-4" style="text-align: center">
                                <div>
                                    <label for="text-input" class=" form-control-label">ENTRETIEN RH</label>
                                </div>
                                <div>
                                    <input type="checkbox"  class="lescheckeurs" value="1" name="entretien_rh" {{isset($personne) && $personne->entretien_rh==1?'checked':''}}>
                                </div>
                            </div>
                            <div class="col-sm-4" style="text-align: center">
                                <div>
                                    <label for="text-input" class=" form-control-label">VISITE MEDICALE</label>
                                </div>
                                <div>
                                    <input type="checkbox" class="lescheckeurs" value="1" name="visite_medicale"  {{isset($personne) && $personne->visite_medicale==1?'checked':''}}>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Date prévue</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="date" name="date_visite"  class="form-control" value="{{isset($personne)?$personne->date_visite:''}}">

                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>


            </div>
        </div>
        </br>

  <div class="row">
      <div class="col-lg-4">
          <div class="card" style="height: 100% !important">
              <div class="card-header">
                  <strong>Fiche</strong> Signalétique 1/2
              </div>
              <div class="card-body" >
      <div class="row form-group">
          <div class="col-12 col-md-9 pull-right"  >
              <img src="{{URL::asset('images/user.png')}}" id="rendu_img"style=";height: 200px;" class="fa fa-user"/>
              <input type="file" id="photo" name="photo" placeholder="photo" class="form-control">

          </div>
      </div>
                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label for="text-input" class=" form-control-label">Nom *</label>
                      </div>
                      <div class="col-12 col-md-9">
                          <input type="text" id="text-input" name="nom" placeholder="Nom" class="form-control" required>

                      </div>
                  </div>
                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label for="text-input" class=" form-control-label">Prénoms *</label>
                      </div>
                      <div class="col-12 col-md-9">
                          <input type="text" id="text-input" name="prenom" placeholder="Prénoms" class="form-control" required>
                      </div>
                  </div>
                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label for="text-input" class=" form-control-label">Date de naissance*</label>
                      </div>
                      <div class="col-12 col-md-9">
                          <input type="date" id="datenaissancet" name="datenaissance"  class="form-control" required>

                      </div>

                  </div>
                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label for="text-input" class=" form-control-label">Lieu de naissance*</label>
                      </div>
                      <div class="col-12 col-md-9">
                          <input type="text" id="lieu_naissance" name="lieu_naissance"  class="form-control" required>

                      </div>

                  </div>
                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label for="text-input" class=" form-control-label">Nom et prénom du père *</label>
                      </div>
                      <div class="col-12 col-md-9">
                          <input type="text" id="text-input" name="noms_pere" placeholder="Nom et prénoms du père" class="form-control" required>
                      </div>
                  </div>
                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label for="text-input" class=" form-control-label">Nom et prénom de la mère mère *</label>
                      </div>
                      <div class="col-12 col-md-9">
                          <input type="text" id="text-input" name="noms_mere" placeholder="Nom et prénoms de la mère" class="form-control" required>
                      </div>
                  </div>
                  <div class="row form-group">

                      <div class="col-12 col-md-9">
                          <p id="age" style="color: red">   </p>

                      </div>

                  </div>

      </div>
             </div>
      </div>

      <div class="col-lg-4">
          <div class="card"  style="height: 100% !important">
              <div class="card-header">
                  <strong>Fiche</strong> Signalétique 2/2
              </div>
              <div class="card-body card-block">


                      <div class="row form-group">
                          <div class="col col-md-3">
                              <label for="text-input" class=" form-control-label">Sexe</label>
                          </div>
                          <div class="col-12 col-md-9">
                              <div class="col col-md-9">
                                  <div class="form-check">
                                      <div class="radio">
                                          <label for="radio1" class="form-check-label ">
                                              <input type="radio" id="sexe1" name="sexe" value="M" class="form-check-input" checked>Masculin
                                          </label>
                                      </div>
                                      <div class="radio">
                                          <label for="radio2" class="form-check-label ">
                                              <input type="radio" id="sexe2" name="sexe" value="F" class="form-check-input" >Feminin
                                          </label>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3">
                              <label for="text-input" class=" form-control-label">Nationalité*</label>
                          </div>
                          <div class="col-12 col-md-9">
                              <select name="nationnalite" id="nationnalite" required class="form-control">
                                  @foreach($payss as $pays)

                                       <option value="{{$pays->id}}" @if($pays->alpha2=='CI') selected @endif> {{$pays->nom_fr_fr}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="row form-group">
                          <div class="col col-md-3">
                              <label for="text-input" class=" form-control-label">Situation matrimo.</label>
                          </div>
                          <div class="col col-md-8">
                              <div class="form-check">
                                  <div class="radio">
                                      <label for="radio1" class="form-check-label ">
                                          <input type="radio"  name="sit" value="1" class="form-check-input" checked>Célibataire
                                      </label>
                                  </div>
                                  <div class="radio">
                                      <label for="radio2" class="form-check-label ">
                                          <input type="radio"  name="sit" value="2" class="form-check-input">Marié(e)
                                      </label>
                                  </div>
                                  <div class="radio">
                                      <label for="radio3" class="form-check-label ">
                                          <input type="radio"  name="sit" value="3" class="form-check-input">Divorcé(e)
                                      </label>
                                  </div>
                                  <div class="radio">
                                      <label for="radio3" class="form-check-label ">
                                          <input type="radio"  name="sit" value="4" class="form-check-input">Veuf(ve)
                                      </label>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3">
                              <label for="text-input" class=" form-control-label">Nombre d'enfant*</label>
                          </div>
                          <!--fin-->
                          <div class="col-12 col-md-9">
                              <input type="number" min="0" id="text-input" name="nb_enf" placeholder="Nombre d'enfant" class="form-control" value="0" required>
                          </div>
                      </div>

                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label for="text-input" class=" form-control-label">E-mail:</label>
                      </div>
                      <!--fin-->
                      <div class="col-12 col-md-9">
                          <input type="text" id="text-input" name="email" placeholder="email" class="form-control">
                      </div>
                  </div>
                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label for="text-input" class=" form-control-label">Contact:</label>
                      </div>
                      <!--fin-->
                      <div class="col-12 col-md-9">
                          <input type="text" min="0" id="text-input" name="contact" placeholder="Contact" class="form-control" required="required">
                      </div>
                  </div>
                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label for="text-input" class=" form-control-label"> Whatsapp </label>
                      </div>
                      <!--fin-->
                      <div class="col-12 col-md-9">
                          <input type="text"  id="text-input" name="whatsapp" placeholder="whatsapp" class="form-control">
                      </div>
                  </div>

                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label for="text-input" class=" form-control-label">Sattellitaire </label>
                      </div>
                      <!--fin-->
                      <div class="col-12 col-md-9">
                          <input type="text" id="text-input" name="sattelitaire" placeholder="Sattellitaire" class="form-control">
                      </div>
                  </div>

                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label for="text-input" class=" form-control-label">Adresse :</label>
                      </div>
                      <!--fin-->
                      <div class="col-12 col-md-9">
                          <input type="text" id="text-input" name="adresse" placeholder="Adresse" class="form-control">
                      </div>
                  </div>
                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label for="text-input" class=" form-control-label">Commune </label>
                      </div>
                      <!--fin-->
                      <div class="col-12 col-md-9">
                          <select name="commune" id="commune" required>
                              <option value=""></option>
                              @foreach($communes  as $commune):
                              <option value="{{$commune->id}}">{{$commune->libelle}}</option>
                              @endforeach

                          </select>
                      </div>
                  </div>



              </div>

          </div>
      </div>
      <div class="col-lg-4">
          <div class="card"  style="height: 100% !important">
              <div class="card-header">
                  <strong>Information </strong> Employé(e)
              </div>
              <div class="card-body card-block">

                      <div class="row form-group">
                          <div class="col col-md-3">
                              <label for="text-input" class=" form-control-label">CNPS</label>
                          </div>
                          <div class="col-12 col-md-9">
                              <input type="text" id="text-input" name="cnps" placeholder="CNPS" class="form-control">
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3">
                              <label for="text-input" class=" form-control-label">RIB </label>
                          </div>
                          <div class="col-12 col-md-9">
                              <input type="text" id="text-input" name="rib" placeholder="RIB" class="form-control">
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3">
                              <label for="text-input" class=" form-control-label">Rhesus Sanguin </label>
                      </div>
                          <div class="col-12 col-md-9">
                              <select class="form-control" name="rh">
                                    <option value="">SELECTIONNER</option>
                                  <option value="AB-">AB-</option>
                                  <option value="A-">A-</option>
                                  <option value="B-">B-</option>
                                  <option value="O-">O-</option>
                                  <option value="O+">O+</option>
                                  <option value="B+">B+</option>
                                  <option value="A+">A+</option>
                                  <option value="AB+">AB+</option>
                              </select>

                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3">
                              <label for="text-input" class=" form-control-label">Fonction  </label>
                          </div>
                          <div class="col-12 col-md-9">
                              <select name="fonction" id="fonction" required class="form-control" required>
                                  <option value="">SELECTIONNER</option>
                                  @foreach($fonctions as $fonction)

                                      <option value="{{$fonction->id}}"> {{$fonction->libelle}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="row form-group">
                          <div class="col col-md-3">
                              <label for="text-input" class=" form-control-label">Entite</label>
                          </div>
                          <div class="col-12 col-md-9">
                              <select name="entite" id="disabledSelect" class="form-control">
                                  @foreach($entites as $entite)

                                      <option value="{{$entite->id}}"> {{$entite->libelle}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3">
                              <label for="text-input" class=" form-control-label">Unité</label>
                          </div>
                          <div class="col-12 col-md-9">
                              <select name="unite" id="societe"  onchange="getval()" class="form-control">
                                  @foreach($societes as $societe)
                                      <option value="{{$societe->id_unite}}">{{$societe->libelleUnite}}</option>
                                      @endforeach
                              </select>
                          </div>
                      </div>
                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label for="text-input" class=" form-control-label">Sureté</label>
                      </div>
                      <div class="col-12 col-md-9">
                         <label> Oui : <input type="radio" name="surete" id="sureteOui" value='1' /></label>
                         <label> Non : <input type="radio" name="surete" value='0' id="sureteNon" checked/></label>
                      </div>
                  </div>
                      <div class="row form-group">
                          <div class="col col-md-3">
                              <label for="text-input" class=" form-control-label">Pointure chaussure </label>
                          </div>
                          <div class="col-12 col-md-9">
                              <input type="number" min="35" max="50" value="35" id="text-input" name="pointure" placeholder="Pointure" class="form-control">
                          </div>
                      </div>
                  <div class="row form-group">
                      <div class="col col-md-3">
                          <label for="text-input" class=" form-control-label">Taille t-shirt </label>
                      </div>
                      <div class="col-12 col-md-9">
                          <select class="form-control " name="taille">
                              <option value="XS">XS</option>
                              <option value="S">S</option>
                              <option value="M">M</option>
                              <option value="L">L</option>
                              <option value="XL">XL</option>
                              <option value="XXL">XXL</option>
                              <option value="XXXL">XXXL</option>
                          </select>
                      </div>
                  </div>

              </div>
          </div>
      </div>
  </div>
        </br>
        <div class="row">
            <div class="col-sm-12"   >
                <div class="card" style="height: 100% !important" >
                    <div class="card-header">
                        <strong>Pièces </strong>
                    </div>
                    <div class="card-body card-block">
                        Ajouter une pièce
                        <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addpiece">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>
                        </br>
                        </br>
                        <div id="pieces" class="form-inline">

                            <div class=" form-control-label">
                                <label for="observation_c[]">type de pièce</label>
                                <div class="form-group col-sm-12">
                                    <select type="text" name="type_p_piece[]" class="type_c form-control input-field">
                                        <option value="CC"> CARTE CONSULAIRE</option>
                                        <option value="CR">CARTE DE RESIDENTS</option>
                                        <option value="VIS">VISA</option>
                                        <option value="PSP">PASSEPORT</option>
                                        <option value="CNI">CARTE NATIONAL D'IDENTITE</option>
                                        <option value="ATTN">ATTESTATION D'IDENTITE</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-control-label">
                                <label for="observation_c[]">N°pièce</label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="text" name="num_p_piece[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-control-label">
                                <label for="observation_c[]">Date d'expiration</label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="date" name="date_exp_piece[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('date_exp[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                        </div>
                        <div id="piecetemplate" class="row clearfix" style="display: none">
                            <div class=" form-control-label">
                                <label for="observation_c[]">type de pièce</label>
                                <div class="form-group col-sm-12">
                                    <select type="text" name="type_p_piece[]" class="type_c form-control input-field">
                                        <option value="CC"> CARTE CONSULAIRE</option>
                                        <option value="CR">CARTE DE RESIDENTS</option>
                                        <option value="VIS">VISA</option>
                                        <option value="PSP">PASSEPORT</option>
                                        <option value="CNI">CARTE NATIONAL D'IDENTITE</option>
                                        <option value="ATTN">ATTESTATION D'IDENTITE</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-control-label">
                                <label for="observation_c[]">N°pièce</label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="text" name="num_p_piece[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('valeur_c[]') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-control-label">
                                <label for="observation_c[]">Date d'expiration</label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="date" name="date_exp_piece[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('date_exp[]') }}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="row">
            <div class="col-sm-12"   >
                <div class="card" style="height: 100% !important" >
                    <div class="card-header">
                        <strong>Familles </strong>
                    </div>
                    <div class="card-body card-block">
                    Ajouter un membre
                    <button type="button" class="btn bg-teal btn-circle waves-effect waves-circle waves-float" id="addfamille">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </button>
                    </br>
                    </br>
                    <div id="familles" class="form-inline">

                        <div class=" form-control-label">
                            <label for="titre_c[]">Nom et prénom </label>
                            <div class="form-group col-sm-12">
                                <div class="form-line">
                                    <input type="text" name="nom_famille[]" class="titre_c form-control" placeholder="" value="{{ old('fullname_c[]') }}">
                                </div>
                            </div>
                        </div>
                        <div class=" form-control-label">
                            <label for="observation_c[]">Lien de parenté</label>
                            <div class="form-group col-sm-12">
                                <select type="text" name="lien[]" class="type_c form-control input-field">

                                    <option value="CONJ"> CONJOINT</option>
                                    <option value="ENF">ENFANT</option>

                                </select>
                            </div>
                        </div>
                        <div class=" form-control-label">
                            <label for="observation_c[]">type de pièce</label>
                            <div class="form-group col-sm-12">
                                <select type="text" name="type_p[]" class="type_c form-control input-field">
                                    <option value="CC"> CARTE CONSULAIRE</option>
                                    <option value="CR">CARTE DE RESIDENTS</option>
                                    <option value="VIS">VISA</option>
                                    <option value="PSP">PASSEPORT</option>
                                    <option value="CNI">CARTE NATIONAL D'IDENTITE</option>
                                    <option value="ATTN">ATTESTATION D'IDENTITE</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-control-label">
                            <label for="observation_c[]">N°pièce</label>
                            <div class="form-group col-sm-12">
                                <div class="form-line">
                                    <input type="text" name="num_p[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('num_p[]') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-control-label">
                            <label for="observation_c[]">Date d'expiration</label>
                            <div class="form-group col-sm-12">
                                <div class="form-line">
                                    <input type="date" name="date_exp[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('date_exp[]') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-control-label">
                            <label for="observation_c[]">Presence Effective</label>
                            <div class="form-group col-sm-12">
                                <div class="form-line">
                                    <select type="text" name="presence_effective[]" class="type_c form-control input-field">
                                        <option value="P">PRESENT</option>
                                        <option value="ABS">ABSENT</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr width="100%" color="blue">
                    </div>
                    <div id="familletemplate" class="row clearfix" style="display: none">

                        <div class=" form-control-label">
                            <label for="titre_c[]">Nom et prénom </label>
                            <div class="form-group col-sm-12">
                                <div class="form-line">
                                    <input type="text" name="nom_famille[]" class="titre_c form-control" placeholder="" value="{{ old('fullname_c[]') }}">
                                </div>
                            </div>
                        </div>
                        <div class=" form-control-label">
                            <label for="observation_c[]">Lien de parenté</label>
                            <div class="form-group col-sm-12">
                                <select type="text" name="lien[]" class="type_c form-control input-field">

                                    <option value="CONJ"> CONJOINT</option>
                                    <option value="ENF">ENFANT</option>

                                </select>
                            </div>
                        </div>
                        <div class=" form-control-label">
                            <label for="observation_c[]">type de pièce</label>
                            <div class="form-group col-sm-12">
                                <select type="text" name="type_p[]" class="type_c form-control input-field">
                                    <option value="CC"> CARTE CONSULAIRE</option>
                                    <option value="CR">CARTE DE RESIDENTS</option>
                                    <option value="VIS">VISA</option>
                                    <option value="PSP">PASSEPORT</option>
                                    <option value="CNI">CARTE NATIONAL D'IDENTITE</option>
                                    <option value="ATTN">ATTESTATION D'IDENTITE</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-control-label">
                            <label for="observation_c[]">N°pièce</label>
                            <div class="form-group col-sm-12">
                                <div class="form-line">
                                    <input type="text" name="num_p[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('valeur_c[]') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-control-label">
                            <label for="observation_c[]">Date d'expiration</label>
                            <div class="form-group col-sm-12">
                                <div class="form-line">
                                    <input type="date" name="date_exp[]" class="valeur_c form-control" placeholder="Valeur" value="{{ old('date_exp[]') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-control-label">
                            <label for="observation_c[]">Presence Effective</label>
                            <div class="form-group col-sm-12">
                                <div class="form-line">
                                    <select type="text" name="presence_effective[]" class="type_c form-control input-field">
                                        <option value="P">PRESENT</option>
                                        <option value="ABS">ABSENT</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr width="100%" color="blue">
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
    </div>
    </form>
    <script src="{{ asset("vendor/jquery-3.2.1.min.js") }}"></script>
    <script src="{{ asset("js/select2.full.js") }}">
    </script>
    <script>
        function getval()
        {
          //  d = document.getElementById("societe").value;
            //alert(d);
        }



        $("#datenaissancet").change(function(e){
            var dob = new Date($('#datenaissancet').val());
            var today = new Date();
            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
            $('#age').html('Age : '+age+' Ans');
        });
        $('#nationnalite').select2({ placeholder: 'Select an option'});
        $('#commune').select2({ placeholder: 'Selectionner une commune'});
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    console.log(input.files[0]);
                    console.log(input.files[0].type);
                    if(input.files[0].type=="image/jpeg" || input.files[0].type=="image/png" ){
                        if(input.files[0].size<=1000024){

                            console.log('cool');
                            $('#rendu_img').attr('src', e.target.result);
                        }else{
                            alert('trop volumineux');

                            input.value='';
                            $('#rendu_img').attr('src','images/user.png');
                        }
                    }else{
                        alert('le ficher doit être de type jpeg ou png exclusivement');

                        input.value='';
                        $('#rendu_img').attr('src','images/user.png');
                    }


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
    <script type="application/javascript">
        $("#addfamille").click(function (e) {
            $($("#familletemplate").html()).appendTo($("#familles"));
        });
  $("#addpiece").click(function (e) {
            $($("#piecetemplate").html()).appendTo($("#pieces"));
        });

    </script>
@endsection