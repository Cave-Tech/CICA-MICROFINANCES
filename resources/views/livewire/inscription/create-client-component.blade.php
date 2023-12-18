

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
                        <h5 class="card-title">Nationalité</h5>
                        <div class="form-group">
                            <input type="text" wire:model="nationality" class="form-control" id="yourNationality" required>
                            <x-input-error :messages="$errors->get('nationality')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sexe</h5>
                        <div class="form-group">
                            <select wire:model="gender" class="form-control" id="yourGender" required>
                                <option value="">Sélectionnez le sexe</option>
                                <option value="male">Homme</option>
                                <option value="female">Femme</option>
                                <option value="other">Autre</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Date de Naissance</h5>
                        <div class="form-group">
                            <input type="date" wire:model="birthdate" class="form-control" id="yourBirthdate" required>
                            <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Type de carte</h5>
                        <div class="form-group">
                            <select wire:model="type_card" class="form-control" id="yourGender" required>
                                <option value="">Sélectionnez le type de carte</option>
                                <option value="card">NPI</option>
                                <option value="passport">Passeport</option>
                            </select>
                            <x-input-error :messages="$errors->get('type_card')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Numéro de la carte</h5>
                        <div class="form-group">
                            <input type="texte" wire:model="number_carte" class="form-control" id="yourBirthdate" required>
                            <x-input-error :messages="$errors->get('number_carte')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nombre de personne en charge</h5>
                        <div class="form-group">
                            <select wire:model="number_of_dependents" class="form-control" id="yourGender" required>
                                <option value="">Sélectionnez le nombre de personne en charge</option>
                                <option value="0">0</option>
                                <option value="15">1-5</option>
                                <option value="510">5-10</option>
                                <option value="10000">10+</option>
                            </select>
                            <x-input-error :messages="$errors->get('number_of_dependents')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Profession</h5>
                        <div class="form-group">
                            <input type="texte" wire:model="Profession" class="form-control" id="yourBirthdate" required>
                            <x-input-error :messages="$errors->get('Profession')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Phone</h5>
                        <div class="form-group">
                            <input type="number" wire:model="phone" class="form-control" id="phone" required>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Situation matrimoniale</h5>
                        <div class="form-group">
                        <select wire:model="marital_status" class="form-control" id="yourGender" required>
                                <option value="">Situation matrimoniale</option>
                                <option value="single">Célibataire</option>
                                <option value="married">Marié</option>
                                <option value="divorced">Divorcé</option>
                                <option value="widowed">Veuve / Veuf</option>
                            </select>
                            <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Adresse</h5>
                        <div class="form-group">
                            <input type="text" wire:model="adresse" class="form-control" id="yourEmail" required>
                            <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
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

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mot de passe</h5>
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
                        <h5 class="card-title">Confirmation de mot de passe</h5>
                        <div class="form-group">
                            <input type="password" wire:model="password_confirmation" class="form-control" id="yourPassword" required>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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
