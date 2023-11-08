

<main id="main" class="main">
</div>
<h1>Détails du Prêt</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
      <li class="breadcrumb-item">Page</li>
      <li class="breadcrumb-item active">Détails</li>
    </ol>
  </nav>
</div>

    <!--<h1>Détails du Prêt</h1>-->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informations du Prêt</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Type de Prêt:</strong> {{ $loan->loan_type_id == 1 ? 'Prêt Automobile' : 'Prêt Immobilier' }}</li>
                        <li class="list-group-item"><strong>Montant:</strong> {{ $loan->loan_amount }} FCFA</li>
                        <li class="list-group-item"><strong>Status:</strong> 
                            @if ($loan->status === 'validated')
                                <span class="badge bg-success">Terminé</span>
                            @elseif ($loan->status === 'pending')
                                <span class="badge bg-warning text-dark">En cours</span>
                            @else
                                <span class="badge bg-danger">Rejeté</span>
                            @endif
                        </li>
                        <li class="list-group-item"><strong>Date d'échéance:</strong> {{ date('d F Y', strtotime($loan->due_date)) }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Détails du Garant</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nom du Garant:</strong> {{ $loan->name_warrantor }}</li>
                        <li class="list-group-item"><strong>Numéro du Garant:</strong> {{ $loan->number_warrantor }}</li>
                        <li class="list-group-item"><strong>Adresse du Garant:</strong> {{ $loan->address_warrantor }}</li>
                        <li class="list-group-item"><strong>Relation avec le Garant:</strong> {{ $loan->relation_warrantor }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
     <!--<h1>Détails du Prêt</h1>-->
     <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informations du Prêt</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Type de Prêt:</strong> {{ $loan->loan_type_id == 1 ? 'Prêt Automobile' : 'Prêt Immobilier' }}</li>
                        <li class="list-group-item"><strong>Montant:</strong> {{ $loan->loan_amount }} FCFA</li>
                        <li class="list-group-item"><strong>Status:</strong> 
                            @if ($loan->status === 'validated')
                                <span class="badge bg-success">Terminé</span>
                            @elseif ($loan->status === 'pending')
                                <span class="badge bg-warning text-dark">En cours</span>
                            @else
                                <span class="badge bg-danger">Rejeté</span>
                            @endif
                        </li>
                        <li class="list-group-item"><strong>Date d'échéance:</strong> {{ date('d F Y', strtotime($loan->due_date)) }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Détails du Garant</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nom du Garant:</strong> {{ $loan->name_warrantor }}</li>
                        <li class="list-group-item"><strong>Numéro du Garant:</strong> {{ $loan->number_warrantor }}</li>
                        <li class="list-group-item"><strong>Adresse du Garant:</strong> {{ $loan->address_warrantor }}</li>
                        <li class="list-group-item"><strong>Relation avec le Garant:</strong> {{ $loan->relation_warrantor }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    @if($loan->status === 'pending')
    <form enctype="multipart/form-data">
    @csrf

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Informations du Prêt</h5>
                        <div class="form-group">
                            <label for="loan_document">Document pour le prêt :</label>
                            <input type="file" class="form-control" id="loan_document" name="loan_document" accept=".pdf, .doc, .docx">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Détails du Garant</h5>
                        <div class="form-group">
                            <label for="guarantor_document">Document pour le garant :</label>
                            <input type="file" class="form-control" id="guarantor_document" name="guarantor_document" accept=".pdf, .doc, .docx">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">Envoyer les fichiers</button>
    </div>
</form>
@endif

</main><!-- End #main -->
