
<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">
                            <!-- Message de succes ou d'erreur -->

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>
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
                  <form class="row g-3 needs-validation" novalidate wire:submit.prevent="register">
                  @csrf
                    <div class="col-12">
                      <label for="yourName" class="form-label">Votre nom</label>
                      <input type="text" wire:model="name" class="form-control" id="yourName" required>
                      <x-input-error :messages="$errors->get('name')" class="mt-2" />
                      <div class="invalid-feedback">Entrer votre nom complet s'il vous plait !</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Votre Email</label>
                      <input type="email" wire:model="email" class="form-control" id="yourEmail" required>
                      <x-input-error :messages="$errors->get('email')" class="mt-2" />
                      <div class="invalid-feedback">Enter une address mail valide !</div>
                    </div>

                    <div class="col-12">
                      <label for="yourOption" class="form-label">Sélectionner une option</label>
                      <!-- Replace the options below with your specific options -->
                      <select class="form-select" wire:model="typeEmploye" id="yourOption" required>
                        <option value="" selected disabled>Select an option</option>
                        <option value="1">Caissier</option>
                        <option value="2">Comptable</option>
                        <option value="3">Agent de terrain</option>
                        <option value="4">Directeur</option>
                        <option value="5">Le charger de la clientele</option>
                        <option value="6">Charger ressource humaine</option>
                      </select>
                      <div class="invalid-feedback">Please select an option!</div>
                    </div>
                    <!--
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Mot de passe </label>
                      <input type="password" wire:model="password" class="form-control" id="yourPassword" required>
                      <x-input-error :messages="$errors->get('password')" class="mt-2" />
                      <div class="invalid-feedback">Veuillez entrer un mot de passe !</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Confirmer mot de passe</label>
                      <input type="password" wire:model="password_confirmation" class="form-control" id="yourPassword" required>
                      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                      <div class="invalid-feedback">Confirmer votre mot de passe s'il vous plait !</div>
                    </div>
                    -->

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" wire:model="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Crée un compte</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Déja un compte ? <a href="{{ url('/login') }}">Se connecter</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                <!--Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>