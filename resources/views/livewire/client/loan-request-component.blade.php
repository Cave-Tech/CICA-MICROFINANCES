<main id="main" class="main">

<div >
    <div class="container">
        <!-- Bouton pour afficher le modal -->
        <div class="left-align">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loanModal">
                Nouveau Prêt
            </button>
        </div>
        <!-- Modal pour le formulaire de prêt -->
        <div class="modal fade" id="loanModal" tabindex="-1" role="dialog" aria-labelledby="loanModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loanModalLabel">Formulaire de Prêt</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulaire de prêt ici -->
                        <form>
                            <!-- Champs du formulaire (exemples) -->
                            <div class="form-group">
                                <!--<label for="loanAmount">Montant du Prêt</label>-->
                                <input type="text" class="form-control" id="loanAmount" placeholder="Montant du Prêt" name="loanAmount">
                            </div><br>
                            <div class="col-md-12">
                                <select wire:model="typeOperation" class="form-select" aria-label="Type d'opération" required>
                                    <option >Type de garantie</option>
                                    <option value="1">Bien immobilier</option>
                                    <option value="2">Autre bien</option>
                                </select>
                            </div><br>

                            <div class="form-group">
                                <input type="number" class="form-control" placeholder="Valeur du garantie en FCFA" id="interestRate" name="interestRate">
                            </div><br>

                            <div class="form-group">
                                <textarea class="form-control" placeholder="Details du garantie" style="height: 100px"></textarea>
                            </div><br>

                            <div class="form-group">
                                <textarea class="form-control" placeholder="Plan de remboussement" style="height: 100px"></textarea>
                            </div><br>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nom & Prénom du temoins" id="interestRate" name="interestRate">
                            </div><br>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Address du témoins" id="interestRate" name="interestRate">
                            </div>

                            <div class="col-md-12">
                            <label for="interestRate"></label>
                                <select wire:model="" class="form-select" aria-label="Type d'opération" required>
                                    <option >Relation du temoins</option>
                                    <option value="1">Bien immobilier</option>
                                    <option value="2">Autres biens</option>
                                </select>
                            </div><br>

                            <div class="form-group">
                                <!--<label for="interestRate">Doccument supplémentaires</label>-->
                                <input type="file" class="form-control" id="interestRate" name="interestRate">
                            </div>
                            <!-- Ajoutez d'autres champs ici -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary">Enregistrer le Prêt</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  </main><!-- End #main -->