<p>Bonjour,</p>

@switch ($typedemande)
@case(1)<p>Votre demande de recrutement n°{{$demande->id}} a été validé<br><br>

</p>
@break;

@case(2) Vous avez une demande de modification du contrat du collabotrateur {{$demande->personne->nom}}  {{$demande->personne->prenom}}  portant sur :<br>

<ul>
    @foreach(json_decode($demande->list_modif) as $modif)
        <li>{{$modif}}</li>
    @endforeach
</ul>



a valider.<br><br>

@break;

@case(3)<p>Vous avez une demande <b>d'absence</b> concernant le collaborateur <b>{{$demande->personne->nom}}  {{$demande->personne->prenom}} </b>qui souhaite s'absenter du  <b><?php $date = new DateTime($demande->debut);
        echo $date->format('d-m-Y');?></b> au   <b><?php $date = new DateTime($demande->reprise);
        echo $date->format('d-m-Y');?> a valider.<br><br>

</p>
@break;

@case(4)<p>Vous avez une demande <b>de congé</b> concernant le collaborateur <b>{{$demande->personne->nom}}  {{$demande->personne->prenom}} </b>qui souhaite prendre congé du  <b><?php $date = new DateTime($demande->debut);
        echo $date->format('d-m-Y');?></b> au   <b><?php $date = new DateTime($demande->reprise);
        echo $date->format('d-m-Y');?></b> a valider.<br><br>

</p>
@break;

@case(5)<p>Votre demande de billet d'avion n°{{$demande->id}} à été validée.<br><br>

</p>
@break;

@case(6)<p>Votre demande <b>de congé</b> concernant le collaborateur <b>{{$demande->personne->nom}}  {{$demande->personne->prenom}} </b>qui souhaite prendre congé du  <b><?php $date = new DateTime($demande->debut);
        echo $date->format('d-m-Y');?></b> au   <b><?php $date = new DateTime($demande->reprise);
        echo $date->format('d-m-Y');?></b> a valider.<br><br>

</p>
@break;


@endswitch

Cliquez ici pour consulter 👉 : <a href="{{$lien}}">cliquez ici</a>

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