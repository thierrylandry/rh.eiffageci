@extends('contrat.contrat-layoutpdf')
@section('content')
    <style>
        p, div{padding: 1px; margin: 0; text-align: justify}
        table{background-color:#fff;border-spacing:0;margin:5px;border-collapse:collapse;width:80%;}
        .classtext{
            color: #00aced;
            font-family: "alamain";
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
    </style>
    <h1 style="font-size: 14pt; padding: 0;text-align: center"><u>AVENANT AU CONTRAT DE TRAVAIL</u></h1><br>

    <p>Ce document est un avenant au contrat de travail initial de <b class="classtext">{{$contrat->personne->sexe=="M"?'Monsieur ':'Madame'}}</b> <b class="classtext">{{$contrat->personne->nom}} {{$contrat->personne->prenom}}</b> pour tenir compte des modifications accordées par la Direction.
    </p><br>

    @if(sizeof($array_intersection)>=2)
    <p>Cet avenant modifie uniquement le contrat de travail  sur les points ci-dessous à compter du  <b class="classtext"><?php if(isset($contrat->date_debutc_eff)){$date = new DateTime($contrat->date_debutc_eff);
            echo $date->format('d-m-Y');}?></b> :

    @foreach($array_intersection as $modif)

        @switch($modif)
        @case("Le service")
        <p>- <b class="classtext"> {{$modif}} {{$contratprec->service->libelle}} devient {{$contrat->service->libelle}} </b> </p>
        @break

        @case("La durée hebdomadaire de travail")
        <p>- <b class="classtext"> {{"le régime hebdomadaire"}} {{$contratprec->regime}} devient {{$contrat->regime}} </b> </p>
        @break
        @case("La fonction")
        <p>- <b class="classtext"> {{$modif}} devient {{$contrat->personne->fonction()->first()->libelle}} </b> </p>

        @break
        @case("Le type de contrat")

        <p>- <b class="classtext"> {{$modif}} {{$contratprec->type_contrat->libelle}} devient {{$contrat->type_contrat->libelle}} </b> </p>
        @break
        @case("La date de fin")
        <p>- <b class="classtext"> {{$modif}} {{$contratprec->datefinc}} devient {{$contrat->datefinc}} </b> </p>
        @break
        @case("La définition")
        <p>- <b class="classtext"> {{$modif}} {{isset($contratprec->definition)?$contratprec->definition->libelle:''}} devient {{isset($contrat->definition)?$contrat->definition->libelle:''}} </b> </p>
        @break
        @case("La catégorie")
        <p>- <b class="classtext"> {{$modif}} {{isset($contratprec->id_categorie)?$contratprec->id_categorie:''}} devient {{isset($contrat->id_categorie)?$contrat->id_categorie:''}} </b> </p>
        @break
        @case("Le budget mensuel")
        <p>- <b class="classtext"> {{$modif}}</b> </p>
        @break
        @default

        @endswitch


    @endforeach
        @else
        <p>Cet avenant modifie uniquement <b class="classtext"> {{implode(', ',$array_intersection)}}</b> à compter du {{isset($contrat->date_debutc_eff)?$contrat->date_debutc_eff:''}}.
    @endif
    <br>
    @if(!empty($array_diff))
        Il n’affecte pas les éléments suivants :</p><br>
        @foreach($array_diff as $diff)
            <p>- <b class="classtext"> {{$diff}}</b> </p>
        @endforeach
        @endif
@if(in_array("Le budget mensuel",$array_intersection))
    <p>Aussi ;</p><br>

    <p>Le contrat de travail signé en date du {{$contrat->datedebutc}}</p><br>

    <p>Entre :</p><br>

    <p><b>-	La société Eiffage Génie Civil Côte d’Ivoire,</b></p><br>

    <p>Et </p><br>

    <p><b>-	Monsieur  <b class="classtext">{{$contrat->personne->sexe=="M"?'Monsieur ':'Madame'}}</b> <b class="classtext">{{$contrat->personne->nom}} {{$contrat->personne->prenom}}</b>,</b></p><br>

    <p><b>Est modifié en accord des parties,</b> à compter du {{isset($contrat->date_debutc_eff)?$contrat->date_debutc_eff:''}}, dans les conditions suivantes:</p><b class="classtext"><?php $affiche=0;
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
                                <td style="font-size: 10pt" width="40%">{{$valeurSalaire->libelle}}</td>
                                <td width="60%">{{$valeurSalaire->valeur}}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </td>
        </tr>
    </table><br>
    @endif

    <div class="signature " >
        <table style="margin: 0; padding: 0; " id="footer" >
            <tr>
                <td colspan="2">
                    <p style="text-align: right">Fait à Abidjan, le <b class="classtext"><?php $date = new DateTime($contrat->created_at);
                            echo $date->format('d-m-Y');?></b>.</p>
                </td>
            </tr>
            <tr>
                <td width="40%" align="left">
                    <p style="text-align: left; font-size: 9pt">Signature précédée de la mention «lu et approuvé»</p><br>
                    <p style="font-size: 12pt; margin-left: 0;">L’Employeur</p><br><br>
                    <p style="font-size: 12pt; margin-left: 0;"><b>Nicolas DESCAMPS</b></p>
                    <p><img src="{{ asset("images/Signature_Nicolas.jpg") }}"  width="200px"/></p>
                </td>
                <td width="20%" >
                    <p style="font-size: 12pt;">L’Employé</p><br><br>
                    <p style="font-size: 12pt;">____________________</p>
                </td>
            </tr>
        </table>
    </div>
@endsection