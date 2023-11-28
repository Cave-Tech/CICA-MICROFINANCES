<main id="main" class="main">
    <div class="pagetitle">
      <h1>Profil Employé</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-3">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{ $employe->profile->profile_picture }}" alt="Profile" class="rounded-circle">
            <h2>{{ $employe->name }}</h2>
            <h3>{{ $employe->occupation }}</h3> 
            </div>
          </div>

        </div>

        <div class="col-xl-9">

          <div class="card">
                <div class="card-body pt-3">
                
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#employe-personnals-informations">Informations personnelles</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#employe-position-informations">Information sur le poste</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#employe-formation-informations">Information sur le poste</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#employe-others-informations">Autres informations</button>
                        </li>

                    </ul>

                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-overview" id="employe-personnals-informations">
                            <div class="pagetitle">
                                <h1>Information sur l'employé</h1>
                            </div>
                            

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Statut:</div>
                                <div class="col-lg-9 col-md-8">
                                    @if ($employe->status == "blocked")
                                        <span class='badge bg-danger'>Bloquer</span>
                                    @else($employe->status == "validated")
                                        <span class='badge bg-success'>Actif</span>
                                    @endif
                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nom:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->name }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Adresse Mail:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->email }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Telephone:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->phone }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Adresse:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->address }}</div>
                            </div>

                            
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Genre:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->gender }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Date de Naissance:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->birth_date }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nationalité:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->nationality }}</div>
                            </div>
                        </div>


                        <div class="tab-pane fade profile-overview" id="employe-position-informations">
                            <div class="pagetitle">
                                <h1>Information sur le poste</h1>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Date d'embauche:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->hiring_date }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Poste occupé:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->position }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Département:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->department }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Type de contrat:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->contract_type }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Salaire:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->salary }}</div>
                            </div>
                        </div>

                        <div class="tab-pane fade profile-overview" id="employe-formation-informations">
                            <div class="pagetitle">
                            <h1>Formations</h1>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Niveau d'éducation:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->education_level }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Formations spécifiques suivies:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->specific_training }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Certifications obtenues:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->certifications }}</div>
                            </div>


                        </div>

                        <div class="tab-pane fade profile-overview" id="employe-others-informations">
                            <div class="pagetitle">
                            <h1>Autres informations</h1>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Numéro de sécurité sociale:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->social_security_number }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nom de la banque:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->bank_name }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Numéro de compte bancaire:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->bank_account_number }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Nom du contact d'urgence:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->emergency_contact_name }}</div>
                            </div>


                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Relation avec le contact d'urgence:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->emergency_contact_relation }}</div>
                            </div>


                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Numéro de téléphone du contact d'urgence:</div>
                                <div class="col-lg-9 col-md-8">{{ $employe->emergency_contact_phone }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                
            </div>
          </div>

        </div>
      </div>
    </section>

</main><!-- End #main -->
