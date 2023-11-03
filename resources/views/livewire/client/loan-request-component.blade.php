<main id="main" class="main">

<style>

    /* Styles pour le formulaire de prêt */
.loan-form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.loan-form h3 {
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.form-select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
}

.btn-primary:hover {
    background-color: #0056b3;
}

</style>
    
<!-- Message de succes ou d'erreur -->
        @if($message = Session::get('success'))
        <div class="alertt">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{$message}}
        </div>
        @endif
        

        <!--Fin Message de succes ou d'erreur -->
        @if($message = Session::get('fail'))
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{$message}}
        </div>
        @endif

<div >
    <!--<div class="container">
        <div class="left-align">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loanModal">
                Nouveau Prêt
            </button>
        </div>
        <div class="modal fade" id="loanModal" tabindex="-1" role="dialog" aria-labelledby="loanModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form wire:submit.prevent="saveLoan" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="loanModalLabel">Formulaire de Prêt</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" wire:model="amount" class="form-control" id="loanAmount" placeholder="Montant du Prêt">
                                </div><br>
                                <div class="col-md-12">
                                    <select wire:model="typeloan" class="form-select" aria-label="Type d'opération" required>
                                        <option >Choisissez le type de prêt</option>
                                        <option value="1">Prêt hypothécaire</option>
                                        <option value="2">Prêt étudiant</option>
                                        <option value="3">Prêt personnel</option>
                                        <option value="4">Autre</option>
                                    </select>
                                </div><br>
                                <div class="col-md-12">
                                    <select wire:model="typeWarranty" class="form-select" aria-label="Type d'opération" required>
                                        <option >Type de garantie</option>
                                        <option value="1">Bien immobilier</option>
                                        <option value="2">Autre bien</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <input type="number" class="form-control" wire:model="valueWarranty" placeholder="Valeur du garantie en FCFA" id="interestRate">
                                </div><br>

                                <div class="form-group">
                                    <textarea class="form-control" wire:model="detailsWarranty" placeholder="Details du garantie" style="height: 100px"></textarea>
                                </div><br>

                                <div class="form-group">
                                    <textarea class="form-control" wire:model="purposeWarranty" placeholder="Plan de remboussement" style="height: 100px"></textarea>
                                </div><br>

                                <div class="form-group">
                                    <input type="text" class="form-control" wire:model="nameWarrantor" placeholder="Nom & Prénom du temoins" id="interestRate">
                                </div><br>

                                <div class="form-group">
                                    <input type="number" class="form-control" wire:model="numWarrantor" placeholder="Numéro du temoins" id="interestRate">
                                </div><br>

                                <div class="form-group">
                                    <input type="text" class="form-control" wire:model="addressWarrantor" placeholder="Address du témoins" id="interestRate">
                                </div>

                                <div class="col-md-12">
                                <label for="interestRate"></label>
                                    <select wire:model="relationWarrantor" class="form-select" aria-label="Type d'opération" required>
                                        <option >Relation du temoins</option>
                                        <option value="1">Bien immobilier</option>
                                        <option value="2">Autres biens</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <input type="file" wire:model="docFiles"  class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Enregistrer le Prêt</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>-->
    <div class="container">
    <h3 class="text-center">Formulaire de Prêt</h3>
    <form wire:submit.prevent="saveLoan" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" wire:model="amount" class="form-control" id="amount" placeholder="Montant du Prêt" required>
                </div>
                <div class="form-group">
                    <select wire:model="typeloan" class="form-select" id="typeloan" required>
                        <option value="" disabled>Choisissez le type de prêt</option>
                        <option value="1">Prêt hypothécaire</option>
                        <option value="2">Prêt étudiant</option>
                        <option value="3">Prêt personnel</option>
                        <option value="4">Autre</option>
                    </select>
                </div>
                <div class="form-group">
                    <select wire:model="typeWarranty" class="form-select" id="typeWarranty" required>
                        <option value="" disabled>Type de garantie</option>
                        <option value="1">Bien immobilier</option>
                        <option value="2">Autre bien</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" placeholder="Valeur du garantie" class="form-control" wire:model="valueWarranty" id="valueWarranty" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea class="form-control" placeholder="Details du garantie" wire:model="detailsWarranty" id="detailsWarranty" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Plan de remboursement" wire:model="purposeWarranty" id="purposeWarranty" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nom & Prénom du garrant" wire:model="nameWarrantor" id="nameWarrantor" required>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="Numéro du garrant" wire:model="numWarrantor" id="numWarrantor" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Addresse du garrant" wire:model="addressWarrantor" id="addressWarrantor" required>
                </div>
                <div class="form-group">
                    <select wire:model="relationWarrantor" class="form-select" id="relationWarrantor" required>
                        <option value="" disabled>Relation avec le garrant</option>
                        <option value="Parent">Parent</option>
                        <option value="Amis">Amis</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="docFiles">Documents supplémentaires</label>
            <input type="file" wire:model="docFiles" class="form-control" id="docFiles" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Envoyer la demande</button>
        </div>
    </form>
</div>

  </main><!-- End #main -->