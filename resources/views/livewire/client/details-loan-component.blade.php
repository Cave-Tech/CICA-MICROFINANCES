

<main id="main" class="main">

    <!-- Message de succes ou d'erreur -->
    @if($message = Session::get('success'))
        <div id="success-alert" class="alertt alert-success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <p>{{$message}}</p>
        </div>
    @endif

    @if($message = Session::get('fail'))
        <div id="fail-alert" class="alert alert-danger">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <p>{{$message}}</p>
        </div>
    @endif
    <!--Fin Message de succes ou d'erreur -->


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
                                <div class="col-lg-7 col-md-4 label"><strong>Taux d'interet:</strong></div>
                                <div class="col-lg-5 col-md-6">{{ $loan->interest_rate }} %</div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-7 col-md-4 label"><strong>Montant à payer:</strong></div>
                                <div class="col-lg-5 col-md-6">
                                    {{ number_format($loan->loan_amount * (1 + ($loan->interest_rate / 100)), 2, ',', ' ') }} FCFA
                                </div>
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
                    <ul class="list-group list-group-flush">
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

        @if($message = Session::get('success1'))
            <div id="success-alert" class="alertt alert-success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <p>{{$message}}</p>
            </div>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informations sur le remboursement</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-5 col-md-2 label "><strong>Durée du pret:</strong></div>
                                <div class="col-lg-3 col-md-4">{{ $loan->payment_frequency }} mois</div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-5 col-md-2 label "><strong>Date de decaissement du pret</strong></div>
                                <div class="col-lg-3 col-md-4">{{ date('d F Y', strtotime($loan->loan_date)) ?  date('d F Y', strtotime($loan->loan_date)) : 'Pas encore defini'}} </div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-5 col-md-2 label "><strong>Date d'echeance du pret</strong></div>
                                <div class="col-lg-3 col-md-4">{{ date('d F Y', strtotime($loan->due_date)) ?  date('d F Y', strtotime($loan->due_date)) : 'Pas encore defini'}} </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-5 col-md-2 label "><strong>Frequence de paiement:</strong></div>
                                <div class="col-lg-3 col-md-4">Chaque mois</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-5 col-md-2 label "><strong>Montant a payer par mois:</strong></div>
                                <div class="col-lg-3 col-md-4">{{ number_format(($loan->loan_amount * (1 + ($loan->interest_rate / 100))) / $loan->payment_frequency, 2, ',', ' ') }} FCFA</div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-5 col-md-2 label "><strong>Agent de terrain a charge:</strong></div>
                                <div class="col-lg-3 col-md-4">
                                 
                                    @if($loan->agent_terain)
                                        {{ $loan->agent_terain->name }}
                                    @else
                                        @if(auth()->user()->employee_type_id == 5)
                                            <!-- Afficher le champ de formulaire pour ajouter un nouvel agent de terrain -->
                                            <form wire:submit.prevent="updateAgentTerrain" class="php-email-form">
                                            
                                                <div class="row">
                                                
                                                    <div class="form-group col-lg-10 col-md-5 ">
                                                        <input type="text" class="form-control" wire:model.live="name" name="name"
                                                            placeholder="Entrez le nom" autocomplete="off" required>
                                                        <div>
                                                            @if(!empty($name))
                                                            <div class="list-group">
                                                                @foreach($filteredUsers as $user)
                                                                <a href="#" wire:click.prevent="selectUser({{ $user->id }})"
                                                                    class="list-group-item list-group-item-action">
                                                                    {{ $user->name }}
                                                                </a>
                                                                @endforeach
                                                            </div>
                                                            @endif
                                                        </div>
                                                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                    <div class="col-lg-2 col-md-5">
                                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            <p>Non assigné</p>
                                        @endif
                                    @endif
                                    
                                </div>
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

    
    @if($loan->payment && $loan->status === 'validated' || $loan->status === 'completed')
        <div class="pagetitle">
            <h1>Historique des paiements</h1>
        </div>
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Pourcentage de paiement :</h5>

        <!-- Progress Bar with label -->
                <div class="progress mt-3">
                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: {{ $this->remainingAmount($loan) }} %" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $this->remainingAmount($loan) }} %</div>
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