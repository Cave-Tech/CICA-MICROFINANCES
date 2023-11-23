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
        'user_id',
        'agent_id',
        'account_number',
        'balance',
        'account_types_id',
        'interest_rate',
        'opening_date',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function agent(){
        return $this->belongsTo(User::class);
    }

    public function accountType(){
        return $this->belongsTo(AccountType::class);
    }
}

