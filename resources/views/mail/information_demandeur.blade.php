<p>Bonjour,</p>

@switch ($typedemande)
@case(1)<p>Votre demande de recrutement n°{{$demande->id}} a été validé<br><br>

</p>
@break;

@case(2) Votre demande de modification n°{{$demande->id}} du contrat du collaborateur <b>{{$demande->personne->nom}}  {{$demande->personne->prenom}} </b> portant sur :<br>

<ul>
    @foreach(json_decode($demande->list_modif) as $modif)
        <li>{{$modif}}</li>
    @endforeach
</ul>



    a été validée.<br><br>

@break;

@case(3)<p>Votre demande <b>d'absence</b> concernant le collaborateur <b>{{$demande->personne->nom}}  {{$demande->personne->prenom}} </b>qui souhaite s'absenter du  <b><?php $date = new DateTime($demande->debut);
        echo $date->format('d-m-Y');?></b> au   <b><?php $date = new DateTime($demande->reprise);
        echo $date->format('d-m-Y');?></b> a été validée.<br><br>

</p>
@break;

@case(4)<p>Votre demande <b>de congé</b> concernant le collaborateur <b>{{$demande->personne->nom}}  {{$demande->personne->prenom}} </b>qui souhaite prendre congé du  <b><?php $date = new DateTime($demande->debut);
        echo $date->format('d-m-Y');?></b> au   <b><?php $date = new DateTime($demande->reprise);
        echo $date->format('d-m-Y');?></b> a été validée.<br><br>

</p>
@break;

@case(5)<p>Votre demande de billet d'avion n°{{$demande->id}} a été validée.<br><br>

</p>
@break;

@case(6)<p>Votre demande <b>de congé</b> concernant le collaborateur <b>{{$demande->personne->nom}}  {{$demande->personne->prenom}} </b>qui souhaite prendre congé du  <b><?php $date = new DateTime($demande->debut);
        echo $date->format('d-m-Y');?></b> au   <b><?php $date = new DateTime($demande->reprise);
        echo $date->format('d-m-Y');?></b> a été supprimée.<br><br>

</p>
@break;


@endswitch


<p>Dans l’attente, et en vous remerciant par avance,<br><br>

<p>
    Cordialement,<br>
</p>

</p>

<p>
    <strong>PRO-RH,</strong></br>
    <strong>Eiffage Génie Civil Côte d’Ivoire</strong></br>
    <img src="http://172.20.73.3/achat.eiffageci/images/logomail.png"/>
</p>