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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Informations personnelles</button>
                </li>

                @if($customer->type_client == "pm")
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Information d'entreprise</button>
                </li>
                @endif

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#other-profile-overview">Autres Informations</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Pret</button>
                </li>
              </ul>
              <div class="tab-content pt-2">

           
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <div class="pagetitle">
                    <!--<h3>Information sur le client</h3>-->
                  </div>
                  

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Statut</div>
                      <div class="col-lg-9 col-md-8">
                        @if ($customer->status == "blocked")
                            <span class='badge bg-danger'>Bloquer</span>
                        @else($customer->status == "validated")
                            <span class='badge bg-success'>Actif</span>
                        @endif
                      </div>
                      
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
                </div>

                <div class="tab-pane fade show profile-overview"  id="profile-settings">
                    <div class="pagetitle">
                      <!--<h3 class="card-title">Les informations sur l'entreprise</h3>-->
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Nom de l'entreprise:</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->name_company }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Nom de l'entreprise:</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->date_create }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">IFU de l'entreprise:</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->ifu_company }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Adresse de l'entreprise:</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->address_company }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Secteur d'activitée:</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->activity_sector }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Nombre d'employé:</div>
                      @if($customer->number_employed == "15")
                      <div class="col-lg-9 col-md-8">1 à 5</div>
                      @elseif($customer->number_employed == "510")
                      <div class="col-lg-9 col-md-8">5 à 10</div>
                      @elseif($customer->number_employed == "10000")
                      <div class="col-lg-9 col-md-8"> Plus de 10</div>
                      @endif
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Numéro de téléphone:</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->tel_company }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">E-mail de l'entreprise:</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->mail_company }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Capital de l'entreprise:</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->capital }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Revenu annuel de l'entreprise:</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->annual_pension }}</div>
                    </div>
  
                    <div class="row">
                      <div class="col-lg-3 col-md-4 label">Autre détails sur l'entreprise:</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->detail }}</div>
                    </div>
  
                  </div>

                <div class="tab-pane fade show  profile-overview" id="other-profile-overview">
                  <div class="pagetitle">
                    <!--<h1>Autres Informations</h1>-->
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

                 
               

                 
                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Nombre de Personnes à Charge</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->number_of_dependents }}</div>
                  </div>

                  <!-- <div class="row">
                      <div class="col-lg-3 col-md-4 label">Source de Revenu</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->source_of_income }}</div>
                  </div> -->

                  <!-- <div class="row">
                      <div class="col-lg-3 col-md-4 label">Référence</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->referral }}</div>
                  </div> -->

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Client Depuis</div>
                    <div class="col-lg-9 col-md-8">
                        {{ $customer->client_since ? \Carbon\Carbon::parse($customer->client_since)->toDateString() : 'Non Disponible' }}
                    </div>
                  </div> -->


                  <!-- <div class="row">
                      <div class="col-lg-3 col-md-4 label">Détails des Prêts Précédents</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->previous_loan_details }}</div>
                  </div> -->

                  <!-- <div class="row">
                      <div class="col-lg-3 col-md-4 label">Type de Client</div>
                      <div class="col-lg-9 col-md-8">{{ $customer->client_type }}</div>
                  </div>

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Revenu Mensuel Moyen</div>
                      <div class="col-lg-9 col-md-8">{{ number_format($customer->average_monthly_income, 2, ',', ' ') }} €</div>
                  </div> -->

                 
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
                    <!--<h1>Historique des prets</h1>-->
                  </div>

                  <section class="section">
                    <div class="row">
                      <div class="col-lg-12">

                        <div class="card">
                          <div class="card-body">

                            <!-- Table with stripped rows -->
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Type du prêt</th>
                                  <th scope="col">Montant</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Date</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($customer->loan as $loan)
                                  <tr>
                                    <td>
                                        @if ($loan->loan_type_id == 1)
                                            <span class='badge bg-success'>pret automobile</span>
                                        @elseif ($loan->loan_type_id == 2)
                                            <span class='badge bg-warning'>pret immobilier</span>
                                        @endif
                                        
                                    </td>
                                    <td>{{ number_format($loan->loan_amount, 2, ',', ' ') }} FCFA</td>
                                    <td>
                                    @if ($loan->status === 'validated')
                                        <span class="badge bg-success">Valider</span>
                                    @elseif ($loan->status === 'pending')
                                        <span class="badge bg-warning text-dark">En attente</span>
                                    @elseif ($loan->status === 'in progress')
                                        <span class="badge bg-info">En cours</span>
                                    @elseif ($loan->status === 'completed')
                                        <span class="badge bg-success">Solder</span> 
                                    @elseif ($loan->status === 'rejected')
                                        <span class="badge bg-danger">Rejeté</span>
                                    @elseif ($loan->status === 'in payment')
                                        <span class="badge bg-success">En cours de paiement</span>
                                    @endif
                                    </td>
                                    <td>{{ $loan->created_at->toDateString() }}</td>
                                    <td>
                                      <a href="{{ route('client.details-loan', ['loanId' => $loan->id]) }}"><button  class="btn btn-primary"><i class='bi bi-eye'></i></button></a>
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>

              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

</main>
