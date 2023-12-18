

<main id="main" class="main">

    <h1>Détails du Prêt</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
        <li class="breadcrumb-item">Prêt</li>
        <li class="breadcrumb-item active">Détails</li>
        </ol>
    </nav>

    @if(auth()->user()->employee_type_id == 4 && $loan->status === 'in progress')
        <!-- Boutons pour valider ou rejeter le prêt -->
        <div class="left-align">
            <button wire:click="validateLoan({{$loan->id}})" class="btn btn-success">Valider</button>
            <button wire:click="rejectLoan({{$loan->id}})" class="btn btn-danger">Rejeter</button>
        </div>
        <br>
    @elseif(auth()->user()->employee_type_id == 5 && $loan->status === 'pending')
        <!-- Boutons pour valider ou rejeter le prêt -->
        <div class="left-align">
            <button wire:click="preValidateLoan({{$loan->id}})" class="btn btn-success">Pre-Valider</button>
            <button wire:click="rejectLoan({{$loan->id}})" class="btn btn-danger">Rejeter</button>
        </div>
        <br>
    @endif
   

    <div class="row">

        <div class="col-md-6">
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informations du Prêt</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Type de Prêt:</strong> {{ $loan->loan_type_id == 1 ? 'Prêt Automobile' : 'Prêt Immobilier' }}</li>
                        <li class="list-group-item"><strong>Montant:</strong> {{ number_format($loan->loan_amount, 2, ',', ' ') }} FCFA</li>
                        <li class="list-group-item"><strong>Status:</strong> 
                            @if ($loan->status === 'validated')
                                <span class="badge bg-success">Valider</span>
                            @elseif ($loan->status === 'pending')
                                <span class="badge bg-warning text-dark">En attente</span>
                            @elseif ($loan->status === 'in progress')
                                <span class="badge bg-info">En cours</span>
                            @elseif ($loan->status === 'completed')
                                <span class="badge bg-success">Solder</span> 
                            @else
                                <span class="badge bg-danger">Rejeté</span>
                            @endif
                        </li>
                        <li class="list-group-item"><strong>Date d'échéance:</strong> {{ date('d F Y', strtotime($loan->loan_date)) }}</li>
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
                        <li class="list-group-item"><strong>Relation avec le Garant:</strong> {{ $loan->relation_warrantor == 1 ? 'Parents' : ($loan->relation_warrantor == 2 ? 'Amis' : 'Autre') }}</li>
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

    
    @if($loan->payment && $loan->status === 'validated' || $loan->status === 'completed')
        <div class="pagetitle">
            <h1>Historique des paiements</h1>
        </div>
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Pourcentage de paiement :</h5>

        <!-- Progress Bar with label -->
                @if($this->remainingAmount($loan) <= 25)
                <div class="progress mt-3">
                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $this->remainingAmount($loan) }} %</div>
              </div>
                @elseif($this->remainingAmount($loan) <= 50)
                <div class="progress mt-3">
                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $this->remainingAmount($loan) }} %</div>
              </div>
                @elseif($this->remainingAmount($loan) <= 75)
                <div class="progress mt-3">
                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $this->remainingAmount($loan) }} %</div>
              </div>
                @elseif($this->remainingAmount($loan) < 100)
                <div class="progress mt-3">
                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 90%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $this->remainingAmount($loan) }} %</div>
              </div>
              @elseif($this->remainingAmount($loan) == 100)
                <div class="progress mt-3">
                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $this->remainingAmount($loan) }} %</div>
              </div>
            @endif
            </div>
        </div>
        <!-- End Progress Bar with label -->
    </div>
</div>


        <br>

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <!--<th scope="col">Id</th>-->
                            <th scope="col">Montant paye</th>
                            <th scope="col">Status</th>
                            <th scope="col">Agent</th>
                            <th scope="col">Date</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($loan->payment as $payment)
                            <tr>
                            <!--<td>
                                {{ $payment->id }}
                                
                            </td>-->
                            <td>{{ number_format($payment->payment_amount, 2, ',', ' ') }} FCFA</td>
                            <td>
                                @if ($payment->status == "pending")
                                    <span class='badge bg-warning'>En attente</span>
                                @else($payment->status == "completed")
                                    <span class='badge bg-success'>Valider</span>
                                @endif
                            </td>
                            <td>{{ $loan->agent->name }}</td>
                            <td>{{ date('d F Y', strtotime($payment->payment_date)) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    @endif

</main><!-- End #main -->
