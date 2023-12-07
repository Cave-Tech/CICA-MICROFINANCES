<main id="main" class="main">

    <div class="pagetitle">
        <h1>GESTION DES COMPTES </h1>
    </div><!-- End Page Title -->


    @if($message = Session::get('success'))
        <div id="success-alert" class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif

    @if($message = Session::get('fail'))
        <div id="fail-alert" class="alert alert-danger">
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

                        <div class="left-align">
                            <a href="{{ url('/create-savings-account')}}" type="button" class="btn btn-primary" >
                                Ajouter un nouveau compte
                            </a>
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
                             
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($savingsAccounts as $savingsAccount)
                                    <tr>
                                        <th scope="row">{{ $savingsAccount->account_number }}</th>
                                        <td>{{ $savingsAccount->user->name }}</td>
                                        <td>{{ $savingsAccount->user->email }}</td>
                                        <td>{{ $savingsAccount->user->phone }}</td>
                                        <td>{{ $savingsAccount->balance }} FCFA</td>
                                       
                                        <td>
                                            @if ($savingsAccount->status == "activated")
                                                <span class='badge bg-success'>Activer</span>
                                            @elseif ($savingsAccount->status == "blocked")
                                                <span class='badge bg-danger'>Bloquer</span>
                                            @elseif ($savingsAccount->status == "pending")
                                                <span class='badge bg-warning'>En attente</span>
                                            @endif
                                            
                                        </td>

                                      

                                        <td>
                                            <div class="btn-group" role="group">
                                                <button wire:click="showDetails({{ $savingsAccount->id }})" class="btn btn-primary"><i class='bi bi-eye'></i></button>        
                                            </div>
                                        </td>  
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
 
                    <!-- Modal -->
                    <div class="modal fade" id="ExtralargeModal" tabindex="-1" aria-labelledby="ExtralargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            @if($detailsSavingsAccount)
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ExtralargeModalLabel">Détails du compte</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><strong>Numéro de compte:</strong> {{ $detailsSavingsAccount->account_number }}</li>
                                                <li class="list-group-item"><strong>Nom et Prénom:</strong> {{ $detailsSavingsAccount->user->name }}</li>
                                                <li class="list-group-item"><strong>Email:</strong> {{ $detailsSavingsAccount->user->email }}</li>
                                                <li class="list-group-item"><strong>Solde:</strong> {{ $detailsSavingsAccount->balance }} FCFA<br></li>
                                                <li class="list-group-item">
                                                    <strong>Status:</strong>
                                                    @if ($detailsSavingsAccount->status == "activated")
                                                        <span class='badge bg-success'>Activer</span>
                                                    @elseif ($detailsSavingsAccount->status == "blocked")
                                                        <span class='badge bg-danger'>Bloquer</span>
                                                    @elseif ($detailsSavingsAccount->status == "pending")
                                                        <span class='badge bg-warning'>En attente</span>
                                                    @endif
                                                </li>
                                                <li class="list-group-item"><strong>Date de creation:</strong> {{ strftime('%d %B %Y', strtotime($detailsSavingsAccount->opening_date)) }}</li>

                                                <!-- Afficher le document PDF pour la pièce d'identité -->
                                                <li class="list-group-item">
                                                    <strong>Pièce d'identité:</strong>
                                                    @if($detailsSavingsAccount->user->identity_piece)
                                                        <embed src="{{ Storage::url($detailsSavingsAccount->user->identity_piece) }}" type="application/pdf" width="100%" height="600px" />
                                                        
                                                    @else
                                                        Aucun document
                                                    @endif
                                                </li>

                                                <!-- Afficher le document PDF pour le justificatif de domicile -->
                                                <li class="list-group-item">
                                                    <strong>Justificatif de domicile:</strong>
                                                    
                                                    @if($detailsSavingsAccount->user->proof_of_address)
                                                        <embed src="{{ Storage::url($detailsSavingsAccount->user->proof_of_address) }}" type="application/pdf" width="100%" height="600px" />
                                                    @else
                                                        Aucun document
                                                    @endif
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        
                                        @if($detailsSavingsAccount->status == "pending")
                                            <button type="button" class="btn btn-danger" wire:click="setBlocked({{$detailsSavingsAccount->id}})">Bloquer</button>
                                            <button type="button" class="btn btn-success" wire:click="setActivated({{$detailsSavingsAccount->id}})">Activer</button>
                                        @endif

                                        @if($detailsSavingsAccount->status == "activated")
                                                <button type="button" class="btn btn-danger" wire:click="setBlocked({{$detailsSavingsAccount->id}})">Bloquer</button>
                                        @endif
                                        @if($detailsSavingsAccount->status == "blocked")
                                            <button type="button" class="btn btn-success" wire:click="setActivated({{$detailsSavingsAccount->id}})">Activer</button>
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
        let modalEl = document.getElementById('ExtralargeModal');
        let modal = new bootstrap.Modal(modalEl);

        window.addEventListener('show-savings-account-modal', (event) => {
            modal.show();
        });

        window.addEventListener('close-savings-account-modal', (event) => {
            console.log('Fermeture du modal');
            modal.hide();
        });

        modalEl.addEventListener('hidden.bs.modal', () => {
            // Cette fonction est appelée après que le modal est complètement fermé
            window.livewire.dispatch('resetListener');
        });

    
    });
</script>


