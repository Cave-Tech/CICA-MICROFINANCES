<main id="main" class="main">
    <div class="pagetitle">
      <h1>Profil Client</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-3">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="{{ $customer->profile->profile_picture }}" alt="Profile" class="rounded-circle">
            <h2>{{ $customer->name }}</h2>
            <h3>{{ $customer->occupation }}</h3> 
            </div>
          </div>

        </div>

        <div class="col-xl-9">

          <div class="card">
            <div class="card-body pt-3">
              
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Client</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Pret</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Opérations</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

           
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <div class="pagetitle">
                    <h1>Information sur le client</h1>
                  </div>
                  

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Statut</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->status }}</div>
                  </div>

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Nom</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->name }}</div>
                  </div>

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Adresse Mail</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->email }}</div>
                  </div>

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Telephone</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->phone }}</div>
                  </div>

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Adresse</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->address }}</div>
                  </div>

                  
                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Genre</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->gender }}</div>
                  </div>

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Date de Naissance</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->birth_date }}</div>
                  </div>

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Nationalité</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->nationality }}</div>
                  </div>

                  
                  @if($customer->employee_type_id)
                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Type d'Employé</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->employeeType->name }}</div>
                  </div>
               
                  @endif

               
                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Statut Marital</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->marital_status }}</div>
                  </div>

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Occupation</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->occupation }}</div>
                  </div>

                  
                  <!-- <div class="row">
                      <div class="col-lg-3 col-md-4 label">Informations Financières</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->financial_information }}</div>
                  </div> -->

                 
                  @if($customer->emergency_contact_name)
                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Contact d'Urgence</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->emergency_contact_name }} ({{ $customer->emergency_contact_relation }}) - {{ $customer->emergency_contact_phone }}</div>
                  </div>
                  @endif

                 
                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Nombre de Personnes à Charge</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->number_of_dependents }}</div>
                  </div>

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Source de Revenu</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->source_of_income }}</div>
                  </div>

                  <!-- <div class="row">
                      <div class="col-lg-3 col-md-4 label">Référence</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->referral }}</div>
                  </div> -->

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Client Depuis</div>
                    <div class="col-lg-9 col-md-8">
                        {{ $customer->client_since ? \Carbon\Carbon::parse($customer->client_since)->toDateString() : 'Non Disponible' }}
                    </div>
                </div>


                  <!-- <div class="row">
                      <div class="col-lg-3 col-md-4 label">Détails des Prêts Précédents</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->previous_loan_details }}</div>
                  </div> -->

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Type de Client</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->client_type }}</div>
                  </div>

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Revenu Mensuel Moyen</div>
                      <div class="col-lg-9 col-md-8">{{ number_format($customer->average_monthly_income, 2, ',', ' ') }} €</div>
                  </div>

                 
                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Type de Pièce d'Identité</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->id_type }}</div>
                  </div>

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Numéro de Pièce d'Identité</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->id_number }}</div>
                  </div>

                
                  <!-- <div class="row">
                      <div class="col-lg-3 col-md-4 label">Photo de Profil</div>
                      <div class="col-lg-9 col-md-8">
                          <img src="{{ asset('storage/profile_pictures/' . $customer->profile_picture) }}" alt="Photo de Profil" style="width: 100px; height: 100px;">
                      </div>
                  </div> -->

                  


                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                 
                  <div class="pagetitle">
                    <h1>Historique des prets</h1>
                  </div>

                  <section class="section">
                    <div class="row">
                      <div class="col-lg-12">

                        <div class="card">
                          <div class="card-body">

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                              <thead>
                                <tr>
                                  <th scope="col">Id</th>
                                  <th scope="col">Type de pret</th>
                                  <th scope="col">Montant</th>
                                  <th scope="col">Agent</th> 
                                  <th scope="col">Statut pret</th>
                                  <th scope="col">Date pret</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th scope="row">1</th>
                                  <td>Brandon Jacob</td>
                                  <td>Designer</td>
                                  <td>28</td>
                                  <td>2016-05-25</td>
                                  <td>2016-05-25</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>Bridie Kessler</td>
                                  <td>Developer</td>
                                  <td>35</td>
                                  <td>2014-12-05</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td>Ashleigh Langosh</td>
                                  <td>Finance</td>
                                  <td>45</td>
                                  <td>2011-08-12</td>
                                </tr>
                                <tr>
                                  <th scope="row">4</th>
                                  <td>Angus Grady</td>
                                  <td>HR</td>
                                  <td>34</td>
                                  <td>2012-06-11</td>
                                </tr>
                                <tr>
                                  <th scope="row">5</th>
                                  <td>Raheem Lehner</td>
                                  <td>Dynamic Division Officer</td>
                                  <td>47</td>
                                  <td>2011-04-19</td>
                                </tr>
                              </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <!-- formulaire operations debut -->
                  <form>

                    <div class="pagetitle">
                        <h1>GESTION DES OPERATIONS </h1>
                      <!--<nav>
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item">Pages</li>
                            <li class="breadcrumb-item active">Contact</li>
                          </ol>
                        </nav>-->
                      </div><!-- End Page Title -->
                      <!-- End Page Title -->



                  <section class="section">
                        <div class="row">
                          <div class="col-lg-12">

                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">Mes opérations</h5>
                                <!--<p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>-->

                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                  <thead>
                                    <tr>
                                      <th scope="col">Numéro</th>
                                      <th scope="col">Type opération</th>
                                      <th scope="col">Méthode transaction</th>
                                      <th scope="col">Montant opération</th>
                                      <th scope="col">Date opération</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th scope="row">1</th>
                                      <td>Brandon Jacob</td>
                                      <td>Designer</td>
                                      <td>28</td>
                                      <td>2016-05-25</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">2</th>
                                      <td>Bridie Kessler</td>
                                      <td>Developer</td>
                                      <td>35</td>
                                      <td>2014-12-05</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">3</th>
                                      <td>Ashleigh Langosh</td>
                                      <td>Finance</td>
                                      <td>45</td>
                                      <td>2011-08-12</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">4</th>
                                      <td>Angus Grady</td>
                                      <td>HR</td>
                                      <td>34</td>
                                      <td>2012-06-11</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">5</th>
                                      <td>Raheem Lehner</td>
                                      <td>Dynamic Division Officer</td>
                                      <td>47</td>
                                      <td>2011-04-19</td>
                                    </tr>
                                  </tbody>
                                </table>
                                <!-- End Table with stripped rows -->

                              </div>
                            </div>

                          </div>
                        </div>
                      </section>
                  </form><!-- End settings Form --> <!--  Form operation fin -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">

                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

</main><!-- End #main -->
