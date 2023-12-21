<main id="main" class="main">

    <div class="pagetitle">
        <h1>ENREGISTRER UNE OPERATION </h1>
    <div>

    <br>
  


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


    <div class="card">
        <div class="card-body"><br>
            <!-- Vertically centered Modal -->
            <div style="float: left;">
            
            </div>
            <form wire:submit.prevent="saveOperation" class="php-email-form">
                <div class="row gy-4">

                    <div class="col-md-12">
                        <input type="text" class="form-control" wire:model.live="name" placeholder="Entrez le nom" autocomplete="off" required>
                        <div>
                            @if(!empty($name))
                                <div class="list-group">
                                    @foreach($filteredUsers as $user)
                                        <a href="#" wire:click.prevent="selectUser({{ $user->id }})" class="list-group-item list-group-item-action">
                                            {{ $user->name }} - Tel: {{$user->phone}}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-12">
                        <input id="phone" wire:model="phone"  class="form-control" type="text" placeholder="Numero de telephone" required><br>
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-12">
                        <select id="typeOperation" wire:model="typeOperation" class="form-select" aria-label="Default select example" required>
                            <option selected>Choisissez le type d'opération</option>
                            <option value="1">Dépôt</option>
                            <option value="2">Retrait</option>
                            <option value="3">Virement</option>
                        </select>
                        @error('typeOperation') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-12" id="champsSupplementaires2">
                        <select id="selfAccount" wire:model="selfAccount" class="form-select" aria-label="Default select example" >
                            <option selected>Choisissez le compte</option>
                            @if(!is_null($userAccounts))
                                @foreach($userAccounts as $userAccount)
                                    <option value="{{ $userAccount->id }}">
                                        @if($userAccount->account_types_id == 1)
                                            Compte courant - {{ $userAccount->account_number }}
                                        @elseif($userAccount->account_types_id == 2)
                                            Compte épargne - {{ $userAccount->account_number }}
                                        @endif
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('selfAccount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>


                    <!-- Condition pour afficher ou masquer les champs supplémentaires -->
                    
                    <div class="col-md-12" id="champsSupplementaires">
                        <select id="transactionMethod" wire:model="transactionMethod" class="form-select" aria-label="Default select example" >
                            <option selected>Choisissez le compte</option>
                            @if(!is_null($userAccounts))
                                @foreach($userAccounts as $userAccount)
                                    <option value="{{ $userAccount->id }}">
                                        @if($userAccount->account_types_id == 1)
                                            Compte courant - {{ $userAccount->account_number }}
                                        @elseif($userAccount->account_types_id == 2)
                                            Compte épargne - {{ $userAccount->account_number }}
                                        @endif
                                    </option>
                                @endforeach
                                <option value="cash">Espece</option>
                            @endif
                        </select>
                        @error('selfAccount') <span class="text-danger">{{ $message }}</span> @enderror
                        <br>

                        <div>
                            <input id="compteDestination" wire:model.live="compte_de_destination"  class="form-control" type="text" placeholder="Numéro de compte" ><br>

                            <div>
                            @if(!empty($compte_de_destination) && !is_null($filteredAccounts) && count($filteredAccounts) > 0)
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
                        <input id="beneficiaire" wire:model="beneficiaire"  class="form-control" type="text" placeholder="Bénéficiaire" ><br>
                        @error('beneficiaire') <span class="text-danger">{{ $message }}</span> @enderror
                        <input id="motif" wire:model="motif"  class="form-control" type="text" placeholder="Motif">
                        @error('motif') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    

                    <div class="col-md-12">
                        <input type="number" class="form-control" wire:model="montant" placeholder="Entrer le montant" required>
                        @error('montant') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                
                </div>

                <div class="text-center"><br>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>

            <script>
                const typeOperationSelect = document.getElementById("typeOperation");
                const champsSupplementaires = document.getElementById("champsSupplementaires");
                const champsSupplementaires2 = document.getElementById("champsSupplementaires2");

                champsSupplementaires.style.display = "none"
                    champsSupplementaires2.style.display = "none"

                // Fonction pour afficher ou masquer les champs supplémentaires
                function toggleChampsSupplementaires() {
                    champsSupplementaires.style.display = "none"
                    champsSupplementaires2.style.display = "none"

                    if (typeOperationSelect.value === "3") {
                        champsSupplementaires.style.display = "block";
                    }else if(typeOperationSelect.value === "1") {
                        champsSupplementaires2.style.display = "block";
                    }else if(typeOperationSelect.value === "2"){
                        champsSupplementaires2.style.display = "block";
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