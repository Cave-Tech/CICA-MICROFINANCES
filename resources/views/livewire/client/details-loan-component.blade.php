

<main id="main" class="main">

    <h1>Détails du Prêt</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
        <li class="breadcrumb-item">Page</li>
        <li class="breadcrumb-item active">Détails</li>
        </ol>
    </nav>


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
            <form wire:submit.prevent="EditLoanDoc" enctype="multipart/form-data">
            

                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Informations du Prêt</h5>
                                    <!--<input type="hidden" wire:model="id" value="{{$loan->id}}">-->
                                    
                                    <div class="form-group">
                                            @if($loan->doc_files)
                                                <label for="loan_document">Document pour le prêt :</label>
                                                <a href="{{ asset('storage/' . $loan->doc_files) }}" target="_blank">Voir le document PDF</a>
                                            @else
                                                <p>Mettez un document</p>
                                            @endif
                                        <input type="file" class="form-control" value="{{$loan->doc_files}}" wire:model="doc_files" accept=".pdf, .doc, .docx">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Détails du Garant</h5>
                                    <div class="form-group"> 
                                            @if($loan->doc_files)
                                                <label for="loan_document">Document pour le prêt :</label>
                                                <a href="{{ asset('storage/' . $loan->doc_files_warrantor) }}" target="_blank">Voir le document PDF</a>
                                            @else
                                                <p>Mettez un document</p>
                                            @endif
                                        <input type="file" class="form-control" value=" {{$loan->doc_files_warrantor}}" wire:model="doc_files_warrantor" accept=".pdf, .doc, .docx">
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


    <div class="pagetitle">
        <h1>Historique des paiements</h1>
    </div>

    <br>

    <div class="row">
       
        

        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">

                <!-- Table with stripped rows -->
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Montant paye</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($loan->payment as $payment)
                        <tr>
                        <td>
                            {{ $payment->id }}
                            
                        </td>
                        <td>{{ number_format($payment->payment_amount, 2, ',', ' ') }} FCFA</td>
                        <td>
                            @if ($payment->status == "pending")
                                <span class='badge bg-warning'>En attente</span>
                            @else($payment->status == "completed")
                                <span class='badge bg-success'>Valider</span>
                            @endif
                        </td>
                        <td>{{ $payment->created_at->toDateString() }}</td>
                        <!-- <td>
                            <a href="{{ route('client.details-loan', ['loanId' => $loan->id]) }}"><button  class="btn btn-primary"><i class='bi bi-eye'></i></button></a>
                        </td> -->
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>


</main><!-- End #main -->
