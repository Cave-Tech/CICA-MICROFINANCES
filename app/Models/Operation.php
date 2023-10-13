<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OperationType;


class Operation extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'idagent',
        'OperationType_id',
        'montant_retrait',
        'moyen_de_retrait',
        'date_retrait',
    ];
    public function User(){
        return $this->belongsTo(User::class);
    }

    public function OperationType(){
        return $this->belongsTo(OperationType::class);
    }
}
