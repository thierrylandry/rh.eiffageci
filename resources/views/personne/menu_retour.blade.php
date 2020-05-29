<div class="table-data__tool">
    <div class="table-data__tool-left">
        <div class="card-body">
            <a  href="{{route('fiche_personnel',$personne->slug)}}" class="btn btn-outline-primary">Consulter la fiche</a>
            <a  href="{{route('detail_personne',$personne->slug)}}" class="btn btn-outline-secondary">Modifier les informations</a>
            <a href="{{route('document_administratif',$personne->slug)}}" class="btn btn-outline-success"> gérer les documents administratifs</a>
            <a href="{{route('lister_contrat',$personne->id)}}" class="btn btn-outline-danger">Gérer les contrats</a>
        </div>
    </div>
    <div class="table-data__tool-right">
        <a href="{{route('Ajouter_personne')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="zmdi zmdi-plus"></i>AJOUTER PERSONNE</a>
        <a href="{{route('gestion_rh')}}" class="au-btn au-btn-icon au-btn--green au-btn--small">
            <i class="zmdi zmdi-view-list"></i>LISTER LES PERSONNES</a>
    </div>
</div>