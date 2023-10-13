<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Payment;
use App\Models\LoanType;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = [
        'borrower_id',
        'agent_id',
        'loan_type_id',
        'loan_amount',
        'interest_rate',
        'payment_frequency',
        'status',
        'loan_date',
        'due_date',
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

    public function loanType()
    {
        return $this->belongsTo(LoanType::class, 'loan_type_id');
    }

}
