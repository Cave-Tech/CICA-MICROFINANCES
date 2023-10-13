<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Loan;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pret',
        'montant_payement',
        'status',
        'canal_transaction',
        'date_payement'
    ];



    public function Loan(){
        return $this->belongsTo(Loan::class);
    }
}
