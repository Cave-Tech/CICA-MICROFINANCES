



  <main id="main" class="main">

    <div class="pagetitle">
      <h1>LISTE DES CLIENTS </h1>
    </div><!-- End Page Title -->


    @if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{$message}}</p>
    </div>
    @endif

    @if($message = Session::get('fail'))
    <div class="alert alert-danger">
        <p>{{$message}}</p>
    </div>
    @endif



    <div class="card">
      <div class="card-body"><br>
        <section class="section">
          <div class="row">
            <div class="col-lg-12">

              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Liste des clients</h5>
                  <!--<p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>-->

                  <!-- Table with stripped rows -->
                  <table class="table datatable">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Nom et Prenom</th>
                        <th scope="col">genre</th>
                        <th scope="col">Nationnalité</th>
                        <th scope="col">Email</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($customerLists as $customerList)
                        <tr>
                            <th >{{ $customerList->id }}</th>
                            <th >{{ $customerList->name }}</th>
                            <th >{{ $customerList->gender }}</th>
                            <th >{{ $customerList->nationality }}</th>
                            <th >{{ $customerList->email }}</th>
                            <th>
                                <a href="{{ route('customer.detail', $customerList->id) }}" class="btn btn-info">Détail</a>
                            </th>

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
