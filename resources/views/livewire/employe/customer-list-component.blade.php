



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
              
                    <br>
                    <!-- Before your table, add this search input -->
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Rechercher" wire:model.live="search">
                    </div>
                    
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">id</th>
                            <th scope="col">Nom et Prenom</th>
                            <th scope="col">genre</th>
                            <th scope="col">Nationnalité</th>
                            <th scope="col">Email</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($customerLists as $customer)
                            <tr>
                                <td >{{ $customer->id }}</td>
                                <td >{{ $customer->name }}</td>
                                <td >{{ $customer->gender }}</td>
                                <td >{{ $customer->nationality }}</td>
                                <td >{{ $customer->email }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a type="button" href="{{ route('customer.detail', ['customerId' => $customer->id]) }}" class="btn btn-primary"><i class='bi bi-eye'></i></a>        
                                    </div>
                                </td>  
                                
                              
                            </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                    </div>
                </div>
                

              
              

            </div>
          </div>
        </section>
      </div>
    </div>




    

  </main><!-- End #main -->
