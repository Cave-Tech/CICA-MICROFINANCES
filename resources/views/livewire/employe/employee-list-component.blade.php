<main id="main" class="main">

    <div class="pagetitle">
      <h1>Liste des employés</h1>

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
                    <th scope="col">Id</th>
                    <th scope="col">Nom et Prenom</th>
                    <th scope="col">Email</th>
                  </tr>
                </thead>
                <tbody>
                   @foreach ($employeeLists as $employeeList)
                    <tr>
                        <th scope="row">{{$employeeList->id}}</th>
                        <td>{{$employeeList->name}}</td>
                        <td>{{$employeeList->email}}</td>
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

  </main><!-- End #main -->

