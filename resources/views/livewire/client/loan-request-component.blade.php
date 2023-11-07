<main id="main" class="main">

<style>

    /* Styles pour le formulaire de prêt */
.loan-form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.loan-form h3 {
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.form-select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
}

.btn-primary:hover {
    background-color: #0056b3;
}

</style>
    
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


     
<div class="container">
        

        @if ($user->loan->where('status', 'pending')->isNotEmpty())

            <!-- Il y a une demande de prêt en attente -->
            <form wire:submit.prevent="EditLoan" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" wire:model="loan_amount" value="{{ $user->loan->where('status', 'pending')->first()->loan_amount }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <select wire:model="typeloan" class="form-select" value="{{ $user->loan->where('status', 'pending')->first()->loan_type_id }}" required>
                                <option value="" disabled>Choisissez le type de prêt</option>
                                <option value="1">Prêt hypothécaire</option>
                                <option value="2">Prêt étudiant</option>
                                <option value="3">Prêt personnel</option>
                                <option value="4">Autre</option>
                            </select>
                        </div>
                        <!-- Autres champs de formulaire... -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" value="{{ $user->loan->where('status', 'pending')->first()->details_warranty }}" wire:model="details_warranty" rows="3" >
                        </div>
                        <div class="form-group">
                            <input class="form-control" value="{{ $user->loan->where('status', 'pending')->first()->purpose_warranty }}" wire:model="purpose_warranty" rows="3" >
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ $user->loan->where('status', 'pending')->first()->name_warrantor }}" wire:model="name_warrantor"  required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" value="{{ $user->loan->where('status', 'pending')->first()->number_warrantor }}" wire:model="number_warrantor" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ $user->loan->where('status', 'pending')->first()->address_warrantor }}" wire:model="address_warrantor"  required>
                        </div>
                        <div class="form-group">
                            <select wire:model="relation_warrantor" value="{{ $user->loan->where('status', 'pending')->first()->relation_warrantor }}" class="form-select" required>
                                
                                <option value="Parent">Parent</option>
                                <option value="Amis">Amis</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Champs de fichier pour les documents supplémentaires -->
                <div class="form-group">
                    <label for="docFiles">Documents supplémentaires</label>
                    <input type="file" wire:model="docFiles" class="form-control" id="docFiles" required>
                </div>

                <!-- Bouton d'envoi de la demande -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Envoyer la demande</button>
                </div>
            </form>

        @elseif (!$user->loan->where('status', 'pending')->isNotEmpty())
        <!-- Pas de demande de prêt en attente -->
        <div class="left-align">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loanModal">
                Nouveau Prêt
            </button>
        </div>
    @endif


        <div class="modal fade" id="loanModal" tabindex="-1" role="dialog" aria-labelledby="loanModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form wire:submit.prevent="saveLoan" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="loanModalLabel">Formulaire de Prêt</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="form-group">
                                    <input type="number" wire:model="amount" class="form-control" id="loanAmount" placeholder="Montant du Prêt">
                                </div><br>
                                <div class="col-md-12">
                                    <select wire:model="typeloan" class="form-select" aria-label="Type d'opération" required>
                                        <option >Choisissez le type de prêt</option>
                                        <option value="1">Prêt hypothécaire</option>
                                        <option value="2">Prêt étudiant</option>
                                        <option value="3">Prêt personnel</option>
                                        <option value="4">Autre</option>
                                    </select>
                                </div><br>
                                <div class="col-md-12">
                                    <select wire:model="typeWarranty" class="form-select" aria-label="Type d'opération" required>
                                        <option >Type de garantie</option>
                                        <option value="1">Bien immobilier</option>
                                        <option value="2">Autre bien</option>
                                    </select>
                                </div><br>

                                <div class="form-group">
                                    <input type="number" class="form-control" wire:model="valueWarranty" placeholder="Valeur du garantie en FCFA" id="interestRate">
                                </div><br>

                                <div class="form-group">
                                    <textarea class="form-control" wire:model="detailsWarranty" placeholder="Details du garantie" style="height: 100px"></textarea>
                                </div><br>

                                <div class="form-group">
                                    <textarea class="form-control" wire:model="purposeWarranty" placeholder="Plan de remboussement" style="height: 100px"></textarea>
                                </div><br>

                                <div class="form-group">
                                    <input type="text" class="form-control" wire:model="nameWarrantor" placeholder="Nom & Prénom du temoins" id="interestRate">
                                </div><br>

                                <div class="form-group">
                                    <input type="number" class="form-control" wire:model="numWarrantor" placeholder="Numéro du temoins" id="interestRate">
                                </div><br>

                                <div class="form-group">
                                    <input type="text" class="form-control" wire:model="addressWarrantor" placeholder="Address du témoins" id="interestRate">
                                </div>

                                <div class="col-md-12">
                                <label for="interestRate"></label>
                                    <select wire:model="relationWarrantor" class="form-select" aria-label="Type d'opération" required>
                                        <option >Relation du temoins</option>
                                        <option value="1">Bien immobilier</option>
                                        <option value="2">Autres biens</option>
                                    </select>
                                </div><br>

                                <!--<div class="form-group">
                                    <input type="file" wire:model="docFiles"  class="form-control">
                                </div>-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Enregistrer le Prêt</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="pagetitle">
      <h1>Data Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Prêt</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Type du prêt</th>
                    <th scope="col">Montant</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($user->loan as $loan)
                  <tr>
                    <th scope="row">
                        @if($loan->loan_amount == 1)
                        <span class='badge bg-info'>pret automobile</span>
                        @else
                        <span class='badge bg-info'>pret immobilier</span><div></div>
                        @endif
                    </th>
                    <td>{{$loan->loan_amount}} FCFA</td>
                    <td>
                    <?php 
                      $statuss = $loan->status;
                      if($statuss =="validated"){
                        echo "<span class='badge bg-success'>Terminé</span>";
                      }elseif($statuss =="pending"){
                        echo "<span class='badge bg-warning'>En cours</span>";
                      }else{
                        echo"<span class='badge bg-danger'>rejected</span>";
                      }
                      ?>
                    </td>
                    <td>{{ strftime('%d %B %Y', strtotime($loan->due_date)) }}</td>
                    <td>    
                    <a href="{{ route('client.details-loan', ['loanId' => $loan->id]) }}"><button  class="btn btn-primary"><i class='bi bi-eye'></i></button></a>
                        <!--<button wire:click="confirmDelete({{ $loan->id }})" class='btn btn-danger' data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $loan->id }}"><i class='bi bi-trash'></i></button>-->
                    </td>
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
  </main>
 <!-- End #main -->