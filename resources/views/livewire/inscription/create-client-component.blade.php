

<main id="main" class="main">

    <h1>Créer un client</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
        <li class="breadcrumb-item">Page</li>
        <li class="breadcrumb-item active">Céer un client</li>
        </ol>
    </nav>

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

    <!--<h1>Détails du Prêt</h1>-->
    <div class="row">
    </div>


    <form wire:submit.prevent="createClient">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Nom et Prénom</h5>
                            <div class="form-group">
                            <input type="text" wire:model="name" class="form-control" id="yourName" required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Email</h5>
                            <div class="form-group"> 
                            <input type="email" wire:model="email" class="form-control" id="yourEmail" required>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Mot de passe </h5>
                            <div class="form-group">
                            <input type="password" wire:model="password" class="form-control" id="yourPassword" required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Confirmation de mot de passe </h5>
                            <div class="form-group"> 
                            <input type="password" wire:model="password_confirmation" class="form-control" id="yourPassword" required>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Créer un client</button>
        </div>
    </form>


</main><!-- End #main -->
