<!DOCTYPE html>
<html>
<head>
</head>
<style>

    p, div{padding: 2px; margin: 0;}
    table{background-color:#fff;border-spacing:0;border-collapse:collapse;}
    td,th{padding:8px;}
    table{width:100%;max-width:100%;margin-bottom:20px;vertical-align: bottom}
    h1, h2{font-size:12pt;}
    h4, h3{font-size:18px;}
    h4,h5,h6{margin-top:10px;margin-bottom:10px;}
    table.payload th, table.payload td{
        font-size: 12pt;
    }
    table{font-size: 12pt}
    table.payload tfoot p {
        font-size: inherit;
        font-weight: normal;
    }
    table.payload thead tr.head th {
        font-size: 7pt;
        font-weight: bold;
        text-align: center;
    }
    table.payload td, table.payload th{
        border: 0.3pt solid #000000
    }
    table.payload tbody td {
        font-size: 12pt;
        font-weight: normal;
        color: #333;
    }
    table.payload, table.payload .ssfacture th, table.payload .ssfacture td{
        margin: 0;
        padding: 0 4px 4px 0;
    }
    table.payload .ssfacture td.value{
        text-align: center;
        font-weight: bold;
        border-left: 0.3pt solid #000000;
    }
    table.payload .ssfacture td{
        border-bottom: 0.3pt solid #000000;
    }
    body{
        font-size: 12pt;
    }
    td.fournisseur {
        font-size: 32pt;
        text-align: center;
    }
    table.preambule, table.preambule td{
        font-size: 7pt;
        padding: 2px;
        margin: 0;
        border: 0.3pt solid #000000;
    }
    table.preambule p{
        margin: 5%;
        padding: 5%;

    }
    footer{
        font-size: 7pt;
        position: absolute;
        width: 100%;
        bottom: -1cm;
    }
    footer p {
        padding: 2px;
        margin: 0;
        text-align: center;
    }
    .page{
        page-break-after: auto;
    }
    div.rubrique{
        margin: 0 auto;
        width: 85%;
    }
    div.rubrique p{
        padding: 5px 3px;
        border: 0.3pt solid #000000;
        font-size: 8pt;
        text-align: center;
    }
    table.numero tr, table.numero tr td{
        margin: 3px;
    }
    .lignesEspacees
    {
        border-collapse : separate;
        border-spacing : 10px;
    }
</style>
<body style=" margin-left: 5%; width: 90%; border: 1px solid #ffffff;">
<div class="entete">
    <table style="margin: 0; padding: 0;">
        <tr>
            <td width="50%" valign="center" align="left">
                <img src="{{ Storage::url('app/images/projet/'.$projet->logo)}}">
            </td>
        </tr>
    </table>
</div>
<main class="page">
    <h1 style="font-size: 14pt; padding: 0;text-align: center"><u>AUTORISATION D'ABSENCE</u></h1>
    </br>
    <table style="width: 210px;border: 0.3pt solid #000000;">
        <tr style="background-color:#6c757d; color: white; border: 1px">
            <td>N° de la demande:</td>
            <td style="background-color:white; color: black">{{$personne->id}}</td>
        </tr>
    </table>
    </br>
    </br>
    <table class="preambule"  style="width: 100%; text-align: center">
        <tr style="background-color:#6c757d; color: white">
            <td style="font-size: 12pt"  class="classtext"><b>Matricule</b></td>
            <td style="font-size: 12pt"  class="classtext"><b>Nom</b></td>
            <td style="font-size: 12pt"   class="classtext"><b>Prénoms</b></td>
        </tr>
        <tr>
            <td  style="font-size: 12pt" ><b>{{$personne->matricule}}</b></td>
            <td  style="font-size: 12pt" ><b>{{$absence->personne->nom}}</b></td>
            <td  style="font-size: 12pt" ><b><b>{{$absence->personne->prenom}}</b></b></td>
        </tr>
        <tr style="background-color: #6c757d; color: white">
            <td style="font-size: 12pt"  ><b>Fonction</b></td>
            <td style="font-size: 12pt" width="40%" ><b>Service</b></td>
            <td style="font-size: 12pt" width="40%" ><b>Date d'embauche</b></td>

        </tr>
        <tr>
            <td  class="classtext" style="font-size: 12pt"><b>{{isset($personne->lafonction)?strtoupper($personne->lafonction->libelle):''}}</b></td>
            <td  class="classtext" style="font-size: 12pt"><b>{{isset($personne->leservice)?strtoupper($personne->leservice->libelle):''}}</b></td>
            <td  class="classtext" style="font-size: 12pt"><b><?php if(isset($personne->datedebutc)){$date = new DateTime($personne->datedebutc);
                        echo $date->format('d-m-Y');}?></b></td>
        </tr>
    </table><br>

    <p>Ce document est une autorisation d'absence pour (M. / Mme. / Mlle.) <b>{{$absence->personne->nom}}</b>  {{$absence->personne->prenom}}
        Employé(e)  dans  notre  entreprise,  qui est autorisé à s'absenter  de   <b><?php if(isset($absence->debut)){$date = new DateTime($absence->debut);
                echo $date->format('d-m-Y');}?></b>  à <b><?php if(isset($absence->fin)){$date = new DateTime($absence->fin);
                echo $date->format('d-m-Y');}?></b> inclut le motif ci-dessous :
    </p><br>

    <p>{{isset($absence->motif)?$absence->motif:''}}</p><br>

    <p>Il (Elle)  devra reprendre le service le:<b> <?php if(isset($absence->reprise)){$date = new DateTime($absence->reprise);
                echo $date->format('d-m-Y');}?></b> </p><br>

                <table class="preambule"  style="width: 100%; text-align: center; margin-top: 100px">
                    <tr style="background-color:#6c757d; color: white; border: 1px; font-size: 12pt;" class="classtext">
                        <td style="font-size: 12pt; text-align: center" class="classtext" ><b>Demandeur</b></td>
                        <td  style="font-size: 12pt; text-align: center" class="classtext"><b>Supérieur Hiérarchique</b></td>
                        <td  style="font-size: 12pt; text-align: center" class="classtext"><b>Service RH</b></td>
                    </tr>
                    <tr>
                        <td class="classtext" style="text-align: center"> <img src="{{asset('public/images/check.png')}}" width="100px"/></td>
                        <td class="classtext" style="text-align: center">@if($absence->etat>=2)<img src="{{asset('public/images/check.png')}}" width="100px"/> @endif</td>
                        <td classtext="classtext" style="text-align: center">@if($absence->id_type_permission!='')<img src="{{asset('public/images/check.png')}}" width="100px"/> @endif</td>
                    </tr>
                </table>
    </br>
    </br></br>
    </br>

                <table class="preambule"  style="width: 100%; text-align: center;margin-top: 100px;margin-bottom: 20px">
                    <tr>
                        <td style="background-color:#6c757d; color: white; border: 1px; font-size: 12pt;" class="classtext" ><b>Mentions obligatoires à indiquer par la RRH (Coche une case)</b></td>
                        <td  style="font-size: 12pt; text-align: center; width: 50%" class="classtext"><b>{{isset($absence->type_permission)?$absence->type_permission->libelle:''}}</b></td>
                    </tr>
                </table>


    </br>
    </br>
    <p style="text-align: right">Fait à Abidjan, le <?php if(isset($absence->created_at)){$date = new DateTime($absence->created_at);
            echo $date->format('d-m-Y');}?>.</p><br><br>


</main>
</body>
</html>
    <style>
        p, div{padding: 1px; margin: 0; text-align: justify}
        table{background-color:#fff;border-spacing:0;margin:5px;border-collapse:collapse;width:80%;}
    </style>
