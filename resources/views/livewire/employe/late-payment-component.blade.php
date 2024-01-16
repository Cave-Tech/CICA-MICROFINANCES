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
                                <h5 class="card-title">PAIEMENTS EN RETARD</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Photo</th>
                                            <th scope="col">Nom et Prénom</th>
                                            <!-- <th scope="col">Montant Total</th>
                                            <th scope="col">Reste à Payer</th> -->
                                            <th scope="col">Date attendu</th>
                                            <th scope="col">Montant Attendu</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($latePayments as $payment)
                                            <tr>
                                                <td><img src="{{ asset('storage/' . $payment->loan->borrower->profile_picture) }}" alt="Photo" width="50" height="50"></td>
                                                <td>{{ $payment->loan->borrower->name }}</td>
                                                <td>{{ $payment->expected_payment_date }}</td>
                                                <!-- <td>{{ number_format($this->totalAmount($payment->loan), 2) }} FCFA</td>
                                                <td>{{ number_format($this->remainingAmount($payment->loan), 2) }} FCFA</td> -->
                                                <td>{{ number_format($payment->payment_amount, 2) }} FCFA</td>
                                                <td>
                                                    <form wire:submit.prevent="makePayment('{{ $payment->id }}')" class="d-flex align-items-center">
                                                        <div class="input-group">
                                                            <!-- <input type="number" wire:model="paymentAmounts.{{ $payment->id }}" class="form-control" placeholder="Montant" required> -->
                                                            <button type="submit" class="btn btn-primary">Payer</button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Aucun paiement en retard pour l'instant.</td>
                                            </tr>
                                        @endforelse
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


