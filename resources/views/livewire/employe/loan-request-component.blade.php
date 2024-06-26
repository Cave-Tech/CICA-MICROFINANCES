<main id="main" class="main">

    <div class="pagetitle">
    <h1>LISTE DES DEMANDES DE PRET </h1>
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

    <div class="left-align" style="margin-bottom: 20px;">
        <a href="{{ url('/create-loan-request')}}" type="button" class="btn btn-primary" >
            Enregistrer un nouveau prêt
        </a>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                <!-- <h5 class="card-title">Les prets</h5> -->

                <!-- Before your table, add this search input -->
                <!-- <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Rechercher" wire:model.live="search">
                </div> -->

                
                
                <table class="table datatable">
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
                    @foreach($loans as $loan)
                        <tr>
                        <td>{{ $loan->borrower->name }}</td>
                        <td>{{ $loan->borrower->email }}</td>
                        <td>
                            @if ($loan->loan_type_id == 1)
                                <span class='badge bg-success'>pret automobile</span>
                            @elseif ($loan->loan_type_id == 2)
                                <span class='badge bg-success'>pret immobilier</span>
                            @elseif ($loan->loan_type_id == 3)
                                <span class='badge bg-success'>pret groupé</span>
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
                            <span class="badge bg-success">Terminé</span> 
                        @elseif ($loan->status === 'rejected')
                            <span class="badge bg-danger">Rejeté</span>
                        @elseif ($loan->status === 'in payment')
                            <span class="badge bg-success">En cours de paiement</span>
                        @endif
                        </td>
                        <td>{{ $loan->created_at->toDateString() }}</td>
                        <td>
                            
                            <div class="btn-group" role="group">
                                <a href="{{ route('client.details-loan', ['loanId' => $loan->id]) }}"><button  class="btn btn-primary"><i class='bi bi-eye'></i></button></a>
                                @if ($loan->status === 'pending')
                                    <button wire:click="confirmDelete({{ $loan->id }})" class='btn btn-danger' data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"><i class='bi bi-trash'></i></button>  
                                @endif
                               
                            </div>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>

                <div class="modal fade" wire:ignore.self id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
                                <button type="button"  class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer cette opération ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                <button wire:click="deleteLoan" class="btn btn-danger">Confirmer la suppression</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>


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
        window.livewire.emit('resetListener');
    });

   
});
</script>



