<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use App\Models\Operation;

class AccountType extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'description'
    ];


    public function account(){
        return $this->hasMany(Account::class);
    }

    public function operations()
    {
        return $this->hasMany(Operation::class, 'account_types_id');
    }
}
