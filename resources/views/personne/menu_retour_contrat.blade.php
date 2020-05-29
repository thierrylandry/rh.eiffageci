<div class="table-data__tool  pull-right">
    <div class="table-data__tool-right">

        <a href="{{route('lister_personne_active')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="zmdi zmdi-long-arrow-return"></i>Retour</a>
    </div>&nbsp;
    <div class="table-data__tool-right">

        <a href="{{route('contrat_embauche',$personne->id)}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="zmdi zmdi-plus"></i>AJOUTER UN CONTRAT</a>
    </div>
</div>
<div class="card-body">
    <a  href="{{route('fiche_personnel',$personne->slug)}}" class="btn btn-outline-primary">Consulter la fiche</a>
    <a  href="{{route('detail_personne',$personne->slug)}}" class="btn btn-outline-secondary">Modifier les informations</a>
    <a href="{{route('document_administratif',$personne->slug)}}" class="btn btn-outline-success"> gérer les dossiers</a>
    <a href="{{route('lister_contrat',$personne->id)}}" class="btn btn-outline-danger">Gérer les contrats</a>
</div>