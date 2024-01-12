<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Loan;

class LoanUserPams extends Model
{
    use HasFactory;
    protected $fillable = [
        'loan_id',
        'user_id',
    ];



    protected $table = 'loan_user_pams';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id', 'id');
    }
}
