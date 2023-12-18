<main id="main" class="main">

<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Acceuil</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-8">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Transactions <span>| Total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-arrow-repeat"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $user->operation->count() }}</h6>         
                  <span class="text-success small pt-1 fw-bold">Transactions</span> <span class="text-muted small pt-2 ps-1"></span>
                </div>
              </div>
            </div>
          </div>
        </div><!-- End Sales Card -->

         @foreach ($user->account as $account)
        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">
            <div class="card-body">
            @if ($account->account_types_id === 1)
              <h5 class="card-title">Compte <span>| Epagne</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-wallet-fill"></i>
                </div>
                <div class="ps-3">
                <h6>{{ $account->balance }}</h6>
                  <span class="text-success small pt-1 fw-bold">Solde</span> <span class="text-muted small pt-2 ps-1"></span>
                </div>
              </div>
            @endif
            @if ($account->account_types_id === 2)
              <h5 class="card-title">Compte <span>| Courant</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-wallet-fill"></i>
                </div>
                <div class="ps-3">
                <h6>{{ $account->balance }}</h6>
                  <span class="text-success small pt-1 fw-bold">Solde</span> <span class="text-muted small pt-2 ps-1"></span>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div><!-- End Revenue Card -->
        @endforeach


        <!-- Customers Card -->
        <div class="col-xxl-4 col-xl-12">

          <div class="card info-card customers-card">
            <div class="card-body">
              <h5 class="card-title">Prêt <span>| total</span></h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-cash-stack"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $user->loan->count() }}</h6>
                  <span class="text-danger small pt-1 fw-bold">Prêts au total</span> <span class="text-muted small pt-2 ps-1"></span>
                </div>
              </div>
            </div>
          </div>

        </div><!-- End Customers Card -->

        <!-- Reports -->
        <div class="col-12">
          <div class="card">

            <!--<div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>-->

            <div class="card-body">
              <h5 class="card-title">Rapport <span></span></h5>

              <!-- Line Chart -->
              <div id="reportsChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#reportsChart"), {
                    series: [{
                      name: 'Sales',
                      data: [31, 40, 28, 51, 42, 82, 56],
                    }, {
                      name: 'Revenue',
                      data: [11, 32, 45, 32, 34, 52, 41]
                    }, {
                      name: 'Customers',
                      data: [15, 11, 32, 18, 9, 24, 11]
                    }],
                    chart: {
                      height: 350,
                      type: 'area',
                      toolbar: {
                        show: false
                      },
                    },
                    markers: {
                      size: 4
                    },
                    colors: ['#4154f1', '#2eca6a', '#ff771d'],
                    fill: {
                      type: "gradient",
                      gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      curve: 'smooth',
                      width: 2
                    },
                    xaxis: {
                      type: 'datetime',
                      categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                    },
                    tooltip: {
                      x: {
                        format: 'dd/MM/yy HH:mm'
                      },
                    }
                  }).render();
                });
              </script>
              <!-- End Line Chart -->
            </div>

          </div>
        </div><!-- End Reports -->
      </div>
    </div><!-- End Left side columns -->

    <!-- Right side columns -->
    <div class="col-lg-4">

          <!-- News & Updates Traffic -->
      <div class="card">
        <div class="card-body pb-0">
          <h5 class="card-title">Transactions récentes <span></span></h5>
            <div class="news">
            @foreach($user->operation->where('status', 'completed')->sortByDesc('id')->take(5) as $operation)
                @if($operation->operation_type_id == 2)
                    <div class="post-item clearfix">
                    <img src="assets/img/transaction.png" alt="" width="20" height="40">
                        <p>Vous avez <a href="#" class="fw-bold text-dark">retiré</a> 
                        <a href="#" class="fw-bold text-dark">{{$operation->withdrawal_amount}} FCFA</a> de votre compte le 
                        <a href="#" class="fw-bold text-dark">{{ strftime('%d %B %Y', strtotime($operation->withdrawal_date)) }}</a></p>
                    </div>
                @elseif($operation->operation_type_id == 1)
                    <div class="post-item clearfix">
                    <img src="assets/img/transaction.png" alt="" width="20" height="40">
                        <p>Vous avez <h4>déposé</h4><h4>{{$operation->withdrawal_amount}} FCFA</h4> 
                        de votre compte le {{ strftime('%d %B %Y', strtotime($operation->withdrawal_date)) }}</p>
                    </div>
                @elseif($operation->operation_type_id == 3)
                    <div class="post-item clearfix">
                    <img src="assets/img/transaction.png" alt="" width="20" height="40">
                        <p>Vous avez <a href="#" class="fw-bold text-dark">viré</a> <a href="#" class="fw-bold text-dark">{{$operation->withdrawal_amount}} FCFA
                        </a> à Mr/Mlle <a href="#" class="fw-bold text-dark">{{$operation->beneficiaire}}</a> 
                        le <a href="#" class="fw-bold text-dark">{{ strftime('%d %B %Y', strtotime($operation->withdrawal_date)) }}</a></p>
                    </div>
                @endif
            @endforeach
          </div><!-- End sidebar recent posts-->

        </div>
      </div><!-- End News & Updates -->
    </div><!-- End Right side columns -->

  </div>
</section>

</main><!-- End #main -->