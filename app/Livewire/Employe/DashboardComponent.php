<?php

namespace App\Livewire\Employe;

use App\Models\Account;
use App\Models\Loan;
use App\Models\Operation;
use App\Models\User;
use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        $totalClients = User::where('profile_id', 3)->count();
        $totalCashiers = User::where('employee_type_id', 1)->count();
        $totalFieldAgents = User::where('employee_type_id', 3)->count();
        $totalHrManagers = User::where('employee_type_id', 6)->count();
        $totalClientManagers = User::where('employee_type_id', 5)->count();

        $totalDeposits = Operation::where('operation_type_id', 1)->count();
        $totalDepositAmount = Operation::where('operation_type_id', 1)->sum('withdrawal_amount');
        $totalWithdrawals = Operation::where('operation_type_id', 2)->count();
        $totalWithdrawalAmount = Operation::where('operation_type_id', 2)->sum('withdrawal_amount');
        $totalVirements = Operation::where('operation_type_id', 3)->count();
        $totalVirementAmount = Operation::where('operation_type_id', 3)->sum('withdrawal_amount');

        $totalSavings = Account::where('account_types_id', 1)->count();
        $totalSavingsAmount = Account::where('account_types_id', 1)->sum('balance');
        // $totalCurrents = Account::where('account_types_id', 2)->count();
        // $totalCurrentAmount = Account::where('account_types_id', 2)->sum('balance');

        $totalLoans = Loan::count();
        $totalLoanAmount = Loan::sum('loan_amount');

        $totalOperations = Operation::count();
        $totalOperationAmount = Operation::sum('withdrawal_amount');

        return view('livewire.employe.dashboard-component', [
            'totalClients' => $totalClients,
            'totalCashiers' => $totalCashiers,
            'totalFieldAgents' => $totalFieldAgents,
            'totalHrManagers' => $totalHrManagers,
            'totalClientManagers' => $totalClientManagers,
            'totalLoans' => $totalLoans,
            'totalLoanAmount' => $totalLoanAmount,
            'totalOperations' => $totalOperations,
            'totalOperationAmount' => $totalOperationAmount,
            'totalDeposits' => $totalDeposits,
            'totalDepositAmount' => $totalDepositAmount,
            'totalWithdrawals' => $totalWithdrawals,
            'totalWithdrawalAmount' => $totalWithdrawalAmount,
            'totalVirements' => $totalVirements,
            'totalVirementAmount' => $totalVirementAmount,
            'totalSavings' => $totalSavings,
            'totalSavingsAmount' => $totalSavingsAmount,
            // 'totalCurrents' => $totalCurrents,
            // 'totalCurrentAmount' => $totalCurrentAmount,

        ]);

       
    }
}
