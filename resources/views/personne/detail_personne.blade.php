@extends('layouts.app')
@section('detail_personne')
    active
@endsection
@section('detail_personne_block')
    style="display: block;"
@endsection
@section('page')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">PERSONNE-DETAIL</h2>
            </div>
        </div>
    </div>
    </br>
    <div class="table-data__tool">
        <div class="table-data__tool-left">
        </div>
        <div class="table-data__tool-right">
            <a href="{{route('Ajouter_personne')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-plus"></i>AJOUTER PERSONNE</a>
            <a href="{{route('lister_personne')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-view-list"></i>LISTER LES PERSONNES</a>
        </div>
    </div>
    <form action="{{route('modifier_personne')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        <input type="hidden" id="text-input" name="slug" placeholder="Nom" value="{{isset($personne)? $personne->slug:''}}" class="form-control" required>

        <div class="row">
            <div class="col-lg-4">
                <div class="card" style="height: 100% !important">
                    <div class="card-header">
                        <strong>Fiche</strong> Signalétique 1/2
                    </div>
                    <div class="card-body" >
                        <div class="row form-group">
                            <div class="col-12 col-md-9"  >
                                <img src="{{isset($personne) && $personne->image!=''? Storage::url('app/images/'.$personne->image):URL::asset('images/user.png')}}" id="rendu_img"style=";max-height: 200px;" class="fa fa-user"/>
                                <input type="file" id="photo" name="photo" placeholder="photo" class="form-control">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Nom *</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="nom" placeholder="Nom" value="{{isset($personne)? $personne->nom:''}}" class="form-control" required>
                                <small class="form-text text-muted">une chaine de caractère</small>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Prénoms *</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="prenom" placeholder="Prénoms" class="form-control" value="{{isset($personne)? $personne->prenom:''}}" required>
                                <small class="form-text text-muted">une chaine de caractère</small>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Date de naissance*</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="date" id="datenaissancet" name="datenaissance"  class="form-control" value="{{isset($personne)? $personne->datenaissance:''}}" required>

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
                                                <input type="radio" id="sexe1" name="sexe" value="M" class="form-check-input" {{isset($personne)&& $personne->sexe=='M'? 'checked':''}}>Masculin
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label for="radio2" class="form-check-label ">
                                                <input type="radio" id="sexe2" name="sexe" value="F" class="form-check-input" {{isset($personne)&& $personne->sexe=='F'? 'checked':''}}>Feminin
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
                                    @if($personne->nationalite==$pays->id)
                                        <option value="{{$pays->id}}" selected> {{$pays->nom_fr_fr}}</option>
                                        @else
                                            <option value="{{$pays->id}}"> {{$pays->nom_fr_fr}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Situation matrimoniale </label>
                            </div>
                            <div class="col col-md-9">
                                <div class="form-check">
                                    <div class="radio">
                                        <label for="radio1" class="form-check-label ">
                                            <input type="radio"  name="sit" value="1" class="form-check-input" {{isset($personne)&& $personne->matrimonial==1 ? 'checked':''}}>Célibataire
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="radio2" class="form-check-label ">
                                            <input type="radio"  name="sit" value="2" class="form-check-input" {{isset($personne)&& $personne->matrimonial==2 ? 'checked':''}}>Marié(e)
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="radio3" class="form-check-label ">
                                            <input type="radio"  name="sit" value="3" class="form-check-input" {{isset($personne)&& $personne->matrimonial==3 ? 'checked':''}}>Divorcé(e)
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="radio3" class="form-check-label ">
                                            <input type="radio"  name="sit" value="4" class="form-check-input" {{isset($personne)&& $personne->matrimonial==4 ? 'checked':''}}>Veuf(ve)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Nombre d'enfant*</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min="0" id="text-input" name="nb_enf" placeholder="Nombre d'enfant" class="form-control" value="{{isset($personne)? $personne->enfant:0}}" required>
                                <small class="form-text text-muted">une chaine de caractère</small>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="card"  style="height: 100% !important">
                    <div class="card-header">
                        <strong>Information </strong> Employer
                    </div>
                    <div class="card-body card-block">

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">CNPS</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="cnps" placeholder="CNPS" value="{{isset($personne)? $personne->cnps:''}}" class="form-control">
                                <small class="form-text text-muted">une chaine de caractère</small>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">RIB </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="rib" placeholder="RIB" value="{{isset($personne)? $personne->rib:''}}" class="form-control">
                                <small class="form-text text-muted">une chaine de caractère</small>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Rhesus Sanguin </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-control" name="rh">
                                    <option value="">SELECTIONNER</option>
                                    <option value="AB-" {{isset($personne)&& $personne->rh="AB-"?'selected':''}}>AB-</option>
                                    <option value="A-" {{isset($personne)&& $personne->rh="A-"?'selected':''}}>A-</option>
                                    <option value="B-" {{isset($personne)&& $personne->rh="B-"?'selected':''}}>B-</option>
                                    <option value="O-" {{isset($personne)&& $personne->rh="O-"?'selected':''}}>O-</option>
                                    <option value="O+" {{isset($personne)&& $personne->rh="O+"?'selected':''}}>O+</option>
                                    <option value="B+" {{isset($personne)&& $personne->rh="B+"?'selected':''}}>B+</option>
                                    <option value="A+" {{isset($personne)&& $personne->rh="A+"?'selected':''}}>A+</option>
                                    <option value="AB+" {{isset($personne)&& $personne->rh="AB+"?'selected':''}}>AB+</option>
                                </select>

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Fonction  </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="fonction" id="fonction" required class="form-control" required>
                                    <option vzlue="">SELECTIONNER</option>
                                    @foreach($fonctions as $fonction)

                                        <option value="{{$fonction->id}}" {{$fonction->id==$personne->fonction?'selected':''}}> {{$fonction->libelle}}</option>
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
                                    <option value="1" value="{{isset($personne)&& $personne->entite==1? 'selected':''}}">PHB</option>
                                    <option value="2" value="{{isset($personne)&& $personne->entite==2? 'selected':''}}">SPIE FONDATION</option>
                                    <option value="3" value="{{isset($personne)&& $personne->entite==3? 'selected':''}}">DIRECTION CI</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Unité</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="societe" id="disabledSelect" class="form-control">
                                    @foreach($societes as $societe)
                                        <option value="{{$societe->id_unite}}" {{isset($personne)&& $personne->id_societe=$societe->id_unite? 'selected':''}}>{{$societe->libelleUnite}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Sureté</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <label> Oui : <input type="radio" name="surete" id="sureteOui" value='1' {{isset($personne) && $personne->surete==1? 'checked':''}}/></label>
                                <label> Non : <input type="radio" name="surete" value='0' id="sureteNon" {{isset($personne) && $personne->surete==0? 'checked':''}} /></label>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Pointure chaussure </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min="35" max="50" value="{{isset($personne)? $personne->pointure:''}}" id="text-input" name="pointure" placeholder="Pointure" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Taille t-shirt </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select class="form-control " name="taille">
                                    <option value="XS" {{isset($personne) && $personne->taille=="XS"? $personne->taille:''}}>XS</option>
                                    <option value="S" {{isset($personne) && $personne->taille=="S"? $personne->taille:''}}>S</option>
                                    <option value="M" {{isset($personne) && $personne->taille=="M"? $personne->taille:''}}>M</option>
                                    <option value="L" {{isset($personne) && $personne->taille=="L"? $personne->taille:''}}>L</option>
                                    <option value="XL" {{isset($personne) && $personne->taille=="XL"? $personne->taille:''}}>XL</option>
                                    <option value="XXL" {{isset($personne) && $personne->taille=="XXL"? $personne->taille:''}}>XXL</option>
                                    <option value="XXXL" {{isset($personne) && $personne->taille=="XXXL"? $personne->taille:''}}>XXXL</option>
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
                            @if(isset($pieces))
                                @foreach($pieces as $piece)
                            <div class=" form-control-label">
                                <label for="observation_c[]">type de pièce</label>
                                <div class="form-group col-sm-12">
                                    <select type="text" name="type_p_piece[]" class="type_c form-control input-field">
                                        @if($piece->type_p_piece=="CC")
                                            <option value="CC"> CARTE CONSULAIRE</option>
                                        @elseif($piece->type_p_piece=="CR")
                                            <option value="CR">CARTE DE RESIDENTS</option>
                                        @elseif($piece->type_p_piece=="VIS")
                                            <option value="VIS">VISA</option>
                                        @elseif($piece->type_p_piece=="PSP")
                                            <option value="PSP">PASSEPORT</option>
                                        @elseif($piece->type_p_piece=="CNI")
                                            <option value="CNI">CARTE NATIONNAL D'IDENTITE</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-control-label">
                                <label for="observation_c[]">N°pièce</label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="text" name="num_p_piece[]" class="valeur_c form-control" placeholder="Valeur" value="{{isset($piece)? $piece->num_p_piece:''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-control-label">
                                <label for="observation_c[]">Date d'expiration</label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="date" name="date_exp_piece[]" class="valeur_c form-control" placeholder="Valeur" value="{{isset($piece)? $piece->date_exp_piece:''}}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                                @endforeach
                                @endif
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
                                        <option value="CNI">CARTE NATIONNAL D'IDENTITE</option>
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
                            @if(isset($familles))
                                @foreach($familles as $famille)
                            <div class=" form-control-label">
                                <label for="titre_c[]">Nom et prénom </label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="text" name="nom_famille[]" class="titre_c form-control" placeholder="" value="{{isset($famille)? $famille->nom_prenom:''}}">
                                    </div>
                                </div>
                            </div>
                            <div class=" form-control-label">
                                <label for="observation_c[]">Lien de parenté</label>
                                <div class="form-group col-sm-12">
                                    <select type="text" name="lien[]" class="type_c form-control input-field">
                                        @if($famille->lien_parente=="CONJ")
                                            <option value="CONJ" selected> CONJOINT</option>
                                        @else
                                            <option value="CONJ"> CONJOINT</option>
                                        @endif
                                            @if($famille->lien_parente=="ENF")
                                                <option value="ENF" selected >ENFANT</option>
                                            @else
                                                <option value="ENF">ENFANT</option>
                                            @endif
                                    </select>
                                </div>
                            </div>
                            <div class=" form-control-label">
                                <label for="observation_c[]">type de pièce</label>
                                <div class="form-group col-sm-12">
                                    <select type="text" name="type_p[]" class="type_c form-control input-field">
                                        @if($famille->type_p=="CC")
                                            <option value="CC" selected> CARTE CONSULAIRE</option>
                                        @else
                                            <option value="CC"> CARTE CONSULAIRE</option>
                                        @endif
                                        @if($famille->type_p=="PSP")
                                                <option value="PSP" selected>PASSEPORT</option>
                                        @else
                                                <option value="PSP">PASSEPORT</option>
                                        @endif
                                            @if($famille->type_p=="CNI")
                                                <option value="CNI" selected>CARTE NATIONNAL D'IDENTITE</option>
                                            @else
                                                <option value="CNI">CARTE NATIONNAL D'IDENTITE</option>
                                            @endif

                                    </select>
                                </div>
                            </div>

                            <div class="form-control-label">
                                <label for="observation_c[]">N°pièce</label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="text" name="num_p[]" class="valeur_c form-control" placeholder="Valeur" value="{{isset($famille)? $famille->num_p:''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-control-label">
                                <label for="observation_c[]">Date d'expiration</label>
                                <div class="form-group col-sm-12">
                                    <div class="form-line">
                                        <input type="date" name="date_exp[]" class="valeur_c form-control" placeholder="Valeur" value="{{isset($famille)? $famille->date_exp:''}}">
                                    </div>
                                </div>
                            </div>
                            <hr width="100%" color="blue">
                                @endforeach
                            @endif
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
                                        <option value="PSP">CARTE NATIONNAL D'IDENTITE</option>
                                        <option value="CNI">CARTE NATIONNAL D'IDENTITE</option>
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
                            <hr width="100%" color="blue">
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="card-footer pull-right">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="zmdi zmdi-edit"></i> Modifier
            </button>
            <button type="reset" class="btn btn-danger btn-sm" id="reset">
                <i class="fa fa-ban"></i> Réinitialiser
            </button>
        </div>
    </form>
    <script src="{{ asset("vendor/jquery-3.2.1.min.js") }}"></script>
    <script>
        var dob = new Date($('#datenaissancet').val());
        var today = new Date();
        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#age').html('Age : '+age+' Ans');
        $("#datenaissancet").change(function(e){
            var dob = new Date($('#datenaissancet').val());
            var today = new Date();
            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
            $('#age').html('Age : '+age+' Ans');
        });
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
                            $('#rendu_img').attr('src','../images/user.png');
                        }
                    }else{
                        alert('le ficher doit être de type jpeg ou png exclusivement');

                        input.value='';
                        $('#rendu_img').attr('src','../images/user.png');
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