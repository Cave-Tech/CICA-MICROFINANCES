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
                <h5 class="card-title">Mes opérations</h5>
                
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">#Code unique</th>
                            <th scope="col">Nom et Prénom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Type d'opération</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($operations as $operation)
                        <tr>
                        <th scope="row">{{ $operation->transaction_key }}</th>
                            <td>{{ $operation->user->name }}</td>
                            <td>{{ $operation->user->email }}</td>
                            <td>{{ $operation->withdrawal_amount }}</td>
                            <td>{{ $operation->operationType->designation }}</td>

                            <td>
                                @if ($operation->status == "completed")
                                    <span class='badge bg-success'>Terminé</span>
                                @elseif ($operation->status == "pending")
                                    <span class='badge bg-warning'>En cours</span>
                                @else
                                    <span class='badge bg-danger'>En instance</span>
                                @endif
                                
                            </td>

                            <td>{{ strftime('%d %B %Y', strtotime($operation->withdrawal_date)) }}</td>

                            <td>
                                <div class="btn-group" role="group">
                                    <button wire:click="showDetails({{ $operation->id }})" data-bs-toggle="modal" data-bs-target="#operationModal" class="btn btn-primary"><i class='bi bi-eye'></i></button>        
                                </div>
                            </td>  
                            
                           
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>
                </div>
            </div>
            

            <!-- Modal -->
            <div class="modal fade" id="operationModal" tabindex="-1" wire:ignore>
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Détail de l'opération</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{$detailsOperation}}
                            @if($detailsOperation)
                                <p><strong>Code unique:</strong> {{ $detailsOperation->transaction_key }}</p>
                                <p><strong>Montant:</strong> {{ $detailsOperation->withdrawal_amount }}</p>
                                <p><strong>Nom et Prénom:</strong> {{ $detailsOperation->user->name }}</p>
                                <p><strong>Email:</strong> {{ $detailsOperation->user->email }}</p>
                                <p><strong>Type d'opération:</strong> {{ $detailsOperation->operationType->designation }}</p>
                                <p><strong>Status:</strong> 
                                    @if ($detailsOperation->status == "completed")
                                        <span class='badge bg-success'>Terminé</span>
                                    @elseif ($detailsOperation->status == "pending")
                                        <span class='badge bg-warning'>En cours</span>
                                    @else
                                        <span class='badge bg-danger'>En instance</span>
                                    @endif
                                </p>
                                <p><strong>Date:</strong> {{ strftime('%d %B %Y', strtotime($detailsOperation->withdrawal_date)) }}</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="setCancelled({{ $detailsOperation->id }})" class="btn btn-danger">Annuler</button>
                            <button type="button" wire:click="setCompleted({{ $detailsOperation->id }})" class="btn btn-success">Valider</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
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
    window.livewire.on('alert', params => {
        // Utilisez votre logique d'affichage d'alerte ici. Par exemple, si vous utilisez Toasts ou une autre bibliothèque pour afficher des messages.
        alert(params.message);
    });
</script>