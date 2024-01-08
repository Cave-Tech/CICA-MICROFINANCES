<main id="main" class="main">

    <div class="pagetitle">
        <h1>CREATION DE COMPTE EPARGNE </h1>
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

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body"><br>
                    <!-- Vertically centered Modal -->
                    <div style="float: left;">
                    
                    </div>
                    <form wire:submit.prevent="createSavingsAccount" class="php-email-form" enctype="multipart/form-data">
                        <div class="row gy-4">

                            <div class="col-md-12">
                        
                                <select wire:model.live="clientType" class="form-control" required>
                                    <option value="">Choisir le type de client</option>
                                    <option value="pp">Personne Physique</option>
                                    <option value="pm">Personne Morale (Entreprise)</option>
                                </select>
                            </div>

                        

                            <div class="form-group">
                                <input type="text" class="form-control" wire:model.live="name" name="name"
                                    placeholder="{{ $clientType === 'pm' ? 'Entrez le nom de votre entreprise' : 'Entrez le nom' }}" autocomplete="off">
                                <div>
                                    @if(!empty($name))
                                    <div class="list-group">
                                        @foreach($filteredUsers as $user)
                                        <a href="#" wire:click.prevent="selectUser({{ $user->id }})"
                                            class="list-group-item list-group-item-action">
                                            {{ $clientType === 'pm' ? $user->name_company : $user->name }}
                                        </a>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>


                            <div class="col-md-12">
                                <input type="number" class="form-control" wire:model="balance" name="balance" placeholder="Entrer le montant initial deposé" required>
                            </div>

                            
                            <div class="col-md-12">
                                <h5 class="text-danger"><i class="bi bi-exclamation-triangle-fill text-danger"></i> Informations !</h5>
                                <p>
                                    Les pieces doivent etre tous regrouper en un seul document format PDF de moins de 10 Mo.
                                </p>
                                <ul>
                                    <li>Atteststion de residence</li>
                                    <li>Piece d'identite</li>
                                    <li>Photo d'identite</li>
                                </ul>

                                <input type="file" id="accountPieces" class="form-control" wire:model="accountPieces" name="accountPieces" accept="application/pdf" required>
                                @error('accountPieces') <span class="error">{{ $message }}</span> @enderror   
                                
                            </div>

                        </div>

                    
                        <div class="text-center"><br>
                            <button  type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>  
                    </form>
                            
                    
                </div>
            </div>
        </div>

   

</main>