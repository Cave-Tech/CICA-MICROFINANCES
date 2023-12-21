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
        

    @if ($user->loan->where('status', 'pending')->isNotEmpty() || $user->loan->where('status', 'in progress')->isNotEmpty()
    || $user->loan->where('status', 'validated')->isNotEmpty())

        @elseif (!$user->loan->where('status', 'pending')->isNotEmpty())
        <!-- Pas de demande de prêt en attente -->
        <div class="left-align">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loanModal">
                Nouveau Prêt
            </button>
        </div><br>

        <div class="card border-danger">
            <div class="card-body">
                <h5 class="card-title text-danger"><i class="bi bi-exclamation-triangle-fill text-danger"></i> Informations sur les taux d'intérêt !</h5>
                <p>
                    Nous proposons les taux d'intérêt suivants en fonction du montant de votre prêt :
                </p>
                <ul>
                    <li>Entre 1000 Fcfa et 100000 Fcfa : <span class="text-danger">Taux d'intérêt de 5% </span> </li>
                    <li>Entre 100000 Fcfa et 200000 Fcfa : <span class="text-danger">Taux d'intérêt de 10%</span></li>
                    <li>Plus de 200000 Fcfa : <span class="text-danger">Taux d'intérêt de 15%</span></li>
                </ul>
                <p>
                    Ces taux sont appliqués en fonction de la plage dans laquelle se situe le montant de votre prêt.
                </p>
            </div>
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
                                    <input type="number" wire:model="amount" class="form-control" id="loanAmount" placeholder="Montant du Prêt" required>
                                    <x-input-error :messages="$errors->get('amount')" class="mt-2 alert alert-danger" />
                                </div><br>

                                <div class="form-group">
                                    <input type="number" wire:model="loanTerm" class="form-control" placeholder="Durée du Prêt (mois)" required>
                                    <x-input-error :messages="$errors->get('loanTerm')" class="mt-2 alert alert-danger" />
                                </div>

                                <div class="col-md-12">
                                    <select wire:model="typeloan" class="form-select" aria-label="Type d'opération" required>
                                        <option value="">Choisissez le type de prêt</option>
                                        <option value="1">Prêt hypothécaire</option>
                                        <option value="2">Prêt étudiant</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('typeloan')" class="mt-2 alert alert-danger" />
                                </div><br>
                                <div class="col-md-12">
                                    <select wire:model="typeWarranty" class="form-select" aria-label="Type d'opération" required>
                                        <option value="">Type de garantie</option>
                                        <option value="1">Bien immobilier</option>
                                        <option value="2">Autre bien</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('typeWarranty')" class="mt-2 alert alert-danger" />
                                </div><br>

                                <div class="form-group">
                                    <input type="number" class="form-control" wire:model="valueWarranty" placeholder="Valeur du garantie en FCFA" id="interestRate" required>
                                    <x-input-error :messages="$errors->get('valueWarranty')" class="mt-2 alert alert-danger" />
                                </div><br>

                                <div class="form-group">
                                    <textarea class="form-control" wire:model="detailsWarranty" placeholder="Details du garantie" style="height: 100px" required></textarea>
                                    <x-input-error :messages="$errors->get('detailsWarranty')" class="mt-2 alert alert-danger" />
                                </div><br>

                                <div class="form-group">
                                    <textarea class="form-control" wire:model="purposeWarranty" placeholder="Plan de remboussement" style="height: 100px" required></textarea>
                                    <x-input-error :messages="$errors->get('purposeWarranty')" class="mt-2 alert alert-danger" />
                                </div><br>

                                <div class="form-group">
                                    <input type="text" class="form-control" wire:model="nameWarrantor" placeholder="Nom & Prénom du temoins" id="interestRate" required>
                                    <x-input-error :messages="$errors->get('nameWarrantor')" class="mt-2 alert alert-danger" />
                                </div><br>

                                <div class="form-group">
                                    <input type="number" class="form-control" wire:model="numWarrantor" placeholder="Numéro du temoins" id="interestRate" required>
                                    <x-input-error :messages="$errors->get('numWarrantor')" class="mt-2 alert alert-danger" />
                                </div><br>

                                <div class="form-group">
                                    <input type="text" class="form-control" wire:model="addressWarrantor" placeholder="Address du témoins" id="interestRate" required>
                                    <x-input-error :messages="$errors->get('addressWarrantor')" class="mt-2 alert alert-danger" />
                                </div>

                                <div class="col-md-12">
                                <label for="interestRate"></label>
                                    <select wire:model="relationWarrantor" class="form-select" aria-label="Type d'opération" required>
                                        <option value="">Relation du temoins</option>
                                        <option value="1">Parents</option>
                                        <option value="2">Amis</option>
                                        <option value="3">Autres</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('relationWarrantor')" class="mt-2 alert alert-danger" />
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
      <h1>Mes prêts</h1>
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
                    @if ($loan->status === 'validated')
                        <span class="badge bg-success">Valider</span>
                    @elseif ($loan->status === 'pending')
                        <span class="badge bg-warning text-dark">En attente</span>
                    @elseif ($loan->status === 'in progress')
                        <span class="badge bg-info">En cours</span>
                    @elseif ($loan->status === 'completed')
                        <span class="badge bg-success">Solder</span> 
                    @else
                        <span class="badge bg-danger">Rejeté</span>
                    @endif
                    </td>
                    <td>{{ strftime('%d %B %Y', strtotime($loan->loan_date)) }}</td>
                    <td>    
                    <a href="{{ route('client.details-loan', ['loanId' => $loan->id]) }}"><button  class="btn btn-primary"><i class='bi bi-eye'></i></button></a>
                    @if($loan->status === 'pending')
                    <button wire:click="showEditLoan({{ $loan->id }})" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal1{{ $loan->id }}" class="btn btn-primary"><i class='bi bi-pencil'></i></button>&nbsp
                    @endif
                    </td>
                  </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
                @foreach($user->loan as $loan)
                <!-- Moadal Show loan -->
                <div class="modal fade" wire:ignore.self id="confirmDeleteModal1{{ $loan->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel{{ $loan->id }}" role="dialog" aria-labelledby="loanModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form wire:submit.prevent="EditLoan" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel{{ $loan->id }}">Formulaire de Prêt</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                            <!--<input type="" wire:model="idloan" value="{{$loan->id}}" class="form-control" id="loanAmount">-->
                                        <div class="form-group">
                                            <input type="number" wire:model="amount" value="{{$loan->loan_amount}}" class="form-control" id="loanAmount" required>
                                            <x-input-error :messages="$errors->get('amount')" class="mt-2 alert alert-danger" />
                                        </div><br>

                                        <div class="form-group">
                                            <input type="number" wire:model="loanTerm" value="{{$loan->loanTerm}}" class="form-control" placeholder="Durée du Prêt (mois)" required>
                                            <x-input-error :messages="$errors->get('loanTerm')" class="mt-2 alert alert-danger" />
                                        </div>

                                        <div class="col-md-12">
                                            <select wire:model="typeloan" class="form-select" value="{{$loan->loan_type_id}}" aria-label="Type d'opération" required>
                                                <option value="1">Prêt hypothécaire</option>
                                                <option value="2">Prêt étudiant</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('typeloan')" class="mt-2 alert alert-danger" />
                                        </div><br>
                                        <div class="col-md-12">
                                            <select wire:model="typeWarranty" value="{{$loan->type_warranty}}" class="form-select" aria-label="Type d'opération" required>
                                                <option value="1">Bien immobilier</option>
                                                <option value="2">Autre bien</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('typeWarranty')" class="mt-2 alert alert-danger" />
                                        </div><br>

                                        <div class="form-group">
                                            <input type="number" class="form-control" wire:model="valueWarranty" value="{{$loan->value_warranty}}" id="interestRate" required>
                                            <x-input-error :messages="$errors->get('valueWarranty')" class="mt-2 alert alert-danger" />
                                        </div><br>

                                        <div class="form-group">
                                            <textarea class="form-control" wire:model="detailsWarranty" value="{{$loan->details_warranty}}" style="height: 100px" required></textarea>
                                            <x-input-error :messages="$errors->get('detailsWarranty')" class="mt-2 alert alert-danger" />
                                        </div><br>

                                        <div class="form-group">
                                            <textarea class="form-control" wire:model="purposeWarranty" value="{{$loan->purpose_warranty}}"  style="height: 100px" required></textarea>
                                            <x-input-error :messages="$errors->get('purposeWarranty')" class="mt-2 alert alert-danger" />
                                        </div><br>

                                        <div class="form-group">
                                            <input type="text" class="form-control" wire:model="nameWarrantor" value="{{$loan->name_warrantor}}" id="interestRate" required>
                                            <x-input-error :messages="$errors->get('nameWarrantor')" class="mt-2 alert alert-danger" />
                                        </div><br>

                                        <div class="form-group">
                                            <input type="number" class="form-control"  wire:model="numWarrantor" value="{{$loan->number_warrantor}}" id="interestRate" required>
                                            <x-input-error :messages="$errors->get('numWarrantor')" class="mt-2 alert alert-danger" />
                                        </div><br>

                                        <div class="form-group">
                                            <input type="text" class="form-control" wire:model="addressWarrantor" value="{{$loan->address_warrantor}}" id="interestRate" required>
                                            <x-input-error :messages="$errors->get('addressWarrantor')" class="mt-2 alert alert-danger" />
                                        </div>

                                        <div class="col-md-12">
                                        <label for="interestRate"></label>
                                            <select wire:model="relationWarrantor" value="{{$loan->relation_warrantor}}" class="form-select" aria-label="Type d'opération" required>
                                                <!--<option value="{{$loan->relation_warrantor}}">{{$loan->relation_warrantor}}</option>-->
                                                <option value="Parent">Bien immobilier</option>
                                                <option value="Amis">Autres biens</option>
                                                <option value="Autre">Autres biens</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('relationWarrantor')" class="mt-2 alert alert-danger" />
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
                @endforeach
                <!-- End Moadal Show loan -->
            </div>
          </div>
        </div>
      </div>
    </section>
</main>
 <!-- End #main -->