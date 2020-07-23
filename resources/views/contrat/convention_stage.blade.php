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

    <h1 style="font-size: 14pt; padding: 0;text-align: center"><u>CONVENTION DE STAGE DE QUALIFICATION</u></h1><br>

    <h1 style="font-size: 10pt; padding: 0;text-align: left"><u>ENTRE LES SOUSSIGNES</u></h1>

    <p><b>Eiffage Génie Civil Côte d’Ivoire,</b> succursale de la société française Eiffage Génie Civil,
        sise à Avenue Lamblin Tour BIAO 8è étage, Abidjan, N°CC : 1739936Z, RCCM : CI-ABJ-2017-B22961 représenté par Monsieur Nicolas DESCAMPS,
        son Directeur Projet.
    </p><br>
    <p>Etant dénommée pour la rédaction des présentes <b>« l’entreprise »,</b></p>

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

    <p>Etant dénommée  pour la rédaction des présentes <b>« l’Employé stagiaire»,</b></p>

    <h1 style="font-size: 12pt; padding: 0;text-align: center"><u>IL A ETE CONVENUE CE QUI SUIT :</u></h1>

    <h1 style="padding: 0;text-align: left"><u>Article 1</u> : Qualité</h1>

    <p>L’entreprise accepte d'accueillir Monsieur ou Madame <b>{{$contrat->personne->nom}}</b> <b>{{$contrat->personne->prenom}}</b> pour effectuer un stage de fins de formation et de perfectionnement professionnel.
    </p><br><br>
    <p>Ce stage aura pour objet essentiel de permettre au stagiaire de se familiariser avec au service <b class="classtext">{{isset($contrat->service)?$contrat->service->libelle:''}}</b> de l'entreprise.</p><br>

    <h1 style="padding: 0;text-align: left"><u>Article 2</u> : Définition des objectifs</h1>

    <p>Le stagiaire s'engage a travailler avec l'équipe des <b class="classtext">{{isset($contrat->service)?$contrat->service->libelle:''}}</b> pour l'atteinte des objectifs lié au poste.</p><br>
    </br>
    <p>l'entreprise s'engage, pour sa part, à tout mettre en oeuvre pour aider le stagiaire à son insertion dans l'entreprise..</p><br>

    <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 3</u> : Encadrement du stagiaire </h1>

    <p>Le stagiaire effectuera son stage au sein du service <b class="classtext">{{isset($contrat->service)?$contrat->service->libelle:''}}</b> et aura pour tuteur le responsable dudit service</p><br>
    <p>Le tuteur du stage sera chargé d'assurer le suivi du stagiaire et d'optimiser les conditions de réalisation du stage.</p><br>

    <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 4</u> : Durée du stage-Renouvellement</h1>

    <p>Ce stage se déroulera du <b class="classtext"><?php if(isset($contrat->date_debutc_eff)){ $date = new DateTime($contrat->date_debutc_eff);
                echo $date->format('d-m-Y');}?></b> au <b class="classtext"><?php if(isset($contrat->datefinc)){ $date = new DateTime($contrat->datefinc);
                echo $date->format('d-m-Y');}?></b>.</p><br>
    <p>La convention de stage peut être prolongée ou renouvelée par simple avenant après accord des parties et ne pourra excédéer une durée de 12 mois, renouvellement compris.</p><br>

    <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 5</u> : Indemnité-Prime de stage</h1>

    <p>Au cours de son stage, le stagiaire percevera une gratification (prime de stage) d'un montant net de cent cinquante mille (150 000) XOF </p><br>

    <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 6</u> : Avantages sociaux</h1>

    <p>La présente convention n'est pas un contrat de travail.</p><br>
    <p>Toutefois, en qualité de stagiaire accueillie hors convention de stageè-ecole, le stagiaire sera assigné au régime général de la sécurité sociale et sera couverte, au titre de la  législation sur les accidents du travail tant pour l'accident dans l'entreprise que pour le trajet.</p><br>

    <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 7</u> : Fin du stage-Résilliation</h1>

    <p>A l'issue du stage, le chef d'entreprise remettra à la stagiaire un certificat indiquant la nature et la durée du stage.</p><br>
    <p>Il peut être mis fin à la présente convention, d'une manière concertée entre les parites( entre l'entreprise et la stagiaire). En cas de résilliation unilattérale, une notification écrite préable sera effectuée par l'une des parties. </p><br>

    <h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 8</u> : Obligation du stagiaire</h1>

    <p>durant son stage, le stagiaire sera soumis aux rêgles applicables dans l'entreprise en matière de discipline, de sécurité, d'horaires de travail et aux differentes notes de service.</p><br>
    <p>Il est tenu au respect du secret professionnel et à la discretion concernant les activités de l'entreprise.</p><br>
    <p>Le stagiaire déclare avoir pris connaissance du règlement intérieur de l'entreprise et s'engage à s'y confomrer durant tout la durée de son stage. </p><br>
    <br>
    <p>En cas de manquement, l'entreprise se reserve le droit de mettre fin au stage en respectant les dispositions fixées à <b class="classtext">l'alinéa 2 de l'article 7 de la présente convention</b> </p><br>

<h1 style="font-size: 12pt; padding: 0;text-align: left"><u>Article 9</u> : Juridiction compétente</h1>

    <p>La présente convention est régie exclusivement par le droit ivoirien.</p><br>
    <p>Tout litige non rédsolu par voie amiable sera soumis à la compétence de la juridiction ivoirienne compétente.</p><br>
    <br>
    <p>Elle est etablie en deux(2) exemplaires originaux dont l'un sera remis au stagiaire.</p><br>


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