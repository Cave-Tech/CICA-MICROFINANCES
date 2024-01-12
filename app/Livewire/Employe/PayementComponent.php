<?php

namespace App\Livewire\Employe;
use Illuminate\Support\Facades\Auth;
use App\Models\Operation;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class PayementComponent extends Component
{
    public $search = '';
    public $loanInProgress;

    public $paymentAmount;
    public $loanAmount;
    public $todayPayments; // Paiements du jour pour l'agent connecté

    public function remainingAmount($loan)
    {
        $totalPaid = $loan->payment->sum('payment_amount');
        $totalAmount = $loan->loan_amount * (1 + ($loan->interest_rate / 100));
        return $totalAmount - $totalPaid;
    }


    public function render()
    {

        // Récupérez la date d'aujourd'hui
        $today = Carbon::today();

        // Récupérez les paiements du jour pour l'agent connecté
        $this->todayPayments = Payment::with(['loan.borrower', 'loan.agent', 'loan.loanType'])
            ->whereDate('expected_payment_date', $today)
            ->where('status', '!=', 'validated')
            ->whereHas('loan', function($query) {
                $query->where('agent_id', Auth::id()); // Filtrer les prêts assignés à l'agent connecté
            })
            ->get();

        return view('livewire.employe.payement-component', [
            'todayPayments' => $this->todayPayments
        ]);

        // Récupérez les paiements de l'agent de terrain connecté
        // $agentPayments = Payment::with(['loan.borrower', 'loan.agent', 'loan.loanType', 'loan'])
        //                     ->where('user_id', auth()->user()->id)
        //                     ->get();


        // $this->loanInProgress = Loan::with(['borrower', 'agent', 'payment', 'loanType'])
        //     ->where('status', 'in payment')
        //     ->where(function($query) {
        //         $query->where('loan_amount', 'like', '%' . $this->search . '%')
        //               ->orWhere('interest_rate', 'like', '%' . $this->search . '%')
        //               ->orWhere('payment_frequency', 'like', '%' . $this->search . '%')
        //               ->orWhere('loan_date', 'like', '%' . $this->search . '%')
        //               ->orWhere('due_date', 'like', '%' . $this->search . '%')
                      
        //               ->orWhereHas('borrower', function($subQuery) {
        //                   $subQuery->where('name', 'like', '%' . $this->search . '%')
        //                            ->orWhere('email', 'like', '%' . $this->search . '%');
        //               })
        //               ->orWhereHas('agent', function($subQuery) {
        //                   $subQuery->where('name', 'like', '%' . $this->search . '%')
        //                            ->orWhere('email', 'like', '%' . $this->search . '%');
        //               })
        //               ->orWhereHas('loanType', function($subQuery) {
        //                   $subQuery->where('designation', 'like', '%' . $this->search . '%');
        //               });
        //     })
        //     ->get();
        // return view('livewire.employe.payement-component', [
        //     'loansInProgress' => $this->loanInProgress
        // ], ['agentPayments' => $agentPayments]);
    }
    

    // public function remainingAmount($loan)
    // {
    //     // Vérifiez si la relation payments existe
    //     if ($loan->payment) {
    //         $totalPayments = $loan->payment->sum('payment_amount');
    //         $loanAmountTopay = ($loan->loan_amount * (1 + ($loan->interest_rate / 100))) - $totalPayments;

    //         $this->loanAmount = $loan->loan_amount * (1 + ($loan->interest_rate / 100));
    //         // Formater le pourcentage avec deux chiffres après la virgule
    //         $formattedRemainingAmount = number_format($loanAmountTopay);

    //         return $formattedRemainingAmount;
    //     }

    //     return '0 %';
    // }

    // Assurez-vous d'avoir la propriété suivante dans votre composant Livewire
    
    public function makePayment($loanId)
    {
        // Récupérez le prêt associé à l'ID du prêt
        $loan = Loan::find($loanId);
    
        // Valider le montant du paiement
        $this->validate([
            'paymentAmount' => 'required|numeric|min:1',
        ]);
    
        // Récupérez tous les paiements associés à ce prêt et calculez la somme
        $totalPayments = Payment::where('loan_id', $loanId)->sum('payment_amount');
    
        // Calculez le montant restant à payer pour le prêt
        $remainingAmountToPay = ($loan->loan_amount * (1 + ($loan->interest_rate / 100)));
        $remainingAmount = $remainingAmountToPay - $totalPayments;
        // Vérifiez si le montant du nouveau paiement est inférieur ou égal au montant restant à payer
        if ($this->paymentAmount <= $remainingAmount && $this->paymentAmount != 0) {
            // Enregistrez le paiement dans votre base de données avec les informations nécessaires
            $payment = Payment::create([
                'loan_id' => $loanId,
                'user_id' => auth()->id(),
                'status' => "payer",
                'transaction_channel' => "neutre",
                'payment_amount' => $this->paymentAmount,
                'payment_date' => now(), // Utilisez la date actuelle pour la date du paiement
            ]);
    
            // Calculez à nouveau le montant total des paiements après l'enregistrement du nouveau paiement
            $newTotalPayments = Payment::where('loan_id', $loanId)->sum('payment_amount');
            // Définir une tolérance
            $tolerance = 0.50;

            $loanAmountTopay = $this->loanAmount;
            // Si la somme des paiements est égale au montant initial du prêt, mettez à jour le statut du prêt
            if (abs($loanAmountTopay - $newTotalPayments) < $tolerance) {
                Loan::where('id', $loan->id)->update(['status' => 'completed']);
            }
            
    
            // Effacez le champ du montant du paiement après l'enregistrement
            $this->paymentAmount = null;
    
            // Émettez un message de réussite
            return redirect('/payement-loan')->with("success", "Paiement effectué avec succès !");
        } else {
            // Le montant du paiement est supérieur au montant restant à payer pour le prêt
            return redirect('/payement-loan')->with("fail", "Montant du paiement incorrect.");
        }
    }
    

}
