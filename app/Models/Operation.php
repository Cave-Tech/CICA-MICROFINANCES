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
        'user_id',
        'agent_id',
        'operation_type_id',
        'withdrawal_amount',
        'withdrawal_method',
        'id_employe',
        'transaction_key',
        'status',
        'withdrawal_date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function operationType()
    {
        return $this->belongsTo(OperationType::class, 'operation_type_id');
    }
}
