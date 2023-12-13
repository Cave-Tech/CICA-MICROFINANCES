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

    

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
</style>
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

<div class="pagetitle">
    <h1>Enregistrement d'une demande de prêt</h1>
    <div><br>
        <div class="card">
            <div class="card-body"><br>
                <!-- Vertically centered Modal -->
                <div style="float: left;">

                </div>
                <form wire:submit.prevent="createLoan" class="php-email-form" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.live="name" name="name"
                            placeholder="Entrez le nom" autocomplete="off">
                        <div>
                            @if(!empty($name))
                            <div class="list-group">
                                @foreach($filteredUsers as $user)
                                <a href="#" wire:click.prevent="selectUser({{ $user->id }})"
                                    class="list-group-item list-group-item-action">
                                    {{ $user->name }}
                                </a>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <input type="number" wire:model="amount" class="form-control" id="loanAmount"
                            placeholder="Montant du Prêt">
                        @error('amount') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-12">
                        <select wire:model="typeloan" class="form-select" aria-label="Type d'opération" required>
                            <option>Choisissez le type de prêt</option>
                            <option value="1">Prêt hypothécaire</option>
                            <option value="2">Prêt étudiant</option>
                        </select>
                        @error('typeloan') <span class="text-danger">{{ $message }}</span>@enderror
                    </div><br>
                    <div class="col-md-12">
                        <select wire:model="typeWarranty" class="form-select" aria-label="Type d'opération" required>
                            <option>Type de garantie</option>
                            <option value="1">Bien immobilier</option>
                            <option value="2">Autre bien</option>
                        </select>
                        @error('typeWarranty') <span class="text-danger">{{ $message }}</span>@enderror
                    </div><br>

                    <div class="form-group">
                        <input type="number" class="form-control" wire:model="valueWarranty"
                            placeholder="Valeur du garantie en FCFA" id="interestRate">
                        @error('valueWarranty') <span class="text-danger">{{ $message }}</span>@enderror
                    </div><br>

                    <div class="form-group">
                        <textarea class="form-control" wire:model="detailsWarranty" placeholder="Details du garantie"
                            style="height: 100px"></textarea>
                        @error('detailsWarranty') <span class="text-danger">{{ $message }}</span>@enderror
                    </div><br>

                    <div class="form-group">
                        <textarea class="form-control" wire:model="purposeWarranty" placeholder="Plan de remboussement"
                            style="height: 100px"></textarea>
                        @error('purposeWarranty') <span class="text-danger">{{ $message }}</span>@enderror
                    </div><br>

                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="nameWarrantor" placeholder="Nom & Prénom du temoins"
                            id="interestRate">
                        @error('nameWarrantor') <span class="text-danger">{{ $message }}</span>@enderror
                    </div><br>

                    <div class="form-group">
                        <input type="number" class="form-control" wire:model="numWarrantor" placeholder="Numéro du temoins"
                            id="interestRate">
                        @error('numWarrantor') <span class="text-danger">{{ $message }}</span>@enderror
                    </div><br>

                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="addressWarrantor" placeholder="Address du témoins"
                            id="interestRate">
                        @error('addressWarrantor') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-md-12">
                        <label for="interestRate"></label>
                        <select wire:model="relationWarrantor" class="form-select" aria-label="Type d'opération"
                            required>
                            <option>Relation du temoins</option>
                            <option value="1">Bien immobilier</option>
                            <option value="2">Autres biens</option>
                        </select>
                        @error('relationWarrantor') <span class="text-danger">{{ $message }}</span>@enderror
                    </div><br>

                    <div class="text-center"><br>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<!-- End #main -->
