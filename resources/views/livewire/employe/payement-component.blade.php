<main id="main" class="main">

<div class="pagetitle">
  <h1>PAIEMENT DES CLIENTS </h1>
</div><!-- End Page Title -->
    <!-- Message de succes ou d'erreur -->
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
 <!--Fin Message de succes ou d'erreur -->
<div class="card">
  <div class="card-body"><br>
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                <h5 class="card-title">EFFECTUER UN PAIEMENT</h5>

                <!-- Before your table, add this search input -->
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Rechercher" wire:model.live="search">
                </div>
                
                <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nom et Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Montant</th>
                        <th scope="col">Reste</th>
                        <th scope="col">Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @if($loansInProgress->isNotEmpty())
                    @php $loan = $loansInProgress->first(); @endphp
                    <tr>
                        <td>{{ $loan->borrower->name }}</td>
                        <td>{{ $loan->borrower->email }}</td>
                        <td>{{ $loan->borrower->phone }}</td>
                        <td><img src="{{ asset('storage/' . $loan->borrower->profile_picture) }}" alt="Photo de profil" width="80" height="80"></td>
                        <td>{{ number_format($loan->loan_amount, 2, ',', ' ') }} FCFA</td>
                        <td>{{ $this->remainingAmount($loan) }}</td>
                        <td>
                            @unless (floatval($this->remainingAmount($loan)) == 0)
                                <!-- Formulaire de paiement -->
                                <form wire:submit.prevent="makePayment('{{ $loan->id }}')" class="d-flex align-items-center">
                                    <div class="input-group">
                                        <input type="number" wire:model="paymentAmount" class="form-control" placeholder="Montant" required>
                                        <button type="submit" class="btn btn-primary">Payer</button>
                                    </div>
                                </form>
                            @else
                                <span class="badge bg-success">Paiement Terminé</span>
                            @endunless
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="7" class="text-center">Aucun prêt en cours.</td>
                    </tr>
                @endif

                </tbody>
            </table>

                </div>
            </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Mes Paiements</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
    <thead>
        <tr>
            <th scope="col">Photo</th>
            <th scope="col">Nom</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Montant</th>
            <th scope="col">Date de paiement</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($agentPayments->sortByDesc('payment_date') as $agentPayment)
    <tr>
        <td><img src="{{ asset('storage/' . $agentPayment->loan->borrower->profile_picture) }}" alt="Photo de profil" width="80" height="80"></td>
        <!--<th scope="row">{{ $agentPayment->id }}</th>-->
        <td>{{ $agentPayment->loan->borrower->name }}</td>
        <td>{{ $agentPayment->loan->borrower->phone }}</td>
        <td>{{ $agentPayment->payment_amount }}</td>
        <td>{{ strftime('%d %B %Y', strtotime($agentPayment->payment_date)) }}</td>
    </tr>
  @endforeach
    </tbody>
</table>

              <!-- End Table with stripped rows -->
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



