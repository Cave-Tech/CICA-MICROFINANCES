<main id="main" class="main">

    <div class="pagetitle">
        <h1>CREATION DE COMPTE COURANTS </h1>
    <div>

    <br>
    <!-- Message de succes ou d'erreur -->
    @if($message = Session::get('success'))
        <div id="success-alert"  class="alertt alert-success">
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
            <form wire:submit.prevent="createCurrentAccount" class="php-email-form" enctype="multipart/form-data">
                <div class="row gy-4">

                    <div class="col-md-12">
                        <input type="text" class="form-control" wire:model.live="name" name="name" placeholder="Entrez le nom" autocomplete="off">
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
                    </div>


                    <div class="col-md-12">
                        <input type="number" class="form-control" wire:model="balance" name="balance" placeholder="Entrer le montant initial deposé" required>
                    </div>

                    <div class="col-md-12">
                        <input type="number" class="form-control" wire:model="ifu" name="ifu" placeholder="Entrer l'IFU" required>
                    </div>

                    <div class="col-md-12">
                        <label for="identityPicture"><h1 style="font-size: 20px; margin-bottom: 10px">Photo d'identité :</h1></label>
                        <input type="file" id="identityPicture" class="form-control" wire:model="identityPicture" name="identityPicture" accept="image/*,application/pdf" required>
                        @error('identityPicture') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="identityPiece"><h1 style="font-size: 20px; margin-bottom: 10px">Piece d'identité :</h1></label>
                        <input type="file" id="identityPiece" class="form-control" wire:model="identityPiece" name="identityPiece" accept="image/*,application/pdf" required>
                        @error('identityPicture') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="proofOfAddress"><h1 style="font-size: 20px; margin-bottom: 10px">Attestation de résidence :</h1></label>
                        <input type="file" id="proofOfAddress" class="form-control" wire:model="proofOfAddress" name="proofOfAddress" accept="image/*,application/pdf" required>
                        @error('proofOfAddress') <span class="error">{{ $message }}</span> @enderror
                    </div>
                
                </div>

               
                <div class="text-center"><br>
                    <button  type="submit" class="btn btn-primary">Enregistrer</button>
                </div>  
            </form>
                       
               
    </div>

</main>