




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Register - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10 col-md-14 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('register') }}">
                  @csrf
                    <div class="col-12">
                      <label for="yourName" class="card-title">Votre nom et prenom</label>
                      <input type="text" name="name" class="form-control" id="yourName" required>
                      <x-input-error :messages="$errors->get('name')" class="mt-2 alert alert-danger" />
                      <div class="invalid-feedback">Veuillez entrer votre nom et prenom !</div>
                    </div>

                    <div class="col-12">
                      <label for="yourName" class="card-title">Nationalité</label>
                      <div class="form-group">
                            <input type="text" name="nationality" class="form-control" id="yourNationality" required>
                            <x-input-error :messages="$errors->get('nationality')" class="mt-2 alert alert-danger" />
                            <div class="invalid-feedback">Veuillez entrer nationalité !</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourGender" class="card-title">Genre</label>
                      <div class="form-group">
                        <select name="gender" class="form-control" id="yourGender" required>
                              <option value="">Sélectionnez le sexe</option>
                              <option value="male">Homme</option>
                              <option value="female">Femme</option>
                        </select>
                        <x-input-error :messages="$errors->get('gender')" class="mt-2 alert alert-danger" />
                        <div class="invalid-feedback">Veuillez entrer genre !</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourName" class="card-title">Date de naissance</label>
                      <div class="form-group">
                            <input type="date" name="birthdate" class="form-control" id="yourBirthdate" required>
                            <x-input-error :messages="$errors->get('birthdate')" class="mt-2 alert alert-danger" />
                            <div class="invalid-feedback">Veuillez entrer votre date de naissance !</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourName" class="card-title">Type de carte</label>
                      <div class="form-group">
                          <select name="type_card" class="form-control" id="yourGender" required>
                              <option value="">Sélectionnez le type de carte</option>
                              <option value="card">NPI</option>
                              <option value="passport">Passeport</option>
                          </select>
                          <x-input-error :messages="$errors->get('type_card')" class="mt-2 alert alert-danger" />
                          <div class="invalid-feedback">Veuillez choissir le type de carte !</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourName" class="card-title">Numéro de la carte</label>
                      <div class="form-group">
                            <input type="texte" name="number_carte" class="form-control" id="yourBirthdate" required>
                            <x-input-error :messages="$errors->get('number_carte')" class="mt-2 alert alert-danger" />
                            <div class="invalid-feedback">Veuillez entrer le numéro de la carte !</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourName" class="card-title">Localisation</label>
                      <div class="form-group">
                            <input type="texte" name="localisation" class="form-control" id="localisation" required>
                            <x-input-error :messages="$errors->get('localisation')" class="mt-2 alert alert-danger" />
                            <div class="invalid-feedback">Veuillez entrer votre localisation !</div>
                      </div>
                    </div>

                    <div class="col-12">
                    <h5 class="card-title">Nombre de personne en charge</h5>
                        <div class="form-group">
                            <select name="number_of_dependents" class="form-control" id="yourGender" required>
                                <option value="">Sélectionnez le nombre de personne en charge</option>
                                <option value="0">0</option>
                                <option value="15">1-5</option>
                                <option value="510">5-10</option>
                                <option value="10000">10+</option>
                            </select>
                            <x-input-error :messages="$errors->get('number_of_dependents')" class="mt-2 alert alert-danger" />
                            <div class="invalid-feedback">Veuillez entrer le nombre de personne en charge !</div>
                        </div>
                    </div>

                    <div class="col-12">
                    <h5 class="card-title">Profession</h5>
                        <div class="form-group">
                            <input type="texte" name="Profession" class="form-control" id="yourBirthdate" required>
                            <x-input-error :messages="$errors->get('Profession')" class="mt-2 alert alert-danger" />
                            <div class="invalid-feedback">Veuillez entrer votre profession !</div>
                        </div>
                    </div>

                    <div class="col-12">
                    <h5 class="card-title">Phone</h5>
                        <div class="form-group">
                            <input type="number" name="phone" class="form-control" id="phone" required>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2 alert alert-danger" />
                            <div class="invalid-feedback">Veuillez entrer votre numéro de téléphone !</div>
                        </div>
                    </div>

                    <div class="col-12">
                    <h5 class="card-title">Situation matrimoniale</h5>
                        <div class="form-group">
                        <select name="marital_status" class="form-control" id="yourGender" required>
                                <option value="">Situation matrimoniale</option>
                                <option value="single">Célibataire</option>
                                <option value="married">Marié</option>
                                <option value="divorced">Divorcé</option>
                                <option value="widowed">Veuve / Veuf</option>
                            </select>
                            <x-input-error :messages="$errors->get('marital_status')" class="mt-2 alert alert-danger" />
                            <div class="invalid-feedback">Veuillez entrer situation matrimoniale !</div>
                        </div>
                    </div>

                    <div class="col-12">
                    <h5 class="card-title">Adresse de résidence</h5>
                        <div class="form-group">
                            <input type="text" name="adresse" class="form-control" id="yourEmail" required>
                            <x-input-error :messages="$errors->get('adresse')" class="mt-2 alert alert-danger" />
                            <div class="invalid-feedback">Veuillez entrer adresse de résidence !</div>
                        </div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="card-title">Votre Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <x-input-error :messages="$errors->get('email')" class="mt-2 alert alert-danger" />
                      <div class="invalid-feedback">Enter une address mail valide !</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="card-title">Mot de passe </label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <x-input-error :messages="$errors->get('password')" class="mt-2 alert alert-danger" />
                      <div class="invalid-feedback">Veuillez entrer un mot de passe !</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="card-title">Confirmer mot de passe</label>
                      <input type="password" name="password_confirmation" class="form-control" id="yourPassword" required>
                      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 alert alert-danger" />
                      <div class="invalid-feedback">Confirmer votre mot de passe s'il vous plait !</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="true" id="acceptTerms" required>
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
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html> 