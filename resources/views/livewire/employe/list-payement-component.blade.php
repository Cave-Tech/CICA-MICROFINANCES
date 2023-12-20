<main id="main" class="main">
<div class="card">
  <div class="card-body"><br>
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
                      <td>{{ $agentPayment->payment_amount }} FCFA</td>
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




