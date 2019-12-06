@extends('contrat.contrat-layoutpdf')
@section('content')
    <style>
        p, div{padding: 1px; margin: 0; text-align: justify}
        table{background-color:#fff;border-spacing:0;margin:5px;border-collapse:collapse;width:80%;}
    </style>
    <h1 style="font-size: 14pt; padding: 0;text-align: center"><u>AVENANT AU CONTRAT DE TRAVAIL</u></h1>

    <p>Ce document est un avenant au contrat de travail initial de <b>______________</b>  _______________ pour tenir compte du fait
        que ce dernier continuera d’exercer sa fonction de ____________________ à la Direction Projet du ________________.
    </p><br>

    <p>Cet avenant modifie uniquement <b>la rémunération,</b> n’affecte ni la qualification de l’emploi ni la catégorie professionnelle ni la durée hebdomadaire de travail.</p><br>

    <p>Aucune autre disposition du contrat initial n’est modifiée.</p><br>

    <p><b>Monsieur</b> _________________ continue de bénéficier des mêmes droits, avantages légaux et conventionnels que ceux applicables aux salariés en situation comparable travaillant dans la société Eiffage Génie Civil Côte d’Ivoire.</p><br>

    <p>Aussi ;</p><br>

    <p>Le contrat de travail signé en date du _______________</p><br>

    <p>Entre :</p><br>

    <p><b>-	La société Eiffage Génie Civil Côte d’Ivoire,</b></p><br>

    <p>Et </p><br>

    <p><b>-	Monsieur ________________,</b></p><br>

    <p><b>Est modifié en accord des parties,</b> à compter du ______________, dans les conditions suivantes:</p><br>

    <table style="margin: 0px; padding: 0px;">
        <tr>
            <td width="100%">
                <table class="preambule" style="margin-left: 50px; padding: 0px; width: 100%">
                    <tr>
                        <td style="font-size: 10pt" width="40%"><b>Salaire de base catégoriel</b></td>
                        <td width="60%"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 10pt" width="40%"><b>Sursalaire</b></td>
                        <td width="60%"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 10pt" width="40%"><b>Indemnité de transport</b></td>
                        <td width="60%"></td>
                    </tr>
                    <tr>
                        <td style="font-size: 10pt" width="40%"><b>Total Brut</b></td>
                        <td width="60%"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table><br>

    <p style="text-align: right">Fait à Abidjan, le __________________.</p><br><br>

    <p style="text-align: left; font-size: 9pt">Signature précédée de la mention «lu et approuvé»</p><br>


    <div class="signature">
        <table style="margin: 0; padding: 0; ">
            <tr>
                <td width="40%" align="left">
                    <p style="font-size: 12pt; margin-left: 0;">L’Employeur</p><br><br>
                    <p style="font-size: 12pt; margin-left: 0;"><b>Nicolas DESCAMPS</b></p>
                </td>
                <td width="5%" >
                    <p style="font-size: 12pt;">L’Employé</p><br><br>
                    <p style="font-size: 12pt;">____________________</p>
                </td>
            </tr>
        </table>
    </div>
@endsection