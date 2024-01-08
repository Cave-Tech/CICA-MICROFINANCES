<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Loan;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'loan_id',
        'user_id',
        'payment_amount',
        'status',
        'transaction_channel',
        'payment_date',
        'expected_payment_date',
    ];



    public function loan(){
        return $this->belongsTo(Loan::class);
    }
}
