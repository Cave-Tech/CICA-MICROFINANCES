<?php

namespace App\Livewire\Employe;

use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LatePaymentComponent extends Component
{
    public $search = '';
    public $loanInProgress;

    public $paymentAmount;
    public $loanAmount;
    public $latePayments; // Paiements du jour pour l'agent connecté

    public function remainingAmount($loan)
    {
        // $totalPaid = $loan->payment->sum('payment_amount');
        // $totalAmount = $loan->loan_amount * (1 + ($loan->interest_rate / 100));

        // Calculer le total des paiements qui ne sont ni validés ni annulés (c'est-à-dire en attente ou en retard)
        $totalPaid = $loan->payment
            ->whereIn('status', ['pending', 'late'])
            ->sum('payment_amount');

            

        return $totalPaid;
    }

    public function totalAmount($loan)
    {
        // $totalPaid = $loan->payment->sum('payment_amount');
        // $totalAmount = $loan->loan_amount * (1 + ($loan->interest_rate / 100));

        // Calculer le total des paiements qui ne sont ni validés ni annulés (c'est-à-dire en attente ou en retard)
        $totalAmount = $loan->payment->sum('payment_amount');

        return $totalAmount;
    }

    // public function makePayment($loanId)
    // {
    //     // Récupérez le prêt associé à l'ID du prêt
    //     $loan = Loan::find($loanId);
    
    //     // Valider le montant du paiement
    //     $this->validate([
    //         'paymentAmount' => 'required|numeric|min:1',
    //     ]);
    
    //     // Récupérez tous les paiements associés à ce prêt et calculez la somme
    //     $totalPayments = Payment::where('loan_id', $loanId)->sum('payment_amount');
    
    //     // Calculez le montant restant à payer pour le prêt
    //     $remainingAmountToPay = ($loan->loan_amount * (1 + ($loan->interest_rate / 100)));
    //     $remainingAmount = $remainingAmountToPay - $totalPayments;
    //     // Vérifiez si le montant du nouveau paiement est inférieur ou égal au montant restant à payer
    //     if ($this->paymentAmount <= $remainingAmount && $this->paymentAmount != 0) {
    //         // Enregistrez le paiement dans votre base de données avec les informations nécessaires
    //         $payment = Payment::create([
    //             'loan_id' => $loanId,
    //             'user_id' => auth()->id(),
    //             'status' => "payer",
    //             'transaction_channel' => "neutre",
    //             'payment_amount' => $this->paymentAmount,
    //             'payment_date' => now(), // Utilisez la date actuelle pour la date du paiement
    //         ]);
    
    //         // Calculez à nouveau le montant total des paiements après l'enregistrement du nouveau paiement
    //         $newTotalPayments = Payment::where('loan_id', $loanId)->sum('payment_amount');
    //         // Définir une tolérance
    //         $tolerance = 0.50;

    //         $loanAmountTopay = $this->loanAmount;
    //         // Si la somme des paiements est égale au montant initial du prêt, mettez à jour le statut du prêt
    //         if (abs($loanAmountTopay - $newTotalPayments) < $tolerance) {
    //             Loan::where('id', $loan->id)->update(['status' => 'completed']);
    //         }
            
    
    //         // Effacez le champ du montant du paiement après l'enregistrement
    //         $this->paymentAmount = null;
    
    //         // Émettez un message de réussite
    //         return redirect('/payement-loan')->with("success", "Paiement effectué avec succès !");
    //     } else {
    //         // Le montant du paiement est supérieur au montant restant à payer pour le prêt
    //         return redirect('/payement-loan')->with("fail", "Montant du paiement incorrect.");
    //     }
    // }


    public $paymentAmounts = []; // Stocke les montants des paiements individuellement

    public function makePayment($paymentId)
    {
        // Assurez-vous qu'un montant de paiement a été saisi pour ce paiement spécifique
        // if (!isset($this->paymentAmounts[$paymentId]) || $this->paymentAmounts[$paymentId] < 1) {
        //     session()->flash('fail', 'Montant du paiement invalide.');
        //     return;
        // }

        // $paymentAmount = $this->paymentAmounts[$paymentId];

        // Récupérez le paiement et le prêt associé
        $payment = Payment::find($paymentId);
        $loan = $payment->loan;

        // Calculer le montant restant avant le paiement
        // $remainingAmountBeforePayment = $loan->loan_amount * (1 + ($loan->interest_rate / 100)) 
        //                                 - $loan->payment->where('status', 'validated')->sum('payment_amount');

        // Vérifier si le montant du paiement est valide
        // if ($paymentAmount <= $remainingAmountBeforePayment) {
            // Mettre à jour le paiement dans votre base de données
            $payment->update([
                'status' => 'validated',
                'payment_date' => now(),
                // 'payment_amount' => $paymentAmount,
            ]);

            // Recalculer le montant total payé après le paiement
            $totalPaidAfterPayment = $loan->payment->where('status', 'validated')->sum('payment_amount');
            $totalAmount = $loan->payment->sum('payment_amount');

            // Vérifier si tous les paiements ont été effectués
            if ($totalPaidAfterPayment >= $totalAmount) {
                // Mettre à jour le statut du prêt
                $loan->update(['status' => 'completed']);
            }

            // Émettre un message de réussite
            session()->flash('success', 'Paiement effectué avec succès !');
        // } else {
        //     // Le montant du paiement est incorrect
        //     session()->flash('fail', 'Montant du paiement incorrect.');
        // }

        // Effacer le champ du montant du paiement après l'enregistrement
        // $this->paymentAmounts[$paymentId] = null;
    }




    public function render()
    {
        
        // Récupérez les paiements du jour pour l'agent connecté
        $this->latePayments = Payment::with(['loan.borrower', 'loan.agent', 'loan.loanType'])
            ->where('status', '=', 'late')
            ->where('user_id', '=', Auth::user()->id)
            
            ->get();


        return view('livewire.employe.late-payment-component', [
            'latePayments' => $this->latePayments
        ]);
    }
}
