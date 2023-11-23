<main id="main" class="main">

    <div class="pagetitle">
      <h1>Liste des employés</h1>

    </div><!-- End Page Title -->

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
                        <th scope="col">Id</th>
                        <th scope="col">Nom et Prenom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Type d'employés</th>

                        <th></th>
                      </tr>
                    </thead>
                        <tbody>
                          @foreach ($employeeLists as $employeeList)
                            <tr>
                                <th scope="row">{{$employeeList->id}}</th>
                                <td>{{$employeeList->name}}</td>
                                <td>{{$employeeList->email}}</td>
                                <td>
                                  @if ($employeeList->employee_type_id == 1)
                                      caissier
                                  @elseif ($employeeList->employee_type_id == 2)
                                      comptable
                                  @elseif ($employeeList->employee_type_id == 3)
                                      agent_terrain
                                  @elseif ($employeeList->employee_type_id == 4)  
                                      directeur
                                  @elseif ($employeeList->employee_type_id == 5)
                                      charger_client
                                  @elseif ($employeeList->employee_type_id == 6)
                                      charger_rh
                                  @else
                                      <span class="badge badge-danger">Aucun type d'employé</span> 
                                  @endif  
                                </td>
                                
                                <td>
                                    <div class="btn-group" role="group">
                                        <a type="button" href="{{ route('employe.detail', ['employeId' => $employeeList->id]) }}" class="btn btn-primary"><i class='bi bi-eye'></i></a>        
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

