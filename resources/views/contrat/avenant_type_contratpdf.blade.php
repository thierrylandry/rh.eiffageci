@extends('contrat.contrat-layoutpdf')
@section('content')
    <style>
        p, div{padding: 1px; margin: 0; text-align: justify}
        table{background-color:#fff;border-spacing:0;margin:5px;border-collapse:collapse;width:80%;}
    </style>
    <h1 style="font-size: 14pt; padding: 0;text-align: center"><u>AVENANT AU CONTRAT DE TRAVAIL</u></h1><br>

    <p>Ce document est un avenant au contrat de travail initial de <b>___________</b>  _______________ pour tenir compte du fait
        que ce dernier continuera d’exercer sa fonction de ____________________ à la Direction Projet du ________________.
    </p><br>

    <p>Cet avenant modifie uniquement le contrat de travail à <b>durée déterminé,</b> en contrat de travail à <b>durée indéterminé</b>,
        n’affecte ni la qualification de l’emploi ni la catégorie professionnelle ni la durée hebdomadaire de travail, à compter du _________________.</p><br>

    <p>Ce contrat de travail et ses suites ou avenants sont établis conformément aux dispositions de la nouvelle loi n° 2015-532 du 20 juillet 2015 portant Code du Travail de la Côte d’Ivoire et les textes réglementant son application.
    </p><br>

    <p>Toutes les autres clauses de votre contrat de travail et de ses éventuels avenants restent inchangées.
    </p><br>

    <p><b>Monsieur</b> _________________ continue de bénéficier des mêmes droits, avantages légaux et conventionnels que ceux applicables aux salariés en situation comparable travaillant dans la société Eiffage Génie Civil Côte d’Ivoire.
    </p><br><br><br>

    <p style="text-align: right">Fait à Abidjan, le __________________.</p><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

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