<main id="main" class="main">

<div class="pagetitle">
  <h1>LES PRETS VALIDES </h1>
</div><!-- End Page Title -->

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

<div class="card">
  <div class="card-body"><br>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Les prets</h5>

                    <!-- Before your table, add this search input -->
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Rechercher" wire:model.live="search">
                    </div>
                    
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Nom et Prénom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Type du prêt</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($validatedLoan as $loan)
                            <tr>
                            <td>{{ $loan->borrower->name }}</td>
                            <td>{{ $loan->borrower->email }}</td>
                            <td>
                                @if ($loan->loan_type_id == 1)
                                    <span class='badge bg-success'>pret automobile</span>
                                @elseif ($loan->loan_type_id == 2)
                                    <span class='badge bg-warning'>pret immobilier</span>
                                @endif
                                
                            </td>
                            <td>{{ number_format($loan->loan_amount, 2, ',', ' ') }} FCFA</td>
                            <td>
                                @if ($loan->status === 'validated')
                                    <span class="badge bg-success">Valider</span>
                                @elseif ($loan->status === 'pending')
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @elseif ($loan->status === 'in progress')
                                    <span class="badge bg-info">En cours</span>
                                @elseif ($loan->status === 'completed')
                                    <span class="badge bg-success">Solder</span> 
                                @elseif ($loan->status === 'rejected')
                                    <span class="badge bg-danger">Rejeté</span>
                                @elseif ($loan->status === 'in payment')
                                    <span class="badge bg-success">En cours de paiement</span>
                                @endif
                            </td>
                            <td>{{ $loan->created_at->toDateString() }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button wire:click="showDetails({{ $loan->id }})"  class="btn btn-primary"><i class='bi bi-eye'></i></button>        
                                </div>
                            </td>  
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                 <!-- Modal -->
                <div class="modal fade" id="loanModal" tabindex="-1" aria-labelledby="loanModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        @if($detailsLoan)
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="loanModalLabel">Détails de pret</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    
                                        <div class="card">
                                            <ul class="list-group list-group-flush">
                                                
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-lg-7 col-md-4 label"><strong>Nom et Prénom:</strong> </div>
                                                        <div class="col-lg-5 col-md-6">{{ $detailsLoan->borrower->name }}</div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-lg-7 col-md-4 label"><strong>Email:</strong></div>
                                                        <div class="col-lg-5 col-md-6">{{ $detailsLoan->borrower->email }}</div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-lg-7 col-md-4 label"><strong>Téléphone:</strong> </div>
                                                        <div class="col-lg-5 col-md-6">{{ $detailsLoan->borrower->phone }}</div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-lg-7 col-md-4 label"><strong>Type de pret:</strong></div>
                                                        <div class="col-lg-5 col-md-6">{{ $detailsLoan->loanType->designation }}</div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-lg-7 col-md-4 label"><strong>Montant:</strong></div>
                                                        <div class="col-lg-5 col-md-6">{{ $detailsLoan->loan_amount }}</div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-lg-7 col-md-4 label"><strong>Taux d'interet:</strong> </div>
                                                        <div class="col-lg-5 col-md-6">{{ $detailsLoan->interest_rate }}%</div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-lg-7 col-md-4 label"><strong>Montant à rembourser:</strong></div>
                                                        <div class="col-lg-5 col-md-6">{{ number_format($detailsLoan->loan_amount * (1 + ($detailsLoan->interest_rate / 100)), 2, ',', ' ') }} FCFA</div>
                                                    </div>
                                                </li>
                                                
                                                <li class="list-group-item">
          
                                                    <div class="row">
                                                        <div class="col-lg-7 col-md-4 label"><strong>Status:</strong></div>
                                                        <div class="col-lg-5 col-md-6">
                                                            @if ($detailsLoan->status === 'validated')
                                                                <span class="badge bg-success">Valider</span>
                                                            @elseif ($detailsLoan->status === 'pending')
                                                                <span class="badge bg-warning text-dark">En attente</span>
                                                            @elseif ($detailsLoan->status === 'in progress')
                                                                <span class="badge bg-info">En cours</span>
                                                            @elseif ($detailsLoan->status === 'completed')
                                                                <span class="badge bg-success">Terminé</span> 
                                                            @elseif ($detailsLoan->status === 'rejected')
                                                                <span class="badge bg-danger">Rejeté</span>
                                                            @elseif ($detailsLoan->status === 'in payment')
                                                                <span class="badge bg-success">En cours de payment</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    
                                    @if($detailsLoan->status == "validated")
                                        <button type="button" class="btn btn-success" wire:click="setvalidated({{$detailsLoan->id}})">Valider</button>
                                    @endif
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
  </div>
</div>





</main>


<script>
document.addEventListener('DOMContentLoaded', () => {
    let modalEl = document.getElementById('loanModal');
    let modal = new bootstrap.Modal(modalEl);

    window.addEventListener('show-loan-modal', (event) => {
        modal.show();
    });

    window.addEventListener('close-loan-modal', () => {
        modal.hide();
    });

    modalEl.addEventListener('hidden.bs.modal', () => {
        // Cette fonction est appelée après que le modal est complètement fermé
        window.livewire.emit('resetListener');
    });

   
});
</script>



