<main id="main" class="main">

    <div class="pagetitle">
      <h1>Profil Client</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2>Kevin Anderson</h2>
              <h3>Web Designer</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
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
                  <h5 class="card-title">Details Pret</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Montant</div>
                    <div class="col-lg-9 col-md-8"></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Statut</div>
                    <div class="col-lg-9 col-md-8"></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Ville </div>
                    <div class="col-lg-9 col-md-8"></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Addresse</div>
                    <div class="col-lg-9 col-md-8"></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Telephone</div>
                    <div class="col-lg-9 col-md-8"></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <!-- forumlaire demande debut -->
                  <div class="pagetitle">
                    <h1>Liste de demande de pret</h1>

                  </div><!-- End Page Title -->

                  <section class="section">
                    <div class="row">
                      <div class="col-lg-12">

                        <div class="card">
                          <div class="card-body">

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                              <thead>
                                <tr>
                                  <th scope="col">Numero</th>
                                  <th scope="col">Nom</th>
                                  <th scope="col">Prenom</th>
                                  <th scope="col">Agent</th>
                                  <th scope="col">Date pret</th>
                                  <th scope="col">Statut pret</th>
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
