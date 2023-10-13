<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AccountType;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'solde',
        'account_types_id',
        'taux_interet',
        'date_ouverture'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function AccountType(){
        return $this->belongsTo(AccountType::class);
    }
}

