<main id="main" class="main">

<!--<div class="pagetitle">
  <h1>GESTION DES OPERATIONS </h1>
<div>-->
  
<!-- Ajoutez d'autres informations du profil ici -->
</div>
<!--<nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Pages</li>
      <li class="breadcrumb-item active">Contact</li>
    </ol>
  </nav>-->
</div>
<!-- End Page Title -->

        <!-- Message de succes ou d'erreur -->
        @if($message = Session::get('success'))
        <div class="alertt">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{$message}}
        </div>
        @endif
        

        <!--Fin Message de succes ou d'erreur -->
        @if($message = Session::get('fail'))
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            {{$message}}
        </div>
        @endif

<!--<div>
<p>Résultat de la génération aléatoire : {{ $randomString }}</p>
</div>

<button wire:click="generateRandomString">Générer une chaîne aléatoire</button>-->

      <div class="container">
          <!-- Vertically centered Modal -->
          <div class="left-align">
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
                        <input type="number" class="form-control" wire:model="montant" placeholder="Entrer le montant" required>
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
                          <input id="compteDestination" wire:model="compte_de_destination"  class="form-control" type="number" placeholder="Compte de destination"><br>
                          <input id="motif" wire:model="motif"  class="form-control" type="text" placeholder="Motif">
                      </div>
                      @foreach ($user->account as $account)
                      @if ($account->account_types_id === 1)
                      <div class="col-md-12">
                          <select wire:model="typeAccount" class="form-select" aria-label="Default select example">
                              <option value="1">De mon compte épagne</option>
                          </select>
                      </div>
                      @elseif($account->account_types_id === 2)
                      <div class="col-md-12">
                          <select wire:model="typeAccount" class="form-select" aria-label="Default select example">
                              <option value="1">De mon compte épagne</option>
                          </select>
                      </div>
                      @else
                      <div class="col-md-12">
                          <select wire:model="typeAccount" class="form-select" aria-label="Default select example">
                              <option value="1">De mon compte épagne</option>
                              <option value="1">De mon compte courant</option>
                          </select>
                      </div>
                      @endif
                      @endforeach

                      <!-- Code pour afficher les champs supplémentaires quant on selectionne Virement -->
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
                      <!-- Fin code pour afficher les champs supplémentaires quant on selectionne Virement -->

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
      </div><br>
            <!--<div class="container-fluid">
              <div class="row">
                  <div class="col-lg-12">
                      <div class="card">
                          <div class="card-body">
                              <h4 class="card-title">Additional content</h4>
                              <div class="card-content">
                                  <div class="alert alert-success">
                                      <h4 class="alert-heading">Well done!</h4>
                                      <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                                      <hr>
                                      <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
            </div>-->
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
                  
                  <!--Afficher les donnes dans un tableau-->
                  @foreach($operations as $operation)
                    <tr>
                      <th scope="row">{{ $operation->transaction_key }}</th>
                      <td>{{ $operation->withdrawal_amount }}</td>
                      
                      <td>
                        @if($operation->operation_type_id == 1)
                            Dépôt
                        @elseif( $operation->operation_type_id == 2)
                            Retrait
                        @else
                            Virement
                        @endif
                      </td>

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

                        <td>
                          {{ strftime('%d %B %Y', strtotime($operation->withdrawal_date)) }}
                        </td>
                        
                      <td>
                      <div class="btn-group" role="group">
                        <!--Afficher bouton delete et showedit-->
                        @if ($operation->status !== "achever")
                            <button wire:click="showEdit({{ $operation->id }})" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal1{{ $operation->id }}" class="btn btn-primary"><i class='bi bi-pencil'></i></button>&nbsp
                            <button wire:click="confirmDelete({{ $operation->id }})" class='btn btn-danger' data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $operation->id }}"><i class='bi bi-trash'></i></button>
                        @else
                            <button class='btn btn-success'><i class='bi bi-x'></i></button>
                        @endif
                        <!--Fin Afficher bouton delete et showedit-->
                    </div>
                    </td>
                  </tr>
                  @endforeach
                  <!--Fin Afficher les donnes dans un tableau-->
                  
                  <!-- Modal pour delete-->
                  @foreach($operations as $operation)
                    <div class="modal fade" wire:ignore.self id="confirmDeleteModal{{ $operation->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{ $operation->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel{{ $operation->id }}">Confirmation de suppression</h5>
                                    <button type="button"  class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir supprimer cette opération ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                    <button wire:click="deleteOperation" class="btn btn-danger">Confirmer la suppression</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!--Fin Modal pour delete-->

                <!-- Modal pour ShowEdit-->
                @foreach($operations as $operation)
                <div class="modal fade" wire:ignore.self id="confirmDeleteModal1{{ $operation->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{ $operation->id }}" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="confirmDeleteModalLabel{{ $operation->id }}">Détails de l'opération</h5>
                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <form wire:submit.prevent="editOperation" class="php-email-form">
                                  <div class="row gy-4">
                                      <div class="col-md-12">
                                          <input type="number" class="form-control" wire:model="montant" value="{{$operation->montant}}">
                                      </div>
                                      <div class="col-md-12">
                                          <select wire:model="typeOperation" class="form-select" aria-label="Type d'opération">
                                              <option value="1">Dépôt</option>
                                              <option value="2">Retrait</option>
                                              <option value="3">Virement</option>
                                          </select>
                                      </div>
                                      @if($operation->operation_type_id == 3)
                                      <div class="col-md-12">
                                          <input class="form-control" type="text" wire:model="beneficiaire" >
                                      </div>
                                      <div class="col-md-12">
                                          <input class="form-control" type="number" wire:model="compte_de_destination">
                                      </div>
                                      <div class="col-md-12">
                                          <input type="text" class="form-control" wire:model="motif">
                                      </div>
                                      @endif

                                      @foreach ($user->account as $account)
                                        @if ($account->account_types_id === 1)
                                        <div class="col-md-12">
                                            <select wire:model="typeAccount" class="form-select" aria-label="Default select example">
                                                <option value="1">De mon compte épagne</option>
                                            </select>
                                        </div>
                                        @elseif($account->account_types_id === 2)
                                        <div class="col-md-12">
                                            <select wire:model="typeAccount" class="form-select" aria-label="Default select example">
                                                <option value="2">De mon compte épagne</option>
                                            </select>
                                        </div>
                                        @else
                                        <div class="col-md-12">
                                            <select wire:model="typeAccount" class="form-select" aria-label="Default select example">
                                                <option value="1">De mon compte épagne</option>
                                                <option value="2">De mon compte courant</option>
                                            </select>
                                        </div>
                                        @endif
                                      @endforeach

                                      <div class="col-md-12">
                                          <input type="date" class="form-control" wire:model="date">
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                      <button type="submit" class="btn btn-primary">Enregistrer</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                </div>
                @endforeach
                <!--Fin Modal pour ShowEdit-->
            </tbody>
          </table>
          <!-- End Table with stripped rows -->
        </div>
      </div>
    </div>
  </div>
</section>

</main><!-- End #main -->