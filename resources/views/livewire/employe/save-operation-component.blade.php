<main id="main" class="main">

    <div class="pagetitle">
        <h1>ENREGISTRER UNE OPERATION </h1>
    <div>

    <br>
  


    @if($message = Session::get('success'))
        <div id="success-alert" class="alert alert-success">
            <p>{{$message}}</p>
        </div>
    @endif

    @if($message = Session::get('fail'))
        <div id="fail-alert" class="alert alert-danger">
            <p>{{$message}}</p>
        </div>
    @endif


    <div class="card">
        <div class="card-body"><br>
            <!-- Vertically centered Modal -->
            <div style="float: left;">
            
            </div>
            <form wire:submit.prevent="saveOperation" class="php-email-form">
                <div class="row gy-4">

                    <div class="col-md-12">
                        <input type="text" class="form-control" wire:model.live="name" placeholder="Entrez le nom" autocomplete="off">
                        <div>
                            @if(!empty($name))
                                <div class="list-group">
                                    @foreach($filteredUsers as $user)
                                        <a href="#" wire:click.prevent="selectUser({{ $user->id }})" class="list-group-item list-group-item-action">
                                            {{ $user->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-12">
                        
                        <select id="typeOperation" wire:model="typeOperation" class="form-select" aria-label="Default select example">
                            <option selected>Choisissez le type d'opération</option>
                            <option value="1">Dépôt</option>
                            <option value="2">Retrait</option>
                            <option value="3">Virement</option>
                        </select>
                        @error('typeOperation') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Condition pour afficher ou masquer les champs supplémentaires -->
                    
                    <div class="col-md-12" id="champsSupplementaires">
                        <div>
                            <input id="compteDestination" wire:model.live="compte_de_destination"  class="form-control" type="text" placeholder="Numéro de compte"><br>

                            <div>
                                @if(!empty($compte_de_destination) && count($filteredAccounts) > 0)
                                    <div class="list-group">
                                        @foreach($filteredAccounts as $account)
                                            <a href="#" wire:click.prevent="selectAccount('{{ $account->account_number }}')" class="list-group-item list-group-item-action">
                                                {{ $account->account_number }} - {{ $account->user->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            @error('compte_de_destination') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <input id="beneficiaire" wire:model="beneficiaire"  class="form-control" type="text" placeholder="Bénéficiaire"><br>
                        @error('beneficiaire') <span class="text-danger">{{ $message }}</span> @enderror
                        <input id="motif" wire:model="motif"  class="form-control" type="text" placeholder="Motif">
                        @error('motif') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    

                    <div class="col-md-12">
                        <input type="number" class="form-control" wire:model="montant" placeholder="Entrer le montant" required>
                        @error('montant') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-12">
                        <input type="date" wire:model="date" class="form-control" required>
                        @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                
                </div>

                <div class="text-center"><br>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>

            <script>
                const typeOperationSelect = document.getElementById("typeOperation");
                const champsSupplementaires = document.getElementById("champsSupplementaires");

                // Fonction pour afficher ou masquer les champs supplémentaires
                function toggleChampsSupplementaires() {
                    if (typeOperationSelect.value === "3") {
                        champsSupplementaires.style.display = "block";
                    } else {
                        champsSupplementaires.style.display = "none";
                    }
                }

                // Ajout d'un écouteur d'événements pour le changement de la sélection
                typeOperationSelect.addEventListener("change", toggleChampsSupplementaires);

                // Appel initial pour s'assurer que les champs sont configurés correctement au chargement de la page
                toggleChampsSupplementaires();
            </script>
                       
               
    </div>

</main><!-- End #main -->