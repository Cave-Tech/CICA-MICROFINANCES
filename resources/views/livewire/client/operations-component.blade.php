  <main id="main" class="main">

    <div class="pagetitle">
      <h1>GESTION DES OPERATIONS </h1>

    <div>
      
    <!-- Ajoutez d'autres informations du profil ici -->
    </div>
    <!--<nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Contact</li>
        </ol>
      </nav>-->
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

    
    <!--<div>
    <p>Résultat de la génération aléatoire : {{ $randomString }}</p>
    </div>

    <button wire:click="generateRandomString">Générer une chaîne aléatoire</button>-->


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

      <form wire:submit.prevent="saveOperation" class="php-email-form">
        <div class="row gy-4">

          <!--<div class="col-md-6">
            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
          </div>

          <div class="col-md-6 ">
            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
          </div>-->

          <div class="col-md-12">
            <input type="text" class="form-control" wire:model="montant" placeholder="Entrer le montant" required>
          </div>

                  <!--<label class="col-sm-2 col-form-label">Select</label>-->
                  <div class="col-md-12">
                  <select id="typeOperation" wire:model="typeOperation" class="form-select" aria-label="Default select example">
                      <option selected>Choisissez le type d'opération</option>
                      <option value="1">Dépôt</option>
                      <option value="2">Retrait</option>
                      <option value="3">Virement</option>
                  </select>
              </div>

<div class="col-md-12" id="champsSupplementaires" style="display: none;">
    <input id="beneficiaire" wire:model="beneficiaire"  class="form-control" type="text" placeholder="Bénéficiaire"><br>
    <input id="compteDestination" wire:model="compte_de_destination"  class="form-control" type="text" placeholder="Compte de destination"><br>
    <input id="motif" wire:model="motif"  class="form-control" type="text" placeholder="Motif">
</div>

<script>
    const typeOperationSelect = document.getElementById("typeOperation");
    const champsSupplementaires = document.getElementById("champsSupplementaires");

    typeOperationSelect.addEventListener("change", function () {
        if (typeOperationSelect.value === "3") {
            champsSupplementaires.style.display = "block";
        } else {
            champsSupplementaires.style.display = "none";
        }
    });
</script>

          <div class="col-md-12">
            <input type="date" wire:model="date" class="form-control" required>
          </div>


          <!--<div class="col-md-12">
            <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
          </div> -->
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Envoyez la demande</button>
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
                    
                    <td>
                    <?php 
                    $typetranslation = $operation->operation_type_id;
                    if($typetranslation==1){
                      echo "Depot";
                    }elseif($typetranslation==2){
                      echo "Retrait";
                    }else{
                      echo "Virement";
                    }
                    ?></td>


                    <td>
                    <?php 
                    $statuss = $operation->status;
                    if($statuss =="achever"){
                      echo "<span class='badge bg-success'>Terminé</span>";
                    }elseif($statuss =="en cours"){
                      echo "<span class='badge bg-warning'>En cours</span>";
                    }else{
                      echo"<span class='badge bg-danger'>En instance</span>";
                    }
                    ?>
                    </td>

                    <td>{{ strftime('%d %B %Y', strtotime($operation->withdrawal_date)) }}</td>

                    <td>
                      <?php 
                      $status = $operation->status;
                      if($status!="achever"){
                        echo "<span class='btn btn-primary'><i class='bi bi-pencil'></i></span>
                        <span class='btn btn-danger'><i class='bi bi-trash'></i></span>";
                      }else{
                        echo "<span class='btn btn-success'><i class='bi bi-x'></i></span>";
                      }
                      ?>
                    </td>
                  </tr>
                @endforeach
                  <!--<tr>
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
                  </tr>-->
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->