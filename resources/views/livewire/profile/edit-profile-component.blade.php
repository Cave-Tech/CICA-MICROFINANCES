<main id="main" class="main">

<div class="pagetitle">
  <h1>Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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

            <!--<button class="btn btn-primary" onclick="document.getElementById('photo').click();">Modifier</button>
            <input type="file" id="photo" style="display: none;" wire:model="newProfileImage">-->
          <div class="social-links mt-2">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
        <!--<script>
        window.livewire.on('photoUpdated', () => {
            // Recharger le composant pour afficher la nouvelle photo
            window.livewire.dispatch('load');
        });
        </script>-->
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
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Paramètres</button>
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
              <h5 class="card-title">Info !</h5>
              <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. 
                Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. 
                Fuga sequi sed ea saepe at unde.</p>
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
                <div class="col-lg-9 col-md-8">{{ $profile->gender }}</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Date de naissance :</div>
                <div class="col-lg-9 col-md-8">{{ \Carbon\Carbon::parse($profile->birth_date)->format('d F Y') }}</div>
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
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="row mb-3">
                    <label for="birthDate" class="col-md-4 col-lg-3 col-form-label">Date de naissance</label>
                    <div class="col-md-8 col-lg-9">
                        <input wire:model="birth_date" type="date" class="form-control" id="birthDate" value="{{ $birth_date }}">
                    </div>
                    @error('birthDate') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="row mb-3">
                    <label for="nationality" class="col-md-4 col-lg-3 col-form-label">Nationalité</label>
                    <div class="col-md-8 col-lg-9">
                        <input wire:model="nationality" type="text" class="form-control" value="{{ $nationality }}" id="nationality">
                    </div>
                    @error('nationality') <span class="text-danger">{{ $message }}</span> @enderror
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
                    @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="row mb-3">
                    <label for="address" class="col-md-4 col-lg-3 col-form-label">Adresse</label>
                    <div class="col-md-8 col-lg-9">
                        <input wire:model="address" type="text" value="{{ $profile->address }}" class="form-control" id="address">
                    </div>
                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-lg-3 col-form-label">Téléphone</label>
                    <div class="col-md-8 col-lg-9">
                        <input wire:model="phone" type="number" value="{{ $profile->phone }}" class="form-control" id="phone">
                    </div>
                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Modifier mes informations</button>
                </div>

            </form>

            <!-- End Profile Edit Form -->

            </div>

            <div class="tab-pane fade pt-3" id="profile-settings">
            <!-- livewire/edit-profile-component.blade.php -->

              <!-- Settings Form -->
              <form>

                <div class="row mb-3">
                  <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                  <div class="col-md-8 col-lg-9">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="changesMade" checked>
                      <label class="form-check-label" for="changesMade">
                        Mot de passe actuel
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="newProducts" checked>
                      <label class="form-check-label" for="newProducts">
                        Information on new products and services
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="proOffers">
                      <label class="form-check-label" for="proOffers">
                        Marketing and promo offers
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                      <label class="form-check-label" for="securityNotify">
                        Security alerts
                      </label>
                    </div>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
              <!-- End settings Form -->
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