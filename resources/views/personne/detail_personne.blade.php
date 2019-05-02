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
                                <input type="date" id="text-input" name="datenaissance"  class="form-control" value="{{isset($personne)? $personne->datenaissance:''}}" required>

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
                                <input type="text" id="text-input" name="nationnalite" placeholder="Nationalité" class="form-control" value="{{isset($personne)? $personne->nationalite:''}}" required>
                                <small class="form-text text-muted">Une chaine de caractère</small>
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
                                            <input type="radio"  name="sit" value="1" class="form-check-input" {{isset($personne)&& $personne->situationmat==1 ? 'checked':''}}>Célibataire
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="radio2" class="form-check-label ">
                                            <input type="radio"  name="sit" value="2" class="form-check-input" {{isset($personne)&& $personne->situationmat==2 ? 'checked':''}}>Marié(e)
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="radio3" class="form-check-label ">
                                            <input type="radio"  name="sit" value="3" class="form-check-input" {{isset($personne)&& $personne->situationmat==3 ? 'checked':''}}>Divorcé(e)
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label for="radio3" class="form-check-label ">
                                            <input type="radio"  name="sit" value="4" class="form-check-input" {{isset($personne)&& $personne->situationmat==4 ? 'checked':''}}>Veuf(ve)
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
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">E - mail *</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="email" id="email" name="email" placeholder="E - mail" class="form-control"  value="{{isset($personne)? $personne->email:''}}" required>
                                <small class="form-text text-muted">exemple@domaine.com</small>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Contact *</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" min="0" id="contact" name="contact" placeholder="Contact" class="form-control" value="{{isset($personne)? $personne->contact:''}}" required>
                                <small class="form-text text-muted">+225 XX XX XX XX ; +(XXX) XX XX XX XX</small>
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
                                <input type="text" id="text-input" name="rh" placeholder="Rhesus Sanguin" value="{{isset($personne)? $personne->rh:''}}" class="form-control">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Fonction  </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="fonction"  placeholder="fonction" value="{{isset($personne)? $personne->fonction:''}}" class="form-control">

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Service </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="service" placeholder="Service" value="{{isset($personne)? $personne->service:''}}" class="form-control">
                                <small class="form-text text-muted">Une chaine de caractère</small>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Entite</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="entite" id="disabledSelect" class="form-control">
                                    <option value="1" value="{{isset($personne)&& $personne->entite==1? 'selected':''}}">PHB</option>
                                    <option value="2" value="{{isset($personne)&& $personne->entite==2? 'selected':''}}">DIRECTION CI</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Société</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <select name="societe" id="disabledSelect" class="form-control">
                                    @foreach($societes as $societe)
                                        <option value="{{$societe->id}}" {{isset($personne)&& $personne->id_societe=$societe->id? 'selected':''}}>{{$societe->libellesoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Pointure </label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" min="0" id="text-input" name="pointure" placeholder="Pointure" class="form-control" value="{{isset($personne)? $personne->pointure:''}}">
                                <small class="form-text text-muted">un nombre entier</small>
                            </div>
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
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#rendu_img').attr('src', e.target.result);
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
@endsection