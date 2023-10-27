<main id="main" class="main">

<div class="pagetitle">
  <h1>GESTION DES OPERATIONS </h1>
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
              <h5 class="card-title">Mes opérations</h5>
              
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#Code unique</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Type d'opération</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($operations as $operation)
                    <tr>
                      <th scope="row">{{ $operation->transaction_key }}</th>

                      <td>{{ $operation->withdrawal_amount }}</td>
                      <td>{{ $operation->operationType->designation }}</td>

                      <td>
                        @if ($operation->status == "completed")
                            <span class='badge bg-success'>Terminé</span>
                        @elseif ($operation->status == "pending")
                            <span class='badge bg-warning'>En cours</span>
                        @else
                            <span class='badge bg-danger'>En instance</span>
                        @endif
                        
                      </td>

                      <td>{{ strftime('%d %B %Y', strtotime($operation->withdrawal_date)) }}</td>

                      <td>
                        <div class="btn-group" role="group">
                            <button wire:click="showEdit({{ $operation->id }})" data-bs-toggle="modal" data-bs-target="#operationModal" class="btn btn-primary"><i class='bi bi-eye'></i></button>        
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




</main>