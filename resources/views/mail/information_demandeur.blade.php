<p>Bonjour,</p>

@switch ($typedemande)
@case(1)<p>Votre demande de recrutement n°{{$demande->id}} à été validée.<br><br>

</p>
@break;

@case(2) <p>Votre demande de modification n°{{$demande->id}} à été validée.<br><br>

</p>
@break;

@case(3)<p>Votre demande d'absence n°{{$demande->id}} à été validée.<br><br>

</p>
@break;

@case(4)<p>Votre demande de congé n°{{$demande->id}} à été validée.<br><br>

</p>
@break;

@case(5)<p>Votre demande de billet d'avion n°{{$demande->id}} à été validée.<br><br>

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