<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Payment;
use App\Models\LoanType;
use App\Models\LoanUserPams;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = [
        'borrower_id',
        'agent_id',
        'agent_terain_id',
        'loan_type_id',
        'loan_amount',
        'interest_rate',
        'payment_frequency',
        'status',
        'loan_date',
        'due_date',
        'type_warranty',
        'value_warranty',
        'details_warranty',
        'purpose_warranty',
        'removals_plan',
        'name_warrantor',
        'address_warrantor',
        'number_warrantor',
        'relation_warrantor',
        'doc_files',
        'applicant_type',
        'loan_reason',
        'name_crew',
        'tel_crew',
        'address_crew',
        'num_carte',
        'loan_pieces',
        'repayment_interval',
    ];


    public function payment(){
        return $this->hasMany(Payment::class);
    }

    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function agent_terain()
    {
        return $this->belongsTo(User::class, 'agent_terain_id');
    }

    public function loanType()
    {
        return $this->belongsTo(LoanType::class, 'loan_type_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'loan_user_pams');
    }

    public function loanUserPams()
    {
        return $this->hasMany(LoanUserPams::class);
    }

}
