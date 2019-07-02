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
                <h2 class="title-1">PERSONNE-FICHE</h2>
            </div>
        </div>
    </div>
    </br>
    <div class="table-data__tool">
        <div class="table-data__tool-left">
        </div>
        <div class="table-data__tool-right">
            <a href="{{route('Ajouter_personne',$personne->entite)}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-plus"></i>AJOUTER PERSONNE</a>
            <a href="{{route('lister_personne',$personne->entite)}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                <i class="zmdi zmdi-view-list"></i>LISTER LES PERSONNES</a>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="col-lg-12">
            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>Fiche</strong> Signalétique
                </div>
                <div class="card-body" >
                   <div class="row">
                       <div class="col-sm-2">
                           <div class="row form-group">
                               <div class="col-12 col-md-9"  >
                                   <img src="{{isset($personne) && $personne->image!=''? Storage::url('app/images/'.$personne->image):URL::asset('images/user.png')}}" id="rendu_img"style=";max-height: 200px;" class="fa fa-user"/>

                               </div>
                           </div>
                       </div>
                       <div class="col-sm-4">
                          <p> Nom : <b>{{isset($personne)? $personne->nom:''}}</b></p>
                          <p> Prénom : <b>{{isset($personne)? $personne->prenom:''}}</b></p>
                          <p> Date de naissance :  {{\Carbon\Carbon::parse(isset($personne)? $personne->datenaissance:'')->format('d-m-Y')}}</p>
                           <p id="age">   </p>
                       </div>
                       <div class="col-sm-2">
                           <p> Sexe : {{isset($personne)&& $personne->sexe=='M'? 'Masculin':'Féminin'}}</p>
                           <p>Nationalité : @foreach($payss as $pays)
                                   @if($personne->nationalite==$pays->id)
                                       {{$pays->nom_fr_fr}}
                                   @endif
                               @endforeach</p>
                           <p id="age">   </p>
                           <p> Situation matrimo. : {{isset($personne)&& $personne->matrimonial==1 ? 'Célibataire':''}}{{isset($personne)&& $personne->matrimonial==2 ? 'Marié(e)':''}}{{isset($personne)&& $personne->matrimonial==3 ? 'divorcé(e)':''}}{{isset($personne)&& $personne->matrimonial==4 ? 'Veuf(ve)':''}} </p>
                           <p> Nombre d'enfant : {{isset($personne)? $personne->enfant:0}} </p>
                           <p> CNPS : {{isset($personne)? $personne->cnps:''}}</p>
                           <p> RIB : {{isset($personne)? $personne->rib:''}}</p>
                       </div>
                       <div class="col-sm-2">

                           <p>Rhesus Sanguin : {{isset($personne)? $personne->rh:''}}</p>
                           <p> Fonction :   @foreach($fonctions as $fonction){{isset($personne) && $personne->fonction== $fonction->id ? $fonction->libelle:''}}

                                    @endforeach </p>
                           <p> Entite : {{isset($personne)&& $personne->entite==1? 'PHB':''}}{{isset($personne)&& $personne->entite==2? 'SPIE':''}}{{isset($personne)&& $personne->entite==3? 'DIRECTION CI':''}} </p>
                           <p> Unité :  @foreach($societes as $societe)
                                   @if($personne->id_unite==$societe->id_unite)
                                       {{$societe->libelleUnite}}
                                   @endif
                               @endforeach </p>
                           <p>Sureté : {{isset($personne) && $personne->surete==1? "OUI":'NON'}}</p>
                           <p>Pointure chaussure : {{isset($personne)? $personne->pointure:''}}</p>
                           <p>Taille t-shirt : {{isset($personne)? $personne->taille:''}}</p>
                       </div>

                   </div>
                </div>
                </div>
        </div>
        <div class="col-lg-12">
            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>Pièces</strong>
                </div>
                <div class="card-body" >
                    <div class="row" >
                        <table  border="2px" class="table table-borderless table-data3">
                            <thead id="piece">
                            <tr>
                                <th > Type de pièce</th>
                                <th>Numero</th>
                                <th>Date d'expiration</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            @if(isset($pieces))
                                @foreach($pieces as $piece)
                                    <tr> <td>@if($piece->type_p_piece=="CC")
                                            <option value="CC"> CARTE CONSULAIRE</option>
                                        @elseif($piece->type_p_piece=="CR")
                                            <option value="CR">CARTE DE RESIDENTS</option>
                                        @elseif($piece->type_p_piece=="VIS")
                                            <option value="VIS">VISA</option>
                                        @elseif($piece->type_p_piece=="PSP")
                                            <option value="PSP">PASSEPORT</option>
                                        @elseif($piece->type_p_piece=="CNI")
                                            <option value="CNI">CARTE NATIONNAL D'IDENTITE</option>
                                        @endif</td>
                                    <td>{{$piece->num_p_piece}}</td>
                                    <td>{{\Carbon\Carbon::parse(isset($personne)? $piece->date_exp_piece:'')->format('d-m-Y')}}</td>

                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>Familles</strong>
                </div>
                <div class="card-body" >
                    <div class="row" >
                        <table  border="2px" class="table table-borderless table-data3">
                            <thead id="piece">
                            <tr>
                                <th > Nom & Prenom</th>
                                <th>Lien de parenté</th>
                                <th>type de pièce</th>
                                <th>Numero</th>
                                <th>Date d'expirationn</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            @if(isset($familles))
                                @foreach($familles as $famille)
                                    <tr>
                                        <td>{{$famille->nom_prenom}}</td>
                                        <td>  @if($famille->lien_parente=="CONJ")
                                              CONJOINT
                                            @endif
                                            @if($famille->lien_parente=="ENF")
                                                ENFANT
                                            @endif</td>
                                        <td>@if($famille->type_p=="CC")
                                                <option value="CC"> CARTE CONSULAIRE</option>
                                            @elseif($famille->type_p=="CR")
                                                <option value="CR">CARTE DE RESIDENTS</option>
                                            @elseif($famille->type_p=="VIS")
                                                <option value="VIS">VISA</option>
                                            @elseif($famille->type_p=="PSP")
                                                <option value="PSP">PASSEPORT</option>
                                            @elseif($famille->type_p=="CNI")
                                                <option value="CNI">CARTE NATIONNAL D'IDENTITE</option>
                                            @endif</td>
                                        <td>{{$famille->num_p}}</td>
                                        <td>{{\Carbon\Carbon::parse(isset($personne)? $famille->date_exp:'')->format('d-m-Y')}}</td>

                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card" style="height: 100% !important">
                <div class="card-header">
                    <strong>Contrats </strong>
                </div>
                <div class="card-body" >
                    <div class="row" >

                        <table class="table  table-earning" id="table_employe">
                            <thead>
                            <tr>
                                <th class="">TYPE </br>CONTRAT</th>
                                <th>COUVERTURE </br>MALADIE</th>
                                <th>SERVICE</th>
                                <th>DATE DEBUT</th>
                                <th>DATE FIN</th>
                                <th>PERIODE </br> ESSAIE</th>
                                <th>TIMELINE</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contrats as $contrat)
                                <tr class="tr-shadow">
                                    <td>@foreach($typecontrats as $typecontrat)
                                            @if($typecontrat->id==$contrat->id_type_contrat)
                                                {{$typecontrat->libelle}}
                                            @endif
                                        @endforeach</td>
                                    <td>{{$contrat->couvertureMaladie}}</td>
                                    <td>@foreach($services as $service)
                                            @if($service->id==$contrat->id_service)
                                                {{$service->libelle}}
                                            @endif
                                        @endforeach</td>
                                    <td>
                                        {{$contrat->datedebutc}}
                                    </td>
                                    <td>{{$contrat->datefinc}}</td>
                                    <td>{{$contrat->periode_essaie}}</td>
                                    <td>                                @if(!empty($contrat->datedebutc) && !empty($contrat->datefinc) && Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)) !=0)
                                            <div class=" ">
                                                @if(round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)))<=25)
                                                    <div class="progress mb-3">

                                                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $diff = ((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)) }}%" aria-valuenow="{{ $diff = Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()) }}"
                                                             aria-valuemin="0" aria-valuemax="100">{{ round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc))) }}%</div>
                                                    </div>
                                                @elseif(round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)))>25 && round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)))<=50)
                                                    <div class="progress mb-3">
                                                        <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $diff = ((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)) }}%" aria-valuenow="{{ $diff = Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()) }}"
                                                             aria-valuemin="0" aria-valuemax="100">{{ round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc))) }}%</div>
                                                    </div>
                                                @elseif(round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)))>50 && round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)))<=75)
                                                    <div class="progress mb-3">
                                                        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $diff = ((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)) }}%" aria-valuenow="{{ $diff = Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()) }}"
                                                             aria-valuemin="0" aria-valuemax="100">{{ round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc))) }}%</div>
                                                    </div>
                                                @elseif(round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)))>75)
                                                    <div class="progress mb-3">
                                                        <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $diff = ((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc)) }}%" aria-valuenow="{{ $diff = Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()) }}"
                                                             aria-valuemin="0" aria-valuemax="100">{{ round(((Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::now()))*100)/Carbon\Carbon::parse($contrat->datedebutc)->diffInDays(Carbon\Carbon::parse($contrat->datefinc))) }}%</div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset("vendor/jquery-3.2.1.min.js") }}"></script>
    <script>
        var dob = new Date('{{$personne->datenaissance}}');
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