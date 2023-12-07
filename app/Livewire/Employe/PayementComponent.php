<?php

namespace App\Livewire\Employe;
use App\Models\Operation;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\User;
use Livewire\Component;

class PayementComponent extends Component
{
    public $search = '';
    public $loanInProgress;

    public $paymentAmount;

    public function render()
    {
        $this->loanInProgress = Loan::with(['borrower', 'agent', 'payment', 'loanType'])
            ->where('status', 'pending')
            ->where(function($query) {
                $query->where('loan_amount', 'like', '%' . $this->search . '%')
                      ->orWhere('interest_rate', 'like', '%' . $this->search . '%')
                      ->orWhere('payment_frequency', 'like', '%' . $this->search . '%')
                      ->orWhere('loan_date', 'like', '%' . $this->search . '%')
                      ->orWhere('due_date', 'like', '%' . $this->search . '%')
                      
                      ->orWhereHas('borrower', function($subQuery) {
                          $subQuery->where('name', 'like', '%' . $this->search . '%')
                                   ->orWhere('email', 'like', '%' . $this->search . '%');
                      })
                      ->orWhereHas('agent', function($subQuery) {
                          $subQuery->where('name', 'like', '%' . $this->search . '%')
                                   ->orWhere('email', 'like', '%' . $this->search . '%');
                      })
                      ->orWhereHas('loanType', function($subQuery) {
                          $subQuery->where('designation', 'like', '%' . $this->search . '%');
                      });
            })
            ->get();
        return view('livewire.employe.payement-component', [
            'loansInProgress' => $this->loanInProgress
        ]);
    }
    

    public function remainingAmount($loan)
    {
        // Vérifiez si la relation payments existe
        if ($loan->payment) {
            $totalPayments = $loan->payment->sum('payment_amount');
            $remainingAmount = $loan->loan_amount - $totalPayments;

            return number_format($remainingAmount, 2, ',', ' ') . ' FCFA';
        }

        return number_format($loan->loan_amount, 2, ',', ' ') . ' FCFA';
    }

    // Assurez-vous d'avoir la propriété suivante dans votre composant Livewire
    
    public function makePayment($loanId)
    {
         // Récupérez le prêt associé à l'ID du prêt
        $loan = Loan::find($loanId);
        // Valider le montant du paiement
        $this->validate([
            'paymentAmount' => 'required|numeric|min:0',
        ]);

        // Vérifiez si le montant du paiement est inférieur ou égal au montant du prêt
        if ($this->paymentAmount <= $loan->loan_amount && $this->paymentAmount != 0) {
        // Enregistrez le paiement dans votre base de données avec les informations nécessaires
        $paye = Payment::create([
            'loan_id' => $loanId,
            'user_id' => auth()->id(),
            'status'  => "payer",
            'transaction_channel'  => "neutre",
            'payment_amount' => $this->paymentAmount,
            'payment_date' => now(), // Utilisez la date actuelle pour la date du paiement
        ]);

        // Vous pouvez également mettre à jour d'autres propriétés ou effectuer des actions supplémentaires ici

        // Effacez le champ du montant du paiement après l'enregistrement
        $this->paymentAmount = null;

        // Émettez un message de réussite ou d'échec selon les besoins
            return redirect('/payement-loan')->with("success", "Paiement effectué avec succès !");
        } else {
            // Le montant du paiement est supérieur au montant du prêt
            return redirect('/payement-loan')->with("fail", "Montant du paiement incorrect.");
        }
    }

}
