<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Account;
use App\Models\Operation;
use App\Models\Loan;
use App\Models\Profile;
use App\Models\EmployeeType;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profiles_id',
        'type_employe_id',
        'agent_id',
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function account(){
        return $this->hasMany(Account::class);
    }

    public function operation(){
        return $this->hasMany(Operation::class);
    }

    public function loan(){
        return $this->hasMany(Loan::class);
    }


    public function profile(){
        return $this->belongsTo(Profile::class);
    }

    public function employeeType(){
        return $this->belongsTo(EmployeeType::class);
    }



    public function user(){
        return $this->belongsTo(User::class);
    }

    public function useragent(){
        return $this->hasOne(User::class);
    }
}

