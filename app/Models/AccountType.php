<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class AccountType extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'description'
    ];


    public function Account(){
        return $this->hasMany(Account::class);
    }
}
