  <main id="main" class="main">

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



    <div class="card">
            <div class="card-body"><br>
              <!-- Vertically centered Modal -->
              <div style="float: left;">
              <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                Faites un depôt ou un retrait
              </button>
              </div>
              <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">REMPLISSEZ LES CHAMPS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

      <form action="forms/contact.php" method="post" class="php-email-form">
        <div class="row gy-4">

          <!--<div class="col-md-6">
            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
          </div>

          <div class="col-md-6 ">
            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
          </div>-->

          <div class="col-md-12">
            <input type="text" class="form-control" name="" placeholder="Entrer le montant" required>
          </div>

                  <!--<label class="col-sm-2 col-form-label">Select</label>-->
                  <div class="col-md-12">
                    <select class="form-select" aria-label="Default select example">
                      <option selected>Choisissez le type d'operation</option>
                      <option value="1">Dépôt</option>
                      <option value="2">Retrait</option>
                    </select>
                  </div>

          <div class="col-md-12">
            <input type="date" class="form-control" name="" placeholder="Subject" required>
          </div>


          <!--<div class="col-md-12">
            <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
          </div> -->
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary">Envoyez la demande</button>
        </div>
        </div>
    </div>
    </div><!-- End Vertically centered Modal-->
    </form>
</div>
</div>

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
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Age</th>
                    <th scope="col">Start Date</th>
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

  </main><!-- End #main -->