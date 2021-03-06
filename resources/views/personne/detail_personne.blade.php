@extends('layouts.app')
@section('detail_personne')
    active
@endsection
@section('detail_personne_block')
    style="display: block;"
@endsection
@section('page')
    <style>
        .lescheckeurs {
            height: 50px;
            width: 50px;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">PERSONNE-DETAIL</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @include('personne.menu_retour')
            <form action="{{route('modifier_personne')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <input type="hidden" id="text-input" name="slug" placeholder="Nom" value="{{isset($personne)? $personne->slug:''}}" class="form-control" required>

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
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Prénoms *</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="prenom" placeholder="Prénoms" class="form-control" value="{{isset($personne)? $personne->prenom:''}}" required>
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
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Lieu de naissance*</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="lieu_naissance" name="lieu_naissance"  class="form-control" value="{{isset($personne)? $personne->lieu_naissance:''}}" required>

                                    </div>

                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nom et prénom du père *</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="noms_pere" placeholder="Nom et prénoms du père" class="form-control" value="{{isset($personne)? $personne->noms_pere:''}}" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Nom et prénom de la mère *</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="noms_mere" placeholder="Nom et prénoms de la mère" class="form-control" value="{{isset($personne)? $personne->noms_mere:''}}" required>
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
                                        <label for="text-input" class=" form-control-label">Situation matrimo. </label>
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

                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">E-mail</label>
                                    </div>
                                    <!--fin-->
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="email" placeholder="email" class="form-control"  value="{{isset($personne)? $personne->email:''}}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Contact</label>
                                    </div>
                                    <!--fin-->
                                    <div class="col-12 col-md-9">
                                        <input type="text"  id="text-input" name="contact" placeholder="Contact" class="form-control" value="{{isset($personne)? $personne->contact:''}}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label"> Whatsapp </label>
                                    </div>
                                    <!--fin-->
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="whatsapp" placeholder="whatsapp" class="form-control" value="{{isset($personne)? $personne->whatsapp:''}}">
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Sattellitaire </label>
                                    </div>
                                    <!--fin-->
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="sattelitaire" placeholder="Sattellitaire" class="form-control" value="{{isset($personne)? $personne->sattelitaire:''}}">
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Adresse </label>
                                    </div>
                                    <!--fin-->
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="adresse" placeholder="Adresse" class="form-control" value="{{isset($personne)? $personne->adresse:''}}">
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

                                            <option value="{{$commune->id}}" {{isset($personne) && $personne->id_commune==$commune->id?'selected':''}}>{{$commune->libelle}}</option>
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
                                        <input type="text" id="text-input" name="cnps" placeholder="CNPS" value="{{isset($personne)? $personne->cnps:''}}" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">RIB </label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="rib" placeholder="RIB" value="{{isset($personne)? $personne->rib:''}}" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Rhesus Sanguin </label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select class="form-control" name="rh">
                                            <option value="">SELECTIONNER</option>
                                            <option value="AB-" {{isset($personne)&& $personne->rh=="AB-"?'selected':''}}>AB-</option>
                                            <option value="A-" {{isset($personne)&& $personne->rh=="A-"?'selected':''}}>A-</option>
                                            <option value="B-" {{isset($personne)&& $personne->rh=="B-"?'selected':''}}>B-</option>
                                            <option value="O-" {{isset($personne)&& $personne->rh=="O-"?'selected':''}}>O-</option>
                                            <option value="O+" {{isset($personne)&& $personne->rh=="O+"?'selected':''}}>O+</option>
                                            <option value="B+" {{isset($personne)&& $personne->rh=="B+"?'selected':''}}>B+</option>
                                            <option value="A+" {{isset($personne)&& $personne->rh=="A+"?'selected':''}}>A+</option>
                                            <option value="AB+" {{isset($personne)&& $personne->rh=="AB+"?'selected':''}}>AB+</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Fonction  </label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="fonction" id="fonction" class="form-control" required>
                                            <option value="">SELECTIONNER</option>
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
                                            @foreach($entites as $entite)
                                                @if($entite->id==Auth::user()->id_chantier_connecte)
                                                <option value="{{$entite->id}}" {{isset($personne)&& $personne->id_entite==$entite->id? 'selected':''}}> {{$entite->libelle}}</option>
                                                @endif
                                                    @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Unité</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="unite" id="disabledSelect" class="form-control">
                                            @foreach($societes as $societe)
                                                <option value="{{$societe->id_unite}}" {{isset($personne)&& $personne->id_unite==$societe->id_unite? 'selected':''}}>{{$societe->libelleUnite}}</option>
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
                                            <option value="XS" {{isset($personne) && $personne->taille=="XS"? 'selected':''}}>XS</option>
                                            <option value="S" {{isset($personne) && $personne->taille=="S"? 'selected':''}}>S</option>
                                            <option value="M" {{isset($personne) && $personne->taille=="M"? 'selected':''}}>M</option>
                                            <option value="L" {{isset($personne) && $personne->taille=="L"? 'selected':''}}>L</option>
                                            <option value="XL" {{isset($personne) && $personne->taille=="XL"? 'selected':''}}>XL</option>
                                            <option value="XXL" {{isset($personne) && $personne->taille=="XXL"? 'selected':''}}>XXL</option>
                                            <option value="XXXL" {{isset($personne) && $personne->taille=="XXXL"? 'selected':''}}>XXXL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Presence effective</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select type="text" name="presenceEff" class="type_c form-control input-field">
                                            <option value="present" {{isset($personne) && $personne->presenceEff=="present"? 'selected':''}}>PRESENT</option>
                                            <option value="absent" {{isset($personne) && $personne->presenceEff=="absent"? 'selected':''}}>ABSENT</option>
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

                                                        <option value="CC"   @if($piece->type_p_piece=="CC") selected @endif> CARTE CONSULAIRE</option>

                                                        <option value="CR" @if($piece->type_p_piece=="CR") selected @endif>CARTE DE RESIDENTS</option>
                                                        <option value="VIS" @if($piece->type_p_piece=="VIS") selected @endif>VISA</option>

                                                        <option value="PSP" @if($piece->type_p_piece=="PSP") selected @endif >PASSEPORT</option>

                                                        <option value="CNI" @if($piece->type_p_piece=="CNI") selected @endif>CARTE NATIONAL D'IDENTITE</option>
                                                        <option value="ATTN" @if($piece->type_p_piece=="ATTN") selected @endif>ATTESTATION D'IDENTITE</option>

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
                                                            <option value="CNI" selected>CARTE NATIONAL D'IDENTITE</option>
                                                        @else
                                                            <option value="CNI">CARTE NATIONAL D'IDENTITE</option>
                                                        @endif
                                                        @if($famille->type_p=="CNI")
                                                            <option value="ATTN" selected>ATTESTATION D'IDENTITE</option>
                                                        @else
                                                            <option value="ATTN">ATTESTATION D'IDENTITE</option>
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
                                            <div class="form-control-label">
                                                <label for="observation_c[]">Presence Effective</label>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-line">
                                                        <select type="text" name="presence_effective[]" class="type_c form-control input-field">

                                                            @if(isset($famille->presence_effective))
                                                                @if($famille->presence_effective=="P" )
                                                                    <option value="P" selected>PRESENT</option>
                                                                @else
                                                                    <option value="P">PRESENT</option>

                                                                @endif
                                                                @if($famille->presence_effective=="ABS")
                                                                    <option value="ABS" selected>ABSENT</option>
                                                                @else
                                                                    <option value="ABS">ABSENT</option>

                                                                @endif
                                                            @else
                                                                <option value="P" selected>PRESENT</option>
                                                                <option value="ABS">ABSENT</option>
                                                            @endif

                                                        </select>
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
                        <i class="zmdi zmdi-edit"></i> Modifier
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm" id="reset">
                        <i class="fa fa-ban"></i> Réinitialiser
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset("vendor/jquery-3.2.1.min.js") }}"></script>

    <script src="{{  URL::asset("vendor/select2/select2.min.js") }}"></script>
    <script>
        $('#commune').select2({ placeholder: 'Selectionner une commune'});
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