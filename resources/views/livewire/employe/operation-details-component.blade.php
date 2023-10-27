

<div>
    @if($showModal)
        <div class="modal fade" id="operationModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Détail de l'opération</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if($operation)
                            <p><strong>Code unique:</strong> {{ $operation->transaction_key }}</p>
                            <p><strong>Montant:</strong> {{ $operation->withdrawal_amount }}</p>
                            <p><strong>Type d'opération:</strong> {{ $operation->operationType->designation }}</p>
                            <p><strong>Status:</strong> 
                                @if ($operation->status == "completed")
                                    <span class='badge bg-success'>Terminé</span>
                                @elseif ($operation->status == "pending")
                                    <span class='badge bg-warning'>En cours</span>
                                @else
                                    <span class='badge bg-danger'>En instance</span>
                                @endif
                            </p>
                            <p><strong>Date:</strong> {{ strftime('%d %B %Y', strtotime($operation->withdrawal_date)) }}</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-warning" wire:click="cancelOperation">Annuler</button>
                        <button type="button" class="btn btn-primary" wire:click="completeOperation">Valider</button>
                    </div>
                </div>
            </div>
        </div>

    @endif
</div>