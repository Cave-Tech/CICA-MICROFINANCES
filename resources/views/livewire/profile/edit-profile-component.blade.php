<main id="main" class="main">

<div class="pagetitle">
  <h1>Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Profile</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
        <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile">
            <h2>{{ $profile->name }}</h2>
            <h3><span class="badge bg-success">{{ $profile->occupation }}</span></h3>


                <form wire:submit.prevent="updateProfileImage" enctype="multipart/form-data">

                    <!--<label for="loan_document"></label>
                    <div class="form-group"> 
                        <input type="file" class="form-control"  wire:model="newProfileImage" accept=".JPG, .PNG">
                    </div>-->

                    <div class="input-group-append">
                        <label for="uploadProfileImage" class="btn btn-primary btn-sm mb-0" title="Télécharger une nouvelle image de profil">
                            <i class="bi bi-upload"></i>
                        </label>
                        <input wire:model="newProfileImage" type="file" id="uploadProfileImage"  accept=".JPG, .PNG, .JPEG" class="d-none">

                        <button type="submit" class="btn btn-primary">Changer</button>
                    </div>

                </form>
          
        </div>
      </div>
    </div>
    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Aperçu</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Modifier le profil</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Changer le mot de passe</button>
            </li>

          </ul>
             <!-- Message de succes ou d'erreur -->
                @if($message = Session::get('success'))
                    <div class="alertt">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        {{$message}}
                    </div>
                    @endif
                    
                    @if($message = Session::get('fail'))
                    <div class="alert">
                        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                        {{$message}}
                    </div>
                @endif
            <!--Fin Message de succes ou d'erreur -->
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
            <div class="card border-danger">
                <div class="card-body">
                    <h5 class="card-title text-danger"><i class="bi bi-exclamation-triangle-fill text-danger"></i> Avertissement !</h5>
                    <p class="small ">Merci de fournir des informations correctes et véridiques. La fourniture d'informations frauduleuses ou incorrectes peut entraîner des conséquences légales et lourdes. Assurez-vous de mettre à jour vos données avec précision !</p>
                </div>
            </div>
              <h5 class="card-title">Details profil</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Nom et Prénom :</div>
                <div class="col-lg-9 col-md-8">{{ $profile->name }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Nationalité :</div>
                <div class="col-lg-9 col-md-8">{{ $profile->nationality }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Adresse :</div>
                <div class="col-lg-9 col-md-8">{{ $profile->address }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Téléphone</div>
                <div class="col-lg-9 col-md-8">{{ $profile->phone }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Genre :</div>
                <div class="col-lg-9 col-md-8">
                @if($profile->gender == "male")
                <div>Homme</div>
                @elseif($profile->gender == "female")
                <div>Femme</div>
                @endif 
              </div>
              </div>

              <div class="row">

                <div class="col-lg-3 col-md-4 label">Type de carte :</div>
                <div class="col-lg-9 col-md-8">{{ $profile->id_type === "card" ? "Carte d'identité" : "Passeport" }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Numéro de la carte :</div>
                <div class="col-lg-9 col-md-8">{{ $profile->id_number }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Personne en charge :</div>
                <div class="col-lg-9 col-md-8">{{ $profile->number_of_dependents }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Profession :</div>
                <div class="col-lg-9 col-md-8">{{ $profile->occupation }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">situation matrimoniale :</div>
                <div class="col-lg-9 col-md-8">
                    @if($profile->marital_status == "single")
                    <div>Célibataire</div>
                    @elseif($profile->marital_status == "married")
                    <div>Marié (e)</div>
                    @elseif($profile->marital_status == "divorced")
                    <div>Divorcé (e)</div>
                    @elseif($profile->marital_status == "widowed")
                    <div>Veuf (ve)</div>
                    @endif
                </div>
                </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Date de naissance :</div>
                <div class="col-lg-9 col-md-8">{{ strftime('%d %B %Y', strtotime($profile->birth_date)) }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email :</div>
                <div class="col-lg-9 col-md-8">{{ $profile->email }}</div>
              </div>

            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
              <!-- Profile Edit Form -->
              <form wire:submit.prevent="updateProfile" enctype="multipart/form-data">

                <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nom & Prénom</label>
                    <div class="col-md-8 col-lg-9">
                        <input wire:model="name" type="text" class="form-control" value="{{ $name }}" id="fullName">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 alert alert-danger" />
                    <div class="invalid-feedback">Veuillez votre Nom & Prénom !</div>
                </div>

                <div class="row mb-3">
                    <label for="birthDate" class="col-md-4 col-lg-3 col-form-label">Date de naissance</label>
                    <div class="col-md-8 col-lg-9">
                        <input wire:model="birth_date" type="date" class="form-control" id="birthDate" value="{{ $birth_date }}">
                    </div>
                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2 alert alert-danger" />
                    <div class="invalid-feedback">Veuillez votre date de naissance !</div>
                </div>

                <div class="row mb-3">
                    <label for="nationality" class="col-md-4 col-lg-3 col-form-label">Nationalité</label>
                    <div class="col-md-8 col-lg-9">
                        <input wire:model="nationality" type="text" class="form-control" value="{{ $nationality }}" id="nationality">
                    </div>
                    <x-input-error :messages="$errors->get('nationality')" class="mt-2 alert alert-danger" />
                    <div class="invalid-feedback">Veuillez votre nationalité !</div>
                </div>

                <div class="row mb-3">
                    <label for="gender" class="col-md-4 col-lg-3 col-form-label">Sexe</label>
                    <div class="col-md-8 col-lg-9">
                        <select wire:model="gender" class="form-select" value="{{ $profile->gender }}" id="gender">
                            <option >selectionnez le sexe</option>
                            <option value="male">Homme</option>
                            <option value="female">Femme</option>
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('gender')" class="mt-2 alert alert-danger" />
                    <div class="invalid-feedback">Veuillez choisir le type de sex !</div>
                </div>

                <div class="row mb-3">
                    <label for="gender" class="col-md-4 col-lg-3 col-form-label">Type de carte</label>
                    <div class="col-md-8 col-lg-9">
                        <select wire:model="id_type" class="form-select" value="{{ $profile->id_type }}" id="id_type">
                            <option >selectionnez le type de carte</option>
                            <option value="card">Carte d'identité</option>
                            <option value="passport">Passeport</option>
                        </select>
                    </div>
                    <x-input-error :messages="$errors->get('id_type')" class="mt-2 alert alert-danger" />
                    <div class="invalid-feedback">Veuillez entrer le type de carte !</div>
                </div>

                <div class="row mb-3">
                    <label for="id_number" class="col-md-4 col-lg-3 col-form-label">Numéro de la carte</label>
                    <div class="col-md-8 col-lg-9">
                        <input wire:model="id_number" type="id_number" value="{{ $profile->id_number }}" class="form-control" id="id_number">
                    </div>
                    <x-input-error :messages="$errors->get('id_number')" class="mt-2 alert alert-danger" />
                    <div class="invalid-feedback">Veuillez entrer le numéro de la carte !</div>
                </div>

                <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-lg-3 col-form-label">Nombre de personne en charge</label>
                    <div class="col-md-8 col-lg-9">
                    <select wire:model="number_of_dependents" class="form-control" id="yourGender" required>
                        <option value="">Sélectionnez le nombre de personne en charge</option>
                        <option value="0">0</option>
                        <option value="15">1-5</option>
                        <option value="510">5-10</option>
                        <option value="10000">10+</option>
                    </select>
                   </div>
                    <x-input-error :messages="$errors->get('number_of_dependents')" class="mt-2 alert alert-danger" />
                    <div class="invalid-feedback">Veuillez entrer le nombre de personne en charge !</div>
                </div>

                <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-lg-3 col-form-label">Situation matrimoniale</label>
                    <div class="col-md-8 col-lg-9">
                    <select wire:model="marital_status" class="form-control" id="yourGender" required>
                        <option value="">Situation matrimoniale</option>
                        <option value="single">Célibataire</option>
                        <option value="married">Marié</option>
                        <option value="divorced">Divorcé</option>
                        <option value="widowed">Veuve / Veuf</option>
                    </select>
                    </div>
                    <x-input-error :messages="$errors->get('marital_status')" class="mt-2 alert alert-danger" />
                    <div class="invalid-feedback">Veuillez entrer situation matrimoniale !</div>
                </div>

                <div class="row mb-3">
                    <label for="address" class="col-md-4 col-lg-3 col-form-label">Adresse</label>
                    <div class="col-md-8 col-lg-9">
                        <input wire:model="address" type="text" value="{{ $profile->address }}" class="form-control" id="address">
                    </div>
                    <x-input-error :messages="$errors->get('address')" class="mt-2 alert alert-danger" />
                    <div class="invalid-feedback">Veuillez entrer l'adresse de domicile !</div>
                </div>

                <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-lg-3 col-form-label">Téléphone</label>
                    <div class="col-md-8 col-lg-9">
                        <input wire:model="phone" type="number" value="{{ $profile->phone }}" class="form-control" id="phone">
                    </div>
                    <x-input-error :messages="$errors->get('phone')" class="mt-2 alert alert-danger" />
                    <div class="invalid-feedback">Veuillez entrer le numéro de Téléphone !</div>
                </div>

                <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-lg-3 col-form-label">Profession</label>
                    <div class="col-md-8 col-lg-9">
                    <input type="texte" wire:model="occupation" class="form-control" id="yourBirthdate" required>
                    </div>
                    <x-input-error :messages="$errors->get('occupation')" class="mt-2 alert alert-danger" />
                    <div class="invalid-feedback">Veuillez entrer votre profession !</div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Modifier mes informations</button>
                </div>

            </form>

            <!-- End Profile Edit Form -->

            </div>
            <div class="tab-pane fade pt-3" id="profile-change-password">
              <!-- Change Password Form -->
              <form wire:submit.prevent="changePassword">

                <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mot de passe actuel</label>
                    <div class="col-md-8 col-lg-9">
                        <input wire:model="currentPassword" type="password" class="form-control" id="currentPassword" required>
                    </div>
                    @error('currentPassword') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nouveau mot de passe</label>
                    <div class="col-md-8 col-lg-9">
                        <input wire:model="newPassword" type="password" class="form-control" id="newPassword" required>
                    </div>
                    @error('newPassword') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Entrez à nouveau le nouveau mot de passe</label>
                    <div class="col-md-8 col-lg-9">
                        <input wire:model="renewPassword" type="password" class="form-control" id="renewPassword" required>
                    </div>
                    @error('renewPassword') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Changer votre Mot de passe</button>
                </div>
            </form>
            <!-- End Change Password Form -->

            </div>

          </div><!-- End Bordered Tabs -->

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->