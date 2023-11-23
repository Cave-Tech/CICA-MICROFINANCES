<main id="main" class="main">

    <div class="pagetitle">
        <h1>GESTION DES COMPTES </h1>
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

                        <div class="left-align">
                            <a href="{{ url('/create-current-account')}}" type="button" class="btn btn-primary" >
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
                                @foreach($currentAccounts as $currentAccount)
                                    <tr>
                                        <th scope="row">{{ $currentAccount->account_number }}</th>
                                        <td>{{ $currentAccount->user->name }}</td>
                                        <td>{{ $currentAccount->user->email }}</td>
                                        <td>{{ $currentAccount->user->phone }}</td>
                                        <td>{{ $currentAccount->balance }} FCFA</td>
                                       
                                        <td>
                                            @if ($currentAccount->status == "activated")
                                                <span class='badge bg-success'>Activer</span>
                                            @elseif ($currentAccount->status == "blocked")
                                                <span class='badge bg-danger'>Bloquer</span>
                                            @elseif ($currentAccount->status == "pending")
                                                <span class='badge bg-warning'>En attente</span>
                                            @endif
                                            
                                        </td>

                                      

                                        <td>
                                            <div class="btn-group" role="group">
                                                <button wire:click="showDetails({{ $currentAccount->id }})" data-bs-toggle="modal" data-bs-target="#currentAccountModal" class="btn btn-primary"><i class='bi bi-eye'></i></button>        
                                            </div>
                                        </td>  
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
 
                    <!-- Modal -->
                    <div class="modal fade" id="currentAccountModal" tabindex="-1" aria-labelledby="currentAccountModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            @if($detailsCurrentAccount)
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="currentAccountModalLabel">Détails du compte</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><strong>Numéro de compte:</strong> {{ $detailsCurrentAccount->account_number }}</li>
                                                <li class="list-group-item"><strong>Nom et Prénom:</strong> {{ $detailsCurrentAccount->user->name }}</li>
                                                <li class="list-group-item"><strong>Email:</strong> {{ $detailsCurrentAccount->user->email }}</li>
                                                <li class="list-group-item"><strong>Solde:</strong> {{ $detailsCurrentAccount->balance }} FCFA<br></li>
                                                <li class="list-group-item">
                                                    <strong>Status:</strong>
                                                    @if ($detailsCurrentAccount->status == "activated")
                                                        <span class='badge bg-success'>Activer</span>
                                                    @elseif ($detailsCurrentAccount->status == "blocked")
                                                        <span class='badge bg-danger'>Bloquer</span>
                                                    @elseif ($detailsCurrentAccount->status == "pending")
                                                        <span class='badge bg-warning'>En attente</span>
                                                    @endif
                                                </li>
                                                <li class="list-group-item"><strong>Date de creation:</strong> {{ strftime('%d %B %Y', strtotime($detailsCurrentAccount->opening_date)) }}</li>

                                                <!-- Afficher le document PDF pour la pièce d'identité -->
                                                <li class="list-group-item">
                                                    <strong>Pièce d'identité:</strong>
                                                    @if($detailsCurrentAccount->user->identity_piece)
                                                        <embed src="{{ Storage::url($detailsCurrentAccount->user->identity_piece) }}" type="application/pdf" width="100%" height="600px" />
                                                        
                                                    @else
                                                        Aucun document
                                                    @endif
                                                </li>

                                                <!-- Afficher le document PDF pour le justificatif de domicile -->
                                                <li class="list-group-item">
                                                    <strong>Justificatif de domicile:</strong>
                                                    
                                                    @if($detailsCurrentAccount->user->proof_of_address)
                                                        <embed src="{{ Storage::url($detailsCurrentAccount->user->proof_of_address) }}" type="application/pdf" width="100%" height="600px" />
                                                    @else
                                                        Aucun document
                                                    @endif
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        
                                        @if($detailsCurrentAccount->status == "pending")
                                            <button type="button" class="btn btn-danger" wire:click="setBlocked({{$detailsCurrentAccount->id}})">Bloquer</button>
                                            <button type="button" class="btn btn-success" wire:click="setActivated({{$detailsCurrentAccount->id}})">Activer</button>
                                        @endif

                                        @if($detailsCurrentAccount->status == "activated")
                                                <button type="button" class="btn btn-danger" wire:click="setBlocked({{$detailsCurrentAccount->id}})">Bloquer</button>
                                        @endif
                                        @if($detailsCurrentAccount->status == "blocked")
                                            <button type="button" class="btn btn-success" wire:click="setActivated({{$detailsCurrentAccount->id}})">Activer</button>
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
        let modalEl = document.getElementById('currentAccountModal');
        let modal = new bootstrap.Modal(modalEl);

        window.addEventListener('show-current-account-modal', (event) => {
            modal.show();
        });

        window.addEventListener('close-current-account-modal', () => {
            console.log('Fermeture du modal');
            modal.hide();
        });

        modalEl.addEventListener('hidden.bs.modal', () => {
            // Cette fonction est appelée après que le modal est complètement fermé
            window.livewire.dispatch('resetListener');
        });

    
    });
</script>



