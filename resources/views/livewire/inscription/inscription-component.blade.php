
<main id="main" class="main">

    <!--<h1>Détails du Prêt</h1>-->
    <div class="row">
    </div>


    <form class="row g-3 needs-validation" novalidate wire:submit.prevent="register">
        <div class="container">
        <h1>Créer un employé</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
        <li class="breadcrumb-item">Page</li>
        <li class="breadcrumb-item active">Créer un employé</li>
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

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nom et Prénom</h5>
                        <div class="form-group">
                            <input type="text" wire:model="name" class="form-control" id="yourName" required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2 alert alert-danger" />
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
                            <x-input-error :messages="$errors->get('nationality')" class="mt-2 alert alert-danger" />
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
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2 alert alert-danger" />
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
                            <x-input-error :messages="$errors->get('birthdate')" class="mt-2 alert alert-danger" />
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
                            <x-input-error :messages="$errors->get('type_card')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Numéro de la carte</h5>
                        <div class="form-group">
                            <input type="text" wire:model="number_carte" class="form-control" id="yourBirthdate" required>
                            <x-input-error :messages="$errors->get('number_carte')" class="mt-2 alert alert-danger" />
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
                            <x-input-error :messages="$errors->get('number_of_dependents')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Profession</h5>
                        <div class="form-group">
                            <input type="text" wire:model="occupation" class="form-control" id="yourBirthdate" required>
                            <x-input-error :messages="$errors->get('occupation')" class="mt-2 alert alert-danger" />
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
                            <x-input-error :messages="$errors->get('phone')" class="mt-2 alert alert-danger" />
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
                            <x-input-error :messages="$errors->get('marital_status')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Date d'embauche</h5>
                        <div class="form-group">
                            <input type="date" wire:model="hiring_date" class="form-control" id="yourEmail" required>
                            <x-input-error :messages="$errors->get('hiring_date')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Poste occupé</h5>
                        <div class="form-group">
                            <input type="text" wire:model="position" class="form-control" id="yourEmail" required>
                            <x-input-error :messages="$errors->get('position')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Email</h5>
                        <div class="form-group">
                            <input type="email" wire:model="email" class="form-control" id="yourEmail" required>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Niveau d'éducation</h5>
                        <div class="form-group">
                            <input type="text" wire:model="education_level" class="form-control" id="yourEmail" required>
                            <x-input-error :messages="$errors->get('education_level')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Address</h5>
                        <div class="form-group">
                            <input type="text" wire:model="address" class="form-control" id="yourEmail" required>
                            <x-input-error :messages="$errors->get('address')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Department </h5>
                        <div class="form-group">
                            <input type="text" wire:model="department" class="form-control" id="yourEmail" required>
                            <x-input-error :messages="$errors->get('department')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-8">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Localisation</h5>
                        <div class="form-group">
                            <input type="text" wire:model="localisation" class="form-control" id="localisation" required>
                            <x-input-error :messages="$errors->get('localisation')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nom du contact d'urgence</h5>
                        <div class="form-group">
                            <input type="text" wire:model="emergency_contact_name" class="form-control" id="yourEmail" required>
                            <x-input-error :messages="$errors->get('emergency_contact_name')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Relation avec le contact d'urgence</h5>
                        <div class="form-group">
                        <select class="form-select" wire:model="emergency_contact_relation" id="yourOption" required>
                        <option value="">Selectionner le type de relation</option>
                        <option value="Parent">Parent</option>
                        <option value="Tuteur">Tuteur</option>
                        <option value="Amis">Amis</option>
                        <option value="Autre">Autre</option>
                      </select>
                      <x-input-error :messages="$errors->get('emergency_contact_relation')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Numéro de téléphone du contact d'urgence</h5>
                        <div class="form-group">
                            <input type="text" wire:model="emergency_contact_phone" class="form-control" id="yourEmail" required>
                            <x-input-error :messages="$errors->get('emergency_contact_phone')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Type d'employé</h5>
                            <div class="form-group">
                            <select class="form-select" wire:model="employee_type_id" id="yourOption" required>
                            <option value="" >Selectionner le type d'employé</option>
                            <option value="1">Caissier</option>
                            <option value="2">Comptable</option>
                            <option value="3">Charger des prêts</option>
                            <option value="4">Directeur</option>
                            <option value="5">Le charger de la clientele</option>
                            <option value="6">Charger ressource humaine</option>
                          </select>
                          <x-input-error :messages="$errors->get('employee_type_id')" class="mt-2 alert alert-danger" />
                          <div class="invalid-feedback">Please select an option!</div>
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
