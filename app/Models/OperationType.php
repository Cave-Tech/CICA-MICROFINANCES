<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Operation;

class OperationType extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'description'
    ];


    public function operation(){
        return $this->hasMany(Operation::class);
    }
}
