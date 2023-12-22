<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

          
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

          
                <div class="card-body">
                  <h5 class="card-title">Total des prets</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalLoanAmount }} FCFA</h6>
                      <span class="text-success small pt-1 fw-bold">{{$totalLoans}}</span> <span class="text-muted small pt-2 ps-1">prets au total</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

          
                <div class="card-body">
                  <h5 class="card-title">Total des Operation</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalOperationAmount }} FCFA</h6>
                      <span class="text-success small pt-1 fw-bold">{{$totalOperations}}</span> <span class="text-muted small pt-2 ps-1">operation au total</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>


            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

          
                <div class="card-body">
                  <h5 class="card-title">Total des Clients</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalClients }}</h6>
                     
                    </div>
                  </div>
                </div>

              </div>
            </div>


            <div class="col-xxl-6 col-md-8">
              <div class="card info-card sales-card">

          
                <div class="card-body">
                <h5 class="card-title">Statistiques des employés</h5>

                  <div class="d-flex align-items-center">

                    <div class="ps-3">
                      <h5 class="fw-bold">Total Cashiers: {{ $totalCashiers }}</h5 >
                      <h5 class="fw-bold">Total Field Agents: {{ $totalFieldAgents }}</h5 >
                      <h5 class="fw-bold">Total HR Managers: {{ $totalHrManagers }}</h5 >
                      <h5 class="fw-bold">Total Client Managers: {{ $totalClientManagers }}</h5 >
                    </div>
                  </div>

                  
                </div>

              </div>
            </div>

           

        
           
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          
       

       
        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

