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

    .member-card {
        border: 1px solid #007bff; /* Couleur de bordure */
        border-radius: 8px; /* Coins arrondis */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Ombre subtile */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Animation douce */
    }

    .member-card:hover {
        transform: translateY(-5px); /* Légère élévation au survol */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée au survol */
    }

    .member-card .card-body {
        padding: 15px; /* Espacement intérieur */
    }

    .member-card .card-title {
        color: #007bff; /* Couleur du titre */
        font-weight: bold; /* Gras pour le titre */
        margin-bottom: 10px; /* Espacement sous le titre */
    }

    .member-card .card-info {
        font-size: 0.9em; /* Taille de police pour les informations */
        color: #333; /* Couleur de police pour les informations */
        margin-bottom: 5px; /* Espacement entre les lignes d'information */
    }

    .member-card .delete-icon {
        font-size: 1.5em; /* Taille de l'icône de suppression */
        color: #d9534f; /* Couleur de l'icône de suppression */
        cursor: pointer; /* Curseur en forme de main */
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
    <h1>Enregistrement d'une demande de prêt groupé</h1>
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
                        </select>
                        @error('applicantType') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" wire:model.live="name" name="name"
                            placeholder="{{ $applicantType === 'pm' ? 'Entrez le nom de votre entreprise' : 'Entrez le nom' }}" autocomplete="off" required>
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
                        <input type="number" wire:model="amount" class="form-control" id="loanAmount" placeholder="Montant du Prêt" required>
                        @error('amount') <span class="text-danger">{{ $message }}</span>@enderror                     
                    </div>

                    <div class="form-group">
                        <input type="number" wire:model="loanTerm" class="form-control" placeholder="Durée du Prêt (mois)" required>
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

                    <div class="form-group">
                        
                        <textarea class="form-control" wire:model="loanReason" id="loanReason" rows="3" placeholder="Motif du prêt" required></textarea>
                        @error('loanReason') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <button type="button" wire:click="toggleAdditionalForm" class="btn btn-secondary">Ajouter une personne</button>
                    </div>

                    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addMemberModalLabel">Ajouter un Membre</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" class="form-control" wire:model.live="additionalName" placeholder="Recherchez par nom...">
                                    <ul class="list-group mt-2">
                                        @foreach($filteredMembers as $member)
                                        <li class="list-group-item list-group-item-action" wire:click="selectMember({{ $member->id }})">
                                            {{ $member->name }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                    <button type="button" class="btn btn-primary" wire:click="addMember">Enregistrer</button>
                                </div>

                            </div>
                        </div>
                    </div>


                    <!-- Formulaire supplémentaire -->
                   

                    <div id="tarifList" class="row">
                        @foreach($allMembers as $allMember)
                            <div class="col-md-3 col-sm-4 mb-3">
                                <div class="card member-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Membre</h5>
                                        <p class="card-info"><strong>Nom :</strong> {{ $allMember['name'] }}</p>
                                        <p class="card-info"><strong>Adresse :</strong> {{ $allMember['address'] }}</p>
                                        <a wire:click="deleteAllMember({{ $loop->index }})" class="delete-icon">
                                            <i class="bx bx-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <div class="text-center"><br>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.hook('element.updating', (fromEl, toEl, component) => {
                if (toEl.tagName.toLowerCase() === 'div' && toEl.classList.contains('form-group')) {
                    toEl.style.display = component.get('showAdditionalForm') ? 'block' : 'none';
                }
            });
        });
    </script>
    @endpush

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let modalEl = document.getElementById('addMemberModal');
            let modal = new bootstrap.Modal(modalEl);

            window.addEventListener('show-modal', (event) => {
                
                modal.show();
            });

            window.addEventListener('close-modal', () => {
                modal.hide();
            });

            modalEl.addEventListener('hidden.bs.modal', () => {
                // Cette fonction est appelée après que le modal est complètement fermé
                window.livewire.dispatch('resetListener');
            });

        
        });
    </script>

</main>

<!-- End #main -->