

<main id="main" class="main">

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
        <h1>Créer un client</h1>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
        <li class="breadcrumb-item">Page</li>
        <li class="breadcrumb-item active">Céer un client</li>
        </ol>
    </nav>
        <div class="row mt-8">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Type de client</h5>
                        <div class="form-group">
                            <select id="type_client" wire:model="type_client" class="form-control" id="yourGender" required>
                                <option value="">Sélectionnez le type de client</option>
                                <option value="pp">Personne physique</option>
                                <option value="pm">Personne morale</option>
                            </select>
                            <x-input-error :messages="$errors->get('type_client')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <span id="champsSupplementaires" style="display: none;"> 
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nom de l'entreprise</h5>
                        <div class="form-group">
                            <input type="text" wire:model="name_company" class="form-control" id="name_company" >
                            <x-input-error :messages="$errors->get('name_company')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Date de création de l'entreprise</h5>
                        <div class="form-group">
                            <input type="date" wire:model="date_create" class="form-control" id="date_create">
                            <x-input-error :messages="$errors->get('date_create')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Adresse de l'entreprise </h5>
                        <div class="form-group">
                            <input type="text" wire:model="address_company" class="form-control" id="address_company" >
                            <x-input-error :messages="$errors->get('address_company')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Secteur d'activité de l'entreprise</h5>
                        <div class="form-group">
                            <input type="text" wire:model="activity_sector" class="form-control" id="activity_sector" >
                            <x-input-error :messages="$errors->get('activity_sector')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Numéro de téléphone de l'entreprise</h5>
                        <div class="form-group">
                            <input type="text" wire:model="tel_company" class="form-control" id="tel_company" >
                            <x-input-error :messages="$errors->get('tel_company')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Adresse mail de l'entreprise</h5>
                        <div class="form-group">
                            <input type="email" wire:model="mail_company" class="form-control" id="mail_company" >
                            <x-input-error :messages="$errors->get('mail_company')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Capitale de l'entreprise</h5>
                        <div class="form-group">
                            <input type="number" wire:model="capital" class="form-control" id="capital" >
                            <x-input-error :messages="$errors->get('capital')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Revenu annuel de l'entreprise</h5>
                        <div class="form-group">
                            <input type="number" wire:model="annual_pension" class="form-control" id="annual_pension" >
                            <x-input-error :messages="$errors->get('annual_pension')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">IFU de l'entreprise</h5>
                        <div class="form-group">
                            <input type="text" wire:model="ifu_company" class="form-control" id="ifu_company">
                            <x-input-error :messages="$errors->get('ifu_company')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nombre d'employé dans l'entreprise</h5>
                        <div class="form-group">
                            <select wire:model="number_employed" class="form-control" id="number_employed">
                                <option value="">Sélectionnez d'employé</option>
                                <option value="0">0</option>
                                <option value="15">1-5</option>
                                <option value="510">5-10</option>
                                <option value="10000">10+</option>
                            </select>
                            <x-input-error :messages="$errors->get('number_employed')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-8">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Autre détails sur l'entreprise</h5>
                        <div class="form-group">
                            <textarea wire:model="detail" id="detail" cols="30" rows="10" class="form-control" ></textarea>
                            <x-input-error :messages="$errors->get('detail')" class="mt-2 alert alert-danger" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </span>
        

        <!-- Code pour afficher les champs supplémentaires quant on selectionne Virement -->
        <script>
            const typeOperationSelect = document.getElementById("type_client");
            const champsSupplementaires = document.getElementById("champsSupplementaires");

            typeOperationSelect.addEventListener("change", function () {
                if (typeOperationSelect.value === "pm") {
                    champsSupplementaires.style.display = "block";
                } else {
                    champsSupplementaires.style.display = "none";
                }
            });
        </script>


    <h1 class="card-title">Informations Personnelles</h1>
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
                            <input type="text" wire:model="number_carte" class="form-control" id="number_carte" required>
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
                            <input type="text" wire:model="Profession" class="form-control" id="yourBirthdate" required>
                            <x-input-error :messages="$errors->get('Profession')" class="mt-2 alert alert-danger" />
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
                        <h5 class="card-title">Adresse</h5>
                        <div class="form-group">
                            <input type="text" wire:model="adresse" class="form-control" id="yourEmail" required>
                            <x-input-error :messages="$errors->get('adresse')" class="mt-2 alert alert-danger" />
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
                            <x-input-error :messages="$errors->get('email')" class="mt-2 alert alert-danger" />
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
                            <x-input-error :messages="$errors->get('password')" class="mt-2 alert alert-danger" />
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
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 alert alert-danger" />
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
