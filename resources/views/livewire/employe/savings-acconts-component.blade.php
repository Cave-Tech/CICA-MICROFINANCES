<main id="main" class="main">

    <div class="pagetitle">
        <h1>GESTION DES OPERATIONS </h1>
    </div><!-- End Page Title -->


    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif

    @if($message = Session::get('fail'))
        <div class="alert alert-danger">
            <p>{{$message}}</p>
        </div>
    @endif

    <div class="card">
        <div class="card-body"><br>
            <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Compte Courants</h5>

                        <!-- Before your table, add this search input -->
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Rechercher" wire:model.live="search">
                        </div>
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Numero de compte</th>
                                    <th scope="col">Nom et Prénom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Numero de téléphone</th>
                                    <th scope="col">Solde</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date de creation</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($savingsAccounts as $savingsAccount)
                                    <tr>
                                        <th scope="row">{{ $savingsAccount->account_number }}</th>
                                        <td>{{ $savingsAccount->user->name }}</td>
                                        <td>{{ $savingsAccount->user->email }}</td>
                                        <td>{{ $savingsAccount->balance }}</td>
                                       
                                        <td>
                                            @if ($savingsAccount->status == "activated")
                                                <span class='badge bg-success'>Activer</span>
                                            @elseif ($savingsAccount->status == "blocked")
                                                <span class='badge bg-warning'>Bloquer</span>
                                            @endif
                                            
                                        </td>

                                        <td>{{ strftime('%d %B %Y', strtotime($savingsAccount->opening_date)) }}</td>

                                        <td>
                                            <div class="btn-group" role="group">
                                                <button wire:click="showDetails({{ $savingsAccount->id }})" data-bs-toggle="modal" data-bs-target="#savingsAccountModal" class="btn btn-primary"><i class='bi bi-eye'></i></button>        
                                            </div>
                                        </td>  
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
 
                    <!-- Modal -->
                    <div class="modal fade" id="savingsAccountModal" tabindex="-1" aria-labelledby="savingsAccountModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            @if($detailssavingsAccount)
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="savingsAccountModalLabel">Détails de l'opération</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                            <div class="card">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><strong>Numéro de compte:</strong> {{ $detailssavingsAccount->transaction_key }}</li>
                                                    <li class="list-group-item"><strong>Nom et Prénom:</strong> {{ $detailssavingsAccount->user->name }}</li>
                                                    <li class="list-group-item"><strong>Email:</strong> {{ $detailssavingsAccount->user->email }}</li>
                                                    <li class="list-group-item"><strong>Solde:</strong> {{ $detailssavingsAccount->withdrawal_amount }}<br></li>
                                                    <li class="list-group-item">
                                                        <strong>Status:</strong>
                                                        @if ($detailssavingsAccount->status == "activated")
                                                            <span class='badge bg-success'>Activer</span>
                                                        @elseif ($detailssavingsAccount->status == "blocked")
                                                            <span class='badge bg-warning'>Bloquer</span>
                                                        @endif
                                                    </li>
                                                    <li class="list-group-item"><strong>Date de creation:</strong> {{ strftime('%d %B %Y', strtotime($detailssavingsAccount->opening_date)) }}</li>
                                                </ul>
                                            </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        
                                        @if($detailssavingsAccount->status != "completed" && $detailssavingsAccount->status != "canceled")
                                            <button type="button" class="btn btn-success" wire:click="setCompleted({{$detailssavingsAccount->id}})">Valider</button>
                                            <button type="button" class="btn btn-danger" wire:click="setCancelled({{$detailssavingsAccount->id}})">Annuler</button>
                                        @endif
                                    </div>

                                </div>
                            @endif
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
        let modalEl = document.getElementById('savingsAccountModal');
        let modal = new bootstrap.Modal(modalEl);

        window.addEventListener('show-operation-modal', (event) => {
            modal.show();
        });

        window.addEventListener('close-operation-modal', () => {
            modal.hide();
        });

        modalEl.addEventListener('hidden.bs.modal', () => {
            // Cette fonction est appelée après que le modal est complètement fermé
            window.livewire.emit('resetListener');
        });

    
    });
</script>



