<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Loan;

class LoanType extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'description'
    ];


    public function loan(){
        return $this->hasMany(Loan::class);
    }
}
