<main id="main" class="main">

<div class="pagetitle">
  <h1>DEMANDE DE PRET EN ATTENTE </h1>
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
                                @foreach($loanInProgress as $loan)
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
                                        <span class="badge bg-success">Terminé</span> 
                                    @else
                                        <span class="badge bg-danger">Rejeté</span>
                                    @endif
                                    </td>
                                    <td>{{ $loan->created_at->toDateString() }}</td>
                                    <td>
                                      <a href="{{ route('client.details-loan', ['loanId' => $loan->id]) }}"><button  class="btn btn-primary"><i class='bi bi-eye'></i></button></a>
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
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
        window.livewire.emit('resetListener');
    });

   
});
</script>



