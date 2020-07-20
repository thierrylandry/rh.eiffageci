@extends('contrat.contrat-layoutpdf')
@section('content')
    <style>
        p, div{padding: 1px; margin: 0; text-align: justify}
        table{background-color:#fff;border-spacing:0;margin:5px;border-collapse:collapse;width:80%;}
        .classtext{
            /*color: #00aced;*/

        }

        #header, #footer {
            position: fixed;
            left: 0px;
            right: 0px;

        }
        #header {
            top: -50px;
            height: 50px;
        }
        #footer {
            bottom: 50px;
            height: 200px;
            width: 700px;
        }
        .signature{
            position: fixed;
            bottom:300px;
        }
    </style>
    <h1 style="font-size: 14pt; padding: 0;text-align: center"><u>AVENANT AU CONTRAT DE TRAVAIL</u></h1><br>

    <p>Ce document est un avenant au contrat de travail initial de <b class="classtext">{{$contrat->personne->sexe=="M"?'Monsieur ':'Madame'}}</b> <b class="classtext">{{$contrat->personne->nom}} {{$contrat->personne->prenom}}</b> pour tenir compte des modifications accordées par la Direction.
    </p><br>

    @if(sizeof($array_intersection)>=2)
    <p>Cet avenant modifie uniquement le contrat de travail  sur les points ci-dessous à compter du  <b class="classtext"><?php if(isset($contrat->date_debutc_eff)){$date = new DateTime($contrat->date_debutc_eff);
            echo $date->format('d-m-Y');}?></b> :
    @foreach($array_intersection as $modif)

        @switch($modif)
            @case("Les dotations en nature")
                <b class="classtext">les dotations en nature</b> qui sont composées désormait:
    @if($contrat->logement!='')
        <p>-  <b class="classtext">D'un logement</b></p>
    @endif
    @if($contrat->vehicule!='')
        <p>-  <b class="classtext">D'un {{$contrat->vehicule}}</b></p>
    @endif
    @if($contrat->gratification!='')
        <p>-  <b class="classtext">D'une {{$contrat->gratification}}</b></p>
    @endif
    @break
        @case("Le service")
        <p>- <b class="classtext"> {{$modif}} </b>  qui était {{$contratprec->service->libelle}} devient <b class="classtext">{{$contrat->service->libelle}} </b>  </p>
        @break

        @case("La durée hebdomadaire de travail")
        <p>- <b class="classtext"> {{"Le régime horraire"}}</b> qui était {{$contratprec->regime}} devient <b class="classtext">{{$contrat->regime}} </b> </p>
        @break
        @case("La fonction")
        <p>- <b class="classtext"> {{$modif}}</b>  qui était {{$contrat->modification->fonction_initial()->first()->libelle}} devient <b class="classtext">{{$contrat->personne->fonction()->first()->libelle}} </b> </p>

        @break
        @case("Le type de contrat")

        <p>- <b class="classtext"> {{$modif}} </b> qui était {{$contratprec->type_contrat->libelle}} devient <b class="classtext">{{$contrat->type_contrat->libelle}} </b> </p>
        @break
        @case("La date de fin")
        <p>- <b class="classtext"> {{$modif}}</b>  de contrat qui était {{$contratprec->datefinc}} devient <b class="classtext">{{$contrat->datefinc}} </b> </p>
        @break
        @case("La catégorie")
        <p>- <b class="classtext"> {{$modif}} </b> qui était {{isset($contratprec->id_categorie)?$contratprec->id_categorie:''}} ({{isset($contratprec->definition)?$contratprec->definition->libelle:''}}) </b> devient <b class="classtext">{{isset($contrat->id_categorie)?$contrat->id_categorie:''}} ({{isset($contrat->definition)?$contrat->definition->libelle:''}}) </b> </p>
        @break
        @case("Les conditions de rémunérations")
        <p>- <b class="classtext"> Le salaire</b>
        @if(in_array("Les conditions de rémunérations",$array_intersection))

            qui était de <?php $affiche=0;
                if(isset($contratprec->valeurSalaire)){
                    foreach(json_decode($contratprec->valeurSalaire) as $valeurSalaire):
                        $affiche+=$valeurSalaire->valeur;
                    endforeach;
                    echo $affiche;
                }


                ?> F CFA  devient <b class="classtext"><?php $affiche=0;
                if(isset($contrat->valeurSalaire)){
                    foreach(json_decode($contrat->valeurSalaire) as $valeurSalaire):
                        $affiche+=$valeurSalaire->valeur;
                    endforeach;
                    echo $affiche;
                }


                ?></b>  F CFA détaillée comme suit :</p><br>
            <table style="margin: 0px; padding: 0px;">
                <tr>
                    <td width="100%">
                        <table class="preambule" style="margin-left: 50px; padding: 0px; width: 100%">
                            <tr>
                                <td style="font-size: 10pt" width="40%" align="center"><b>Détail</b></td>
                                <td style="font-size: 10pt" width="60%" align="center"><b>Valeur en F CFA</b></td>
                            </tr>
                            @if(isset($contrat->valeurSalaire))
                                @foreach(json_decode($contrat->valeurSalaire) as $valeurSalaire)
                                    <tr>
                                        <td style="font-size: 12pt" width="40%">{{$valeurSalaire->libelle}}</td>
                                        <td width="60%" style="font-size: 12pt">{{$valeurSalaire->valeur}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </td>
                </tr>
            </table><br>
        @endif
        @break
        @default

        @endswitch


    @endforeach
        @else
        <p>Il modifie uniquement
        @foreach($array_intersection as $modif)

            @switch($modif)
            @case("Les dotations en nature")
            <b class="classtext">les dotations en nature</b> qui sont composées désormait:
        @if($contrat->logement!='')
            <p>-  <b class="classtext">D'un logement</b></p>
        @endif
        @if($contrat->vehicule!='')
            <p>-  <b class="classtext">D'un {{$contrat->vehicule}}</b></p>
        @endif
        @if($contrat->gratification!='')
            <p>-  <b class="classtext">D'une {{$contrat->gratification}}</b></p>
        @endif
            @break
                @case("Le service")
            <b class="classtext"> {{"le service"}}</b> qui etait <b class="classtext">{{$contratprec->service->libelle}}</b>  devient <b class="classtext">{{$contrat->service->libelle}} </b>
            @break

            @case("La durée hebdomadaire de travail")
             <b class="classtext"> {{"le régime horraire"}} </b> qui etait <b class="classtext"> {{$contratprec->regime}}</b>  devient <b class="classtext">{{$contrat->regime}} </b>
            @break
            @case("La fonction")
             <b class="classtext"> {{$modif}} </b> qui était <b class="classtext">{{$contrat->modification->fonction_initial()->first()->libelle}}</b> devient <b class="classtext">{{$contrat->personne->fonction()->first()->libelle}} </b>

            @break
            @case("Le type de contrat")

             <b class="classtext"> {{"le type de contrat"}} </b> qui était <b class="classtext">{{$contratprec->type_contrat->libelle}}</b>  devient <b class="classtext">{{$contrat->type_contrat->libelle}} </b>
            @break
            @case("La date de fin")
            <b class="classtext"> {{"la date de fin de contrat"}}</b> qui était <b class="classtext"> {{$contratprec->datefinc}} </b>  devient <b class="classtext">{{$contrat->datefinc}} </b>
            @break
            @case("La catégorie")
            <b class="classtext"> {{"la categorie"}} </b> qui était <b class="classtext"> {{isset($contratprec->id_categorie)?$contratprec->id_categorie:''}} ({{isset($contratprec->definition)?$contratprec->definition->libelle:''}})</b>  devient <b class="classtext">{{isset($contrat->id_categorie)?$contrat->id_categorie:''}} ({{isset($contrat->definition)?$contrat->definition->libelle:''}}) </b>
            @break
            @case("Les conditions de rémunérations")
        <b class="classtext"> le salaire</b>
            @if(in_array("Les conditions de rémunérations",$array_intersection))

                qui était de  <b class="classtext"><?php $affiche=0;
                if(isset($contratprec->valeurSalaire)){
                    foreach(json_decode($contratprec->valeurSalaire) as $valeurSalaire):
                        $affiche+=$valeurSalaire->valeur;
                    endforeach;
                    echo $affiche;
                }


                ?></b> F CFA  devient <b class="classtext"><?php $affiche=0;
                    if(isset($contrat->valeurSalaire)){
                        foreach(json_decode($contrat->valeurSalaire) as $valeurSalaire):
                            $affiche+=$valeurSalaire->valeur;
                        endforeach;
                        echo $affiche;
                    }


                    ?></b>  F CFA détaillée comme suit :<br>
        <table style="margin: 0px; padding: 0px;">
            <tr>
                <td width="100%">
                    <table class="preambule" style="margin-left: 50px; padding: 0px; width: 100%">
                        <tr>
                            <td style="font-size: 10pt" width="40%" align="center"><b>Détail</b></td>
                            <td style="font-size: 10pt" width="60%" align="center"><b>Valeur en F CFA</b></td>
                        </tr>
                        @if(isset($contrat->valeurSalaire))
                            @foreach(json_decode($contrat->valeurSalaire) as $valeurSalaire)
                                <tr>
                                    <td style="font-size: 12pt" width="40%">{{$valeurSalaire->libelle}}</td>
                                    <td width="60%" style="font-size: 12pt">{{$valeurSalaire->valeur}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </td>
            </tr>
        </table><br>
        @endif
            @break
            @default

            @endswitch


            @endforeach<br>à compter du <?php if(isset($contrat->date_debutc_eff)){$date = new DateTime($contrat->date_debutc_eff);
                echo $date->format('d-m-Y');}?>.
    @endif
    <br>
    @if(!empty($array_diff))
        Il n’affecte pas les éléments suivants :</p><br>
        @foreach($array_diff as $diff)
            <p>- <b class="classtext"> {{$diff}} {{$diff=="La date de fin"?"de contrat":""}}</b> </p>
        @endforeach
        @endif

    <div class="signature">
        <table style="margin: 0; padding: 0; ">
            <tr>
                <td width="40%" align="left">
                    <p style="font-size: 12pt; margin-left: 0;">L’Employeur</p><br><br>
                <td width="5%" >
                    <p style="font-size: 12pt;">L’Employé</p><br><br>
                </td>
            </tr>           <tr>
                <td width="40%" align="left">
                    <p style="font-size: 12pt; margin-left: 0;"><b>Nicolas DESCAMPS</b></p>
                </td>
                <td width="5%" >
                    <b class="classtext" style="font-size: 12pt;">{{$contrat->personne->nom}} {{$contrat->personne->prenom}}</b>
                </td>
            </tr>           <tr>
                <td width="40%" align="left">
                    {{--<p><img src="{{ asset("images/Signature_Nicolas.jpg") }}"  width="200px"/></p>--}}
                </td>
                <td width="5%" >
                    {{--<p style="font-size: 12pt; color: white;">____________________</p>--}}
                </td>
            </tr>
        </table>
    </div>
@endsection