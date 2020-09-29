@extends('contrat.contrat-layoutpdf')
@section('content')
    <style>
        p, div{padding: 1px; margin: 0; text-align: justify}
        table{background-color:#fff;border-spacing:0;margin:5px;border-collapse:collapse;width:80%;}

        .classtext{
            /*color: #00aced;*/

        }

        <?php use Illuminate\Support\Carbon;$affiche=0;
         if(isset($contrat->valeurSalaire)){
                foreach(json_decode($contrat->valeurSalaire) as $valeurSalaire):
                    $affiche+=1;
                endforeach;
             //   echo $affiche;
            }
        ?>
    </style>

    @if($affiche>5)
        <style>
            .signature{
                position:relative;
                page-break-before: always;
                bottom:250px;
            }
        </style>
    @else
        <style>
            .signature{
                position:absolute;
                /* page-break-before: always;*/
                bottom:0px;
            }
        </style>

    @endif

    <h1 style="font-size: 14pt; padding: 0;text-align: center"><u>CONTRAT DE TRAVAIL A DUREE DETERMINEE</u></h1><br>

    <h1 style="font-size: 10pt; padding: 0;text-align: left"><u>ENTRE LES SOUSSIGNES</u></h1>

    <p><b>Eiffage Génie Civil Côte d’Ivoire,</b> succursale de la société française Eiffage Génie Civil,
       sise à Avenue Lamblin Tour BIAO 8è étage, Abidjan, N°CC : 1739936Z, RCCM : CI-ABJ-2017-B22961 représenté par Monsieur Nicolas DESCAMPS,
       son Directeur Projet.
    </p><br>
    <p>Etant dénommée pour la rédaction des présentes <b>« l’Employeur »,</b></p>

   <p style="text-align: right"><b><u>D’une part,</u></b></p>
   <b>Et</b><br>
    <table style="margin-left: 50px; padding: 0px; width: 100%">
        <tr>
            <td width="100%">
                <table class="preambule">
                    <tr>
                        <td style="font-size: 12pt" width="40%"><b>Nom</b></td>
                        <td width="60%" style="font-size: 12pt" class="classtext"><b>{{$contrat->personne->nom}}</b></td>
                    </tr>
                    <tr>
                        <td style="font-size: 12pt" width="40%" ><b>Prénoms</b></td>
                        <td width="60%" style="font-size: 12pt"  class="classtext"><b><b>{{$contrat->personne->prenom}}</b></b></td>
                    </tr>
                    <tr>
                        <td style="font-size: 10pt" width="40%"><b>Sexe</b></td>
                        <td width="60%"  class="classtext" style="font-size: 12pt">
                            <b> @if($contrat->personne->sexe=="M")
                                    HOMME
                                @else
                                    FEMME
                                @endif</b>
                        </td>
                    </tr><tr>
                        <td style="font-size: 12pt" width="40%"><b>Né(e) le</b></td>
                        <td width="60%" style="font-size: 12pt"class="classtext">
                            <b><?php $date = new DateTime($contrat->personne->datenaissance);
                                echo $date->format('d-m-Y');?></b>
                        </td>
                    </tr><tr>
                        <td style="font-size: 12pt" width="40%"><b>A</b></td>
                        <td width="60%" style="font-size: 12pt"><b>{{isset($contrat->personne->lieu_naissance)?$contrat->personne->lieu_naissance:''}}</b></td>
                    </tr><tr>
                        <td style="font-size: 12pt" width="40%"><b>De</b></td>
                        <td width="60%" style="font-size: 12pt"><b>{{isset($contrat->personne->noms_pere)?$contrat->personne->noms_pere:''}}</b></td>
                    </tr><tr>
                        <td style="font-size: 12pt" width="40%"><b>Et de</b></td>
                        <td width="60%" style="font-size: 12pt"><b>{{isset($contrat->personne->noms_mere)?$contrat->personne->noms_mere:''}}</b></td>
                    </tr><tr>
                        <td style="font-size: 12pt" width="40%"><b>Situation de famille</b></td>
                        <td width="60%" style="font-size: 12pt" class="classtext"><b>@if($contrat->personne->matrimonial=="1")
                                    CELIBATAIRE
                                @elseif($contrat->personne->matrimonial=="2")
                                    MARIE(E)
                                @elseif($contrat->personne->matrimonial=="3")
                                    DIVORCE(E)
                                @elseif($contrat->personne->matrimonial=="4")
                                    VEUF(VE)
                                @endif
                            </b></td>
                    </tr><tr>
                        <td style="font-size: 12pt" width="40%"><b>Domicilié à</b></td>
                        <td width="60%" style="font-size: 12pt" class="classtext"><b>{{isset($contrat->personne->commune->libelle)?$contrat->personne->commune->libelle:''}}</b></td>
                    </tr><tr>
                        <td style="font-size: 12pt" width="40%"><b>Nationalité</b></td>
                        <td width="60%" style="font-size: 12pt" class="classtext"><b>{{isset($contrat->personne->pays)?strtoupper($contrat->personne->pays->nom_fr_fr):''}}</b></td>
                    </tr>

                    @foreach($pieces as $piece)
                        @switch($piece->type_p_piece)
                        @case('CNI')
                        <tr>
                            <td style="font-size: 12pt" width="40%"><b>
                                    Carte nationnal d'identité
                                </b></td><td width="60%" class="classtext" style="font-size: 12pt"><b>{{$piece->num_p_piece}}</b></td>
                        </tr>
                        @break;
                        @case('PSP')
                        <tr>
                            <td style="font-size: 12pt" width="40%"><b>
                                    Passeport
                                </b></td><td width="60%" class="classtext" style="font-size: 12pt"><b>{{$piece->num_p_piece}}</b></td>
                        </tr>
                        @break;
                        @case('cc')
                        <tr>
                            <td style="font-size: 12pt" width="40%"><b>
                                    Carte consulaire
                                </b></td><td width="60%" class="classtext" style="font-size: 12pt"><b>{{$piece->num_p_piece}}</b></td>
                        </tr>
                        @break;
                        @case('vis')
                        <tr>
                            <td style="font-size: 12pt" width="40%"><b>
                                    Visa
                                </b></td><td width="60%" class="classtext" style="font-size: 12pt"><b>{{$piece->num_p_piece}}</b></td>
                        </tr>
                        @break;
                        @case('cr')
                        <tr>
                            <td style="font-size: 12pt" width="40%"><b>
                                    Carte de résident
                                </b></td><td width="60%" class="classtext" style="font-size: 12pt"><b>{{$piece->num_p_piece}}</b></td>
                        </tr>
                        @break;
                        @case('ATTN')
                        <tr>
                            <td style="font-size: 12pt" width="40%"><b>
                                    Attestation nationnal d'identité
                                </b></td><td width="60%" class="classtext" style="font-size: 12pt"><b>{{$piece->num_p_piece}}</b></td>
                        </tr>
                        @break;
                        @endswitch
                        @break
                    @endforeach

                    <tr>
                        <td style="font-size: 12pt" width="40%" ><b>Fonction</b></td>
                        <td width="60%" class="classtext" style="font-size: 12pt"><b>{{isset($contrat->personne->fonction)?strtoupper($contrat->personne->fonction()->first()->libelle):''}}</b></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table><br>

   <p>Etant dénommée  pour la rédaction des présentes <b>« l’Employé »,</b></p>

   <p style="text-align: right"><b><u>D’autre part,</u></b></p><br>

   <p><b>Eiffage Génie Civil Côte d’Ivoire</b> et Monsieur ou Madame <b class="classtext">{{$contrat->personne->nom}} {{$contrat->personne->prenom}}</b> ci-après désignés ensemble dans le corps du présent acte <b>« les Parties »</b> et individuellement <b>« la Partie »</b> ou par la dénomination ci-dessus.</p>

   <h1 style="font-size: 12pt; padding: 0;text-align: center"><u>EXPOSE</u></h1>

   <h1 style="font-size: 11pt; padding: 0;text-align: center">IL A ETE PREALABLEMENT EXPOSE CE QUI SUIT :</h1>

   <p>Le présent contrat de travail et ses suites ou avenants sont établis conformément aux dispositions de la loi nouvelle n°2015-532 du 20 juillet 2015
       portant Code du Travail de la Côte d’Ivoire et les textes réglementant son application, ainsi qu’aux dispositions de la Convention Collective Interprofessionnelle
       du 19 juillet 1977 et les avenants et décisions de commissions mixtes  qui ont modifié et complété cette convention ou qui viendraient à la modifier ou à la compléter.
   </p><br>

    <h1 style="padding: 0;text-align: center"><u>CECI EXPOSE, IL A ETE CONVENU CE QUI SUIT :</u></h1>

    <h1 style="padding: 0;text-align: left"><u>Article 1</u> : Engagement-Qualité</h1>

    <p>L’Employé susnommé est recruté par l’Employeur en qualité de <b class="classtext">{{isset($contrat->personne->fonction)?strtoupper($contrat->personne->fonction()->first()->libelle):''}}.</b><br>
        L’Employé qui accepte cette qualité, déclare avoir exprimé son engagement en toute liberté.<br>
        Il devra, en tout état de cause, fournir toute preuve de sa libération de son dernier Employeur.
    </p><br>

   <h1 style="padding: 0;text-align: left"><u>Article 2</u> : Définition des fonctions</h1>

    <p>Sous l’autorité du Responsable <b class="classtext">{{isset($contrat->service)?$contrat->service->libelle:''}}</b>, l'Employé sera chargé d’exécuter les tâches telles que définies dans la fiche de poste qui lui sera remise.</p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 3</u> : Classement de la catégorie professionnelle </h1>

   <p>Les parties conviennent que l’Employé est classé dans la catégorie professionnelle <b class="classtext">{{isset($contrat->id_categorie)?$contrat->id_categorie:''}} ({{isset($contrat->definition)?$contrat->definition->libelle:''}})</b>, <b>du secteur des Bâtiments, des Travaux Publics et activités connexes.</b></p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 4</u> : Dossier Administratif</h1>

    <p>L’Employé s’engage à fournir dans les meilleurs délais tous les documents personnels nécessaires à la constitution de son dossier administratif. Il s’engage également à ouvrir
        un compte bancaire auprès d’un établissement financier pour assurer le virement de son salaire.</p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 5</u> : Lieu de travail-Mobilité</h1>

    <p>Le lieu de travail est fixé à Abidjan. Pour les nécessités du travail, l’Employé embauché par l’Employeur pourra faire l’objet d’affectation ou de déplacement non seulement sur
        le territoire Ivoirien mais également à l’étranger pour les missions qui lui seront assignées.</p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 6</u> : Durée du contrat de travail</h1>

    <p>Le présent contrat est établi pour une durée déterminée allant du <b class="classtext"><?php if(isset($contrat->date_debutc_eff)){ $date = new DateTime($contrat->date_debutc_eff);
            echo $date->format('d-m-Y');}?></b> au <b class="classtext"><?php if(isset($contrat->datefinc)){ $date = new DateTime($contrat->datefinc);
                echo $date->format('d-m-Y');}?></b>, conformément à la réglementation régissant les rapports entre Employeur et Employé,
        notamment la loi nouvelle n°2015-532 du 20 juillet 2015 portant Code de Travail en Côte d’ivoire et les textes subséquents pris pour son application.
        A l’issu de cette période, les parties peuvent mettre fin au présent contrat conformément aux dispositions du code du travail. Toutefois il ne pourra être rompu avant le terme que par force majeur,
        accord commun ou faute lourde de l’une des parties.
    </p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 7</u> : Période d’essai -Visite Médicale</h1>

    <p>L’embauche de l’Employé ne sera définitive qu’après une période d’essai de <b class="classtext"><?php if(isset($contrat->periode_essaie)){
                $datetime1 = Carbon::parse(new DateTime($contrat->debutc));
               // $datetime1 = Carbon::parse('13-01-2020');
                $datetime2 = Carbon::parse(new DateTime($contrat->periode_essaie));
              //  $datetime2 = Carbon::parse('13-02-2020');
                $interval = $datetime2->diffInMOnths($datetime1);
                //  $nbmonth= $interval->format('%m');
                // $nbyear = $interval->format('%y');
              //  var_dump($interval);
              //  $resultat=12-$interval;
               // echo $datetime1 .' '.$datetime2;
               echo '1 Mois';
            }  ?></b>.
        Dans le mois de son embauche, l’Employé sera soumis à un examen médical d’embauche
    </p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 8</u> : Durée de travail</h1>

    <p>Le présent contrat est conclu et accepté pour une durée de travail de <b class="classtext">{{isset($contrat->regime)?$contrat->regime:''}}</b> par semaine. La durée hebdomadaire ci-dessus indiquée est indicative,
        et pourra être modifiée en fonction des nécessités de service.</p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 9</u> : Rémunération et accessoires</h1>

    <p>L’Employé percevra conformément à sa catégorie professionnelle une rémunération mensuelle brute de <b class="classtext"><?php $affiche=0;
            if(isset($contrat->valeurSalaire)){
                foreach(json_decode($contrat->valeurSalaire) as $valeurSalaire):

                        $affiche+=floatval($valeurSalaire->valeur);
                    echo $affiche;
                endforeach;

            }


            ?></b> F CFA détaillée comme suit :</p><br>

    <table style="margin: 0px; padding: 0px;">
        <tr>
            <td width="100%">
                <table class="preambule" style="margin-left: 50px; padding: 0px; width: 100%">
                    <tr>
                        <td style="font-size: 12pt" width="40%" align="center"><b>Détail</b></td>
                        <td style="font-size: 12pt" width="60%" align="center"><b>Valeur en F CFA</b></td>
                    </tr>
                    @if(isset($contrat->valeurSalaire))
                        @foreach(json_decode($contrat->valeurSalaire) as $valeur)
                            <tr>
                                <td style="font-size: 12pt" width="40%">{{$valeur->libelle}}</td>
                                <td width="60%"  class="classtext" style="font-size: 12pt"><b>{{$valeur->valeur}}</b></td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </td>
        </tr>
    </table><br>

    <p>Au titre de la gratification, l’Employé percevra une gratification égale à ¾ du salaire catégoriel,
        pour une présence effective dans l’entreprise du 1er janvier au 31 décembre. S’il est engagé, démissionne ou est licencié au cours de l’année,
        il percevra une gratification calculée au prorata du temps de service effectué au cours de ladite année.
        Au titre des congés-payés, et conformément aux dispositions du Code de Travail, l’Employé bénéficiera de 2,5 jours ouvrables de congés payés par mois de service effectif.
        En cas de départ en congés, il percevra une indemnité compensatrice de congés payés fixée selon les dispositions du Code du Travail Ivoirien.
    </p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 10</u> : Immatriculation sociale de l’Employé</h1>

    <p>L’Employé fera l’objet de déclaration à la Caisse Nationale de Prévoyance Sociale (CNPS) par l’Employeur afin de bénéficier
        des avantages sociaux qu’offre cette structuretant sur le plan des accidents de travail, des maladies professionnelles qu’en cas de maternité.
    </p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 11</u> : Avantages sociaux</h1>

    <p>La couverture maladie de l’employé, de sa conjointe et de ses enfants à charge est prise en charge
        par l’Employeur à hauteur de <b class="classtext">{{isset($contrat->couvertureMaladie)?$contrat->couvertureMaladie:''}}</b>% auprès d’une compagnie d’assurance locale après la période d’essai.
    </p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 12</u> : Sécurité –Induction</h1>

    <p>Engagé sur le projet de l’Employeur, l’Employé bénéficiera, dès la signature du présent contrat, d'une formation renforcée à la sécurité ainsi que
        d'un accueil et d'une information adaptés assuré par le service de Sécurité. A ce titre, l’Employé s’engage à se soumettre au respect strict des consignes d’hygiène et de sécurité,
        entre autres le port des équipements de protection individuelle, le respect des zones balisées …etc.
    </p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 13</u> : Les obligations professionnelles</h1>

    <p>L’Employé s’engage :<br>
        -A respecter les prescriptions en vigueur dans la société.<br>
        -A respecter les horaires de travail.<br>
        -A se conformer aux directives et instructions émanant de sa hiérarchie.<br>
        -A ne se livrer à aucune activité professionnelle autre que celle pour laquelle il a été engagé, ni s’intéresser, soit directement, soit indirectement à des entreprises de nature à concurrencer l’employeur.<br>
        -A ne pas exercer d’activité professionnelle complémentaire de quelle que nature que ce soit sans autorisation expresse de l’Employeur.<br>
        -A se soumettre au respect strict des consignes d’hygiène et sécurité, entre autres le port des équipements de protection individuelle…etc.
    </p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 14</u> : Clause de non concurrence – clause de confidentialité</h1>

    <p>Il est interdit à l’Employé d’exercer, même en dehors de son temps de travail, toute activité à caractère professionnel susceptible de concurrencer l’entreprise ou de nuire à la bonne exécution des services convenus.
        L’Employé a également l’obligation de s’abstenir de divulguer tout fait ou renseignement confidentiel acquis au service de l’employeur.
    </p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 15</u> : Avantages personnels</h1>

    <p>L’Employé s’interdit de solliciter ou d’accepter, tant pour elle-même que pour ses proches, un quelconque avantage personnel qui pourrait, tant en raison de sa nature que de son importance,
        influencer ou donner l’apparence qu’elle pourrait influencer le jugement ou les activités de l’Employé dans l’accomplissement de ses tâches pour l’Employeur.
    </p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 16</u> : Absence et Indisponibilité</h1>

    <p>En cas d’absence pour maladie, accidents non professionnels ou toute autre cause, l’Employé devra <b>immédiatement</b> aviser l’Employeur et produire un justificatif dans les 72 heures.</p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 17</u> : Matériels et documents</h1>

    <p>Tous les matériels et documents de travail confiés à l’Employée pour l’exécution de ses tâches sont la propriété de l’Employeur.
        L’Employé devra les restituer à la première demande ou dès la cessation de ses fonctions.
    </p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 18</u> : Juridiction compétente</h1>

    <p>Tout litige ou différent relève de la compétence exclusive des juridictions de la République de Côte d’Ivoire.</p><br>

   <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 19</u> : Exemplaires</h1>

    <p>Le présent contrat est établi en <b>deux (2)</b> exemplaires originaux exempt de tous droits de timbre et d’enregistrement, dont une <b>(01) copie originale</b> est remise à l’Employé.
    </p><br><br><br>

    <div class="signature">
        <div style="min-height: 700.748031px;height:700.748031px;"></div>
        <p style="text-align: right">Fait à Abidjan, le <b class="classtext"> <?php $date = new DateTime($contrat->created_at);
                echo $date->format('d-m-Y');?></b>.</p>
        <p style="text-align: left; font-size: 10pt">Signature précédée de la mention «Lu et approuvé»</p>
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
            </tr>
            <tr>
                <td width="40%" align="left">
                    {{--<p><img src="{{ asset("images/Signature_Nicolas.jpg") }}"  width="200px"/></p>--}}
                </td>
                <td width="5%" >
                    {{--<p style="font-size: 12pt;color:white">____________________</p>--}}
                </td>
            </tr>
        </table>
    </div>
@endsection
