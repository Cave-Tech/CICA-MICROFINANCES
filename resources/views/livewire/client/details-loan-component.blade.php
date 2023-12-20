

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
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">Rejeter</button>
        </div>

        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form wire:submit.prevent="rejectLoan">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="rejectModalLabel">Formulaire de Prêt</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                                <input type="hidden" wire:model="loanId" value="{{$loan->id}}">
                        
                                <div class="form-group">
                                    <label for="rejectReason" class="form-label">Expliquez le motif du refus :</label>
                                    <textarea wire:model="rejectReason" class="form-control" id="rejectReason" rows="4"></textarea>
                                </div><br>
                       
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
    @elseif(auth()->user()->employee_type_id == 5 && $loan->status === 'pending')
        <!-- Boutons pour valider ou rejeter le prêt -->
        <div class="left-align">
            <button wire:click="preValidateLoan({{$loan->id}})" class="btn btn-success">Pre-Valider</button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">Rejeter</button>
        </div>

        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form wire:submit.prevent="rejectLoan">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="rejectModalLabel">Formulaire de Prêt</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                                <input type="hidden" wire:model="loanId" value="{{$loan->id}}">
                        
                                <div class="form-group">
                                    <label for="rejectReason" class="form-label">Expliquez le motif du refus :</label>
                                    <textarea wire:model="rejectReason" class="form-control" id="rejectReason" rows="4" required></textarea>
                                </div><br>

                                @error('rejectReason')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                       
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">Envoyer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>
    @endif
   

    <div class="row">

        <div class="col-md-6">
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informations du Prêt</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-7 col-md-4 label "><strong>Type de Prêt:</strong> </div>
                                <div class="col-lg-5 col-md-6"> {{ $loan->loan_type_id == 1 ? 'Prêt Automobile' : '' }}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-7 col-md-4 label "><strong>Montant:</strong></div>
                                <div class="col-lg-5 col-md-6">{{ number_format($loan->loan_amount, 2, ',', ' ') }} FCFA</div>
                            </div>
                        </li>
                        <li class="list-group-item"> 
                            

                            <div class="row">
                                <div class="col-lg-7 col-md-4 label "><strong>Status:</strong></div>
                                <div class="col-lg-5 col-md-6">
                                @if ($loan->status === 'validated')
                                    <span class="badge bg-success">Valider</span>
                                @elseif ($loan->status === 'pending')
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @elseif ($loan->status === 'in progress')
                                    <span class="badge bg-info">En cours</span>
                                @elseif ($loan->status === 'completed')
                                    <span class="badge bg-success">Terminé</span> 
                                @else
                                    <span class="badge bg-danger">Rejeté</span>
                                @endif
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                             
                            <div class="row">
                                <div class="col-lg-7 col-md-4 label "><strong>Date d'échéance:</strong></div>
                                <div class="col-lg-5 col-md-6">{{ date('d F Y', strtotime($loan->loan_date)) }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Détails du Garant</h5>
                    <ul class="list-group list-group-flush">{{ $loan->relation_warrantor == 1 ? 'Parents' : '' }}
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-7 col-md-4 label "><strong>Nom du Garant:</strong></div>
                                <div class="col-lg-5 col-md-6">{{ $loan->name_warrantor }}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-7 col-md-4 label "><strong>Numéro du Garant:</strong></div>
                                <div class="col-lg-5 col-md-6">{{ $loan->number_warrantor }}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-7 col-md-4 label "><strong>Adresse du Garant:</strong></div>
                                <div class="col-lg-5 col-md-6">{{ $loan->address_warrantor }}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-7 col-md-4 label "><strong>Relation avec le Garant:</strong></div>
                                <div class="col-lg-5 col-md-6">{{ $loan->relation_warrantor == 1 ? 'Parents' : ($loan->relation_warrantor == 2 ? 'Amis' : 'Autre') }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @if($loan->status === 'rejected')

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Motif de refus du pret</h5>
                        <div class="row">
                            <!-- <div class="col-lg-7 col-md-4 label "><strong>Relation avec le Garant:</strong></div> -->
                            <div class="col-lg-5 col-md-6">{{ $loan->reject_reason}}</div>
                        </div>
                        
                    </div>
                </div>
            </div>
        @endif
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

    
    @if($loan->payment && $loan->status === 'validated')
        <div class="pagetitle">
            <h1>Historique des paiements</h1>
        </div>

        <div id="success-alert" class="alertt alert-success">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <p class="font-weight-bold">
        Vous êtes à 
        <span class="{{ $this->remainingAmount($loan) >= 90 ? 'text-danger' : ($this->remainingAmount($loan) >= 75 ? 'text-warning' : 'text-success') }}">
            {{ $this->remainingAmount($loan) }}
        </span>
        de votre paiement.
    </p>
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
                            <!--<th scope="col">Id</th>-->
                            <th scope="col">Montant paye</th>
                            <th scope="col">Status</th>
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
    @endif


       


   


</main><!-- End #main -->



<script>
    document.addEventListener('DOMContentLoaded', () => {
        let modalEl = document.getElementById('rejectModal');
        let modal = new bootstrap.Modal(modalEl);


        window.addEventListener('loanStatusUpdated', (event) => {
            modal.hide();
        });

        modalEl.addEventListener('hidden.bs.modal', () => {
            // Cette fonction est appelée après que le modal est complètement fermé
            window.livewire.dispatch('resetListener');
        });

    
    });
</script>