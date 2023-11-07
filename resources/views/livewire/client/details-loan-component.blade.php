<div>
    <h1>Détails du prêt</h1>
    <p>Type du prêt: {{ $loan->loan_type_id }}</p>
    <p>Montant: {{ $loan->loan_amount }} FCFA</p>
    <p>Status: {{ $loan->status }}</p>
    <p>Date: {{ $loan->due_date }}</p>
    <!-- Affichez d'autres détails du prêt ici -->
</div>

