<main id="main" class="main">

    <div class="pagetitle">
      <h1>LISTE DES CLIENTS</h1>

    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">



              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nom et Prenom</th>
                    <th scope="col">email</th>
                    <th scope="col"><button type="submit" class="btn btn-primary">Detail</button></th>

                  </tr>

                </thead>
                <tbody>

                    @foreach ($customerLists as $customerList)
                    <tr>
                        <th scope="row">{{$customerList->id}}</th>
                        <td>{{$customerList->name}}</td>
                        <td>{{$customerList->email}}</td>
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
