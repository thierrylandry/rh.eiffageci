

    <p>Bonjour,</p>

    <p>Voici la liste des personnes en fin contrat :
        <br>
        <ul>
        @foreach($contrats as $contrat)
            <li><strong>{{$contrat->nom}} {{$contrat->prenom}} {{$contrat->libelle}} <i class="fa fa-calendar-times-o" aria-hidden="true"></i>{{\Carbon\Carbon::parse($contrat->datefinc)->format('d-m-Y')}}</strong>
            </li>
                @endforeach
        </ul>
    <br>
    <p>Dans l’attente, et en vous remerciant par avance,<br>
        <br>
    <p>
        Cordialement,
        <br>
        PRO-RH,
    </p>
    </p>

    <p>
        <strong>Eiffage Génie Civil Côte d’Ivoire</strong>
        <img src="http://172.20.73.3/achat.eiffageci/images/logomail.png"/>
    </p>