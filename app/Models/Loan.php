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
        'id_emprunteur',
        'id_agent',
        'id_type_pret',
        'montant_pret',
        'taux_interet',
        'frequence_paiement',
        'status',
        'date_pret',
        'date_echeance',
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Payment(){
        return $this->hasMany(Payment::class);
    }

    public function LoanType(){
        return $this->belongsTo(LoanType::class);
    }

}
