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
                    
                    <!-- Informations sur le prêt -->
                    <div class="form-group">
                        <h3>Informations sur le prêt</h3>
                    </div>

                    <div class="form-group">
                       
                        <select class="form-select" wire:model.live="applicantType" required>
                            <option value="">Sélectionnez le type de demandeur</option>
                            <option value="pp">Personne Physique</option>
                            <option value="pm">Entreprise (Personne Morale)</option>
                        </select>
                        @error('applicantType') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>


                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.live="name" name="name"
                            placeholder="{{ $applicantType === 'pm' ? 'Entrez le nom de votre entreprise' : 'Entrez le nom' }}" autocomplete="off">
                        <div>
                            @if(!empty($name))
                            <div class="list-group">
                                @foreach($filteredUsers as $user)
                                <a href="#" wire:click.prevent="selectUser({{ $user->id }})"
                                    class="list-group-item list-group-item-action">
                                    {{ $applicantType === 'pm' ? $user->name_company : $user->name }}
                                </a>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    


                    <div class="form-group">
                        <input type="number" wire:model="amount" class="form-control" id="loanAmount" placeholder="Montant du Prêt">
                        @error('amount') <span class="text-danger">{{ $message }}</span>@enderror                     
                    </div>

                    <div class="form-group">
                        <input type="number" wire:model="loanTerm" class="form-control" placeholder="Durée du Prêt (mois)">
                        @error('loanTerm') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                       
                        <select class="form-select" wire:model="repaymentInterval" id="repaymentInterval" required>
                            <option value="">Sélectionnez la fréquence de paiement</option>
                            <option value="daily">Journalière</option>
                            <option value="weekly">Hebdomadaire</option>
                            <option value="monthly">Mensuelle</option>
                        </select>
                        @error('repaymentInterval') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>


                    <div class="col-md-12">
                        <select wire:model="typeloan" class="form-select" aria-label="Type d'opération" required>
                            <option>Choisissez le type de prêt</option>
                            <option value="1">Prêt long terme</option>
                            <option value="2">Prêt court terme</option>
                        </select>
                        @error('typeloan') <span class="text-danger">{{ $message }}</span>@enderror
                    </div><br>

                    <div class="form-group">
                        
                        <textarea class="form-control" wire:model="loanReason" id="loanReason" rows="3" placeholder="Motif du prêt" required></textarea>
                        @error('loanReason') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>


                    <!-- Informations sur la garantie -->
                    <div class="form-group">
                        <h3>Informations sur la garantie</h3>
                    </div>

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
                        <textarea class="form-control" wire:model="detailsWarranty" placeholder="Details sur la garantie"
                            style="height: 100px"></textarea>
                        @error('detailsWarranty') <span class="text-danger">{{ $message }}</span>@enderror
                    </div><br>

                   

                    <!-- Informations sur le témoin -->
                    <div class="form-group">
                        <h3>Informations sur le témoin</h3>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="nameWarrantor" placeholder="Nom & Prénom du témoin"
                            id="interestRate">
                        @error('nameWarrantor') <span class="text-danger">{{ $message }}</span>@enderror
                    </div><br>

                    <div class="form-group">
                        <input type="number" class="form-control" wire:model="numWarrantor" placeholder="Numéro du témoin"
                            id="interestRate">
                        @error('numWarrantor') <span class="text-danger">{{ $message }}</span>@enderror
                    </div><br>

                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="addressWarrantor" placeholder="Adresse du témoin"
                            id="interestRate">
                        @error('addressWarrantor') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-md-12">
                        <label for="interestRate"></label>
                        <select wire:model="relationWarrantor" class="form-select" aria-label="Type d'opération"
                            required>
                                <option>Relation du témoin</option>
                                <option value="1">Parents</option>
                                <option value="2">Amis</option>
                                <option value="3">Autres</option>
                        </select>
                        @error('relationWarrantor') <span class="text-danger">{{ $message }}</span>@enderror
                    </div><br>

                    <!-- Informations sur le témoin -->
                    <div class="form-group">
                        <h3>Agent de terrain chargé du client</h3>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.live.debounce.500ms="agentTerrain" name="agentTerrain"
                            placeholder="Rechercher un agent" autocomplete="off">
                            <div>
                                @if(!empty($agentTerrain) && !$agentSelected)
                                    <div class="list-group">
                                        @foreach($filteredAgents as $agent)
                                            <a href="#" wire:click.prevent="selectAgent({{ $agent->id }})"
                                            class="list-group-item list-group-item-action">
                                                {{ $agent->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @error('agentTerrain') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>



                    <div class="text-center"><br>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<!-- End #main -->
