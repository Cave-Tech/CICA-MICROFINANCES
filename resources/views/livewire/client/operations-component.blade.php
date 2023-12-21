<main id="main" class="main">
          <!-- Message de succes ou d'erreur -->
    @if($message = Session::get('success'))
        <div id="success-alert" class="alertt alert-success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <p>{{$message}}</p>
        </div>
    @endif

    @if($message = Session::get('fail'))
        <div id="fail-alert" class="alert alert-danger">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <p>{{$message}}</p>
        </div>
    @endif
    <!--Fin Message de succes ou d'erreur -->


      <div class="container">
          <!-- Vertically centered Modal -->
          <div class="left-align">

          
          <!-- Affichez le bouton uniquement si l'utilisateur a un compte bancaire -->
          @if ($userAccounts->count() > 0)
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                  Faites un dépôt ou un retrait
              </button>
          @else
          <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            Vous n'avez pas un compte ! Veuillez vous rapprocher de notre agence afin de créer un compte courant et/ou épagne pour avoir
            accès aux opérations à distance.
          </div>
          @endif


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
                      <div class="col-md-12">
                        <input type="number" class="form-control" wire:model="montant" placeholder="Entrer le montant" required>
                      </div>
                      <div class="col-md-12" id="champsSupplementaires2">
                        <select id="typeAccount" wire:model="typeAccount" class="form-select" aria-label="Default select example" required>
                          <option seleted>Choisir un compte</option>
                            @if(!is_null($userAccounts))
                                @foreach($userAccounts as $userAccount)
                                    <option value="{{ $userAccount->id }}">
                                        @if($userAccount->account_types_id == 1)
                                            Compte courant - {{ $userAccount->account_number }}
                                        @elseif($userAccount->account_types_id == 2)
                                            Compte épargne - {{ $userAccount->account_number }}
                                        @endif
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('typeAccount') <span class="text-danger">{{ $message }}</span> @enderror
                      </div>

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
                      <td>{{ $operation->withdrawal_amount }} FCFA</td>
                      
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
                      if($statuss =="completed"){
                        echo "<span class='badge bg-success'>Terminé</span>";
                      }elseif($statuss =="pending"){
                        echo "<span class='badge bg-warning'>En cours</span>";
                      }else{
                        echo"<span class='badge bg-danger'>Annuler</span>";
                      }
                      ?>
                      </td>

                        <td>
                          {{ strftime('%d %B %Y', strtotime($operation->withdrawal_date)) }}
                        </td>
                        
                      <td>
                      <div class="btn-group" role="group">
                        <!--Afficher bouton delete et showedit-->
                        @if ($operation->status == "pending")
                            <button wire:click="showEdit({{ $operation->id }})" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal1{{ $operation->id }}" class="btn btn-primary"><i class='bi bi-pencil'></i></button>&nbsp
                            <button wire:click="confirmDelete({{ $operation->id }})" class='btn btn-danger' data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $operation->id }}"><i class='bi bi-trash'></i></button>
                        @elseif($operation->status == "completed")
                            <button class='btn btn-success'>Terminé</button>
                        @else
                        <button class='btn btn-danger'>Annuler</button>
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
                                          <input type="hidden" class="form-control" wire:model="typeOperation" >
                                      </div>
                                      @if($operation->operation_type_id == 3)
                                      <div class="col-md-12">
                                          <input class="form-control" type="text" wire:model="beneficiaire" >
                                      </div>
                                      <div class="col-md-12">
                                          <input class="form-control" type="text" wire:model="compte_de_destination">
                                      </div>
                                      <div class="col-md-12">
                                          <input type="text" class="form-control" wire:model="motif">
                                      </div>
                                      @endif
                                      <div class="col-md-12">
                                          <input type="number" class="form-control" wire:model="montant">
                                      </div>
                                      <input type="hidden" value="{{ $typeAccount }}" class="form-control" wire:model="typeAccount">
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