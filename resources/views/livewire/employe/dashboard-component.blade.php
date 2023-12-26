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

          @if (Auth::user()->employee_type_id === 4)
        
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">          
                <div class="card-body">
                  <h5 class="card-title">Total des prets</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cash-stack"></i>
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
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Total des Operation</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalOperationAmount }} FCFA</h6>
                      <span class="text-success small pt-1 fw-bold">{{$totalOperations}}</span> <span class="text-muted small pt-2 ps-1">operation au total</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>
          @endif



            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total des Clients</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalClients }}</h6>
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total des Compte Epargne</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-wallet-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalSavings }}</h6>
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Total des Compte Courant</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-wallet-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalCurrents }}</h6>
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>

          
            @if (Auth::user()->employee_type_id === 4)
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                <h5 class="card-title">Statistiques des employés</h5>
                  <div class="d-flex align-items-center">
                    <div class="ps-3">
                      <p><span class="fw-bold">Total Cashiers:</span> {{ $totalCashiers }}</p >
                      <p><span class="fw-bold">Total Field Agents:</span> {{ $totalFieldAgents }}</p >
                      <p><span class="fw-bold">Total HR Managers:</span> {{ $totalHrManagers }}</p >
                      <p><span class="fw-bold">Total Client Managers:</span> {{ $totalClientManagers }}</p >
                    </div>
                  </div>
                </div>
              </div>
            </div>
            

          <div class="card">
            
            <div class="card-body pb-0">
                <h5 class="card-title">Répartition des Opérations</h5>

                <div id="operationChart" style="min-height: 400px;" class="echart"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        var operationChart = echarts.init(document.querySelector("#operationChart"));

                        operationChart.setOption({
                            tooltip: {
                                trigger: 'item'
                            },
                            legend: {
                                top: '5%',
                                left: 'center'
                            },
                            series: [{
                                name: 'Type d\'opération',
                                type: 'pie',
                                radius: ['40%', '70%'],
                                avoidLabelOverlap: false,
                                label: {
                                    show: false,
                                    position: 'center'
                                },
                                emphasis: {
                                    label: {
                                        show: true,
                                        fontSize: '18',
                                        fontWeight: 'bold'
                                    }
                                },
                                labelLine: {
                                    show: false
                                },
                                data: [
                                    {
                                        value: {{ $totalDeposits }},
                                        name: 'Dépôts'
                                    },
                                    {
                                        value: {{ $totalWithdrawalAmount }},
                                        name: 'Retraits'
                                    },
                                    {
                                        value: {{ $totalVirementAmount }},
                                        name: 'Virements'
                                    }
                                ]
                            }]
                        });
                    });
                </script>
            </div>

          </div>
          @endif

        
           
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          
       

       
        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

