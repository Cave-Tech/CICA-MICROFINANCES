<main id="main" class="main">

<div class="pagetitle">
  <h1>GESTION DES OPERATIONS </h1>
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
                <h5 class="card-title">Mes opérations</h5>

                <!-- Before your table, add this search input -->
                <!-- <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Rechercher" wire:model.live="search">
                </div> -->
                
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
                                    <span class='badge bg-danger'>Annuler</span>
                                @endif
                                
                            </td>

                            <td>{{ strftime('%d %B %Y', strtotime($operation->withdrawal_date)) }}</td>

                            <td>
                                <div class="btn-group" role="group">
                                    <button wire:click="showDetails({{ $operation->id }})"  class="btn btn-primary"><i class='bi bi-eye'></i></button>        
                                </div>
                            </td>  
                            
                           
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>
                </div>
            </div>
            

            <!-- Modal -->
            <div class="modal fade" id="operationModal" tabindex="-1" aria-labelledby="operationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    @if($detailsOperation)
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="operationModalLabel">Détails de l'opération</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                
                                    <div class="card">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><strong>Code unique:</strong> {{ $detailsOperation->transaction_key }}</li>
                                            <li class="list-group-item"><strong>Nom et Prénom:</strong> {{ $detailsOperation->user->name }}</li>
                                            <li class="list-group-item"><strong>Email:</strong> {{ $detailsOperation->user->email }}</li>
                                            <li class="list-group-item"><strong>Montant:</strong> {{ $detailsOperation->withdrawal_amount }}<br></li>
                                            <li class="list-group-item"><strong>Type d'opération:</strong> {{ $detailsOperation->operationType->designation }}<br></li>
                                            <li class="list-group-item">
                                                <strong>Status:</strong>
                                                @if ($detailsOperation->status == "completed")
                                                    <span class='badge bg-success'>Terminé</span>
                                                @elseif ($detailsOperation->status == "pending")
                                                    <span class='badge bg-warning'>En cours</span>
                                                @else
                                                    <span class='badge bg-danger'>Annuler</span>
                                                @endif
                                            </li>
                                            <li class="list-group-item"><strong>Date:</strong> {{ strftime('%d %B %Y', strtotime($detailsOperation->withdrawal_date)) }}</li>
                                        </ul>
                                    </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                
                                @if($detailsOperation->status != "completed" && $detailsOperation->status != "canceled")
                                    <button type="button" class="btn btn-success" wire:click="setCompleted({{$detailsOperation->id}})">Valider</button>
                                    <button type="button" class="btn btn-danger" wire:click="setCancelled({{$detailsOperation->id}})">Annuler</button>
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
        let modalEl = document.getElementById('operationModal');
        let modal = new bootstrap.Modal(modalEl);

        window.addEventListener('show-operation-modal', (event) => {
            
            modal.show();
        });

        window.addEventListener('close-operation-modal', () => {
            modal.hide();
        });

        modalEl.addEventListener('hidden.bs.modal', () => {
            // Cette fonction est appelée après que le modal est complètement fermé
            window.livewire.dispatch('resetListener');
        });

    
    });
</script>



