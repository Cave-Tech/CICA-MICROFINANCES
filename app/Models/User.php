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
        'agent_id',
        'profile_id',
        'name',
        'gender',
        'birth_date',
        'nationality',
        'email',
        'phone',
        'localisation',
        'address',
        'id_type',
        'id_number',
        'profile_picture',
        'status',
        'email_verified_at',
        'password',
        'employee_type_id',
        'hiring_date',
        'position',
        'department',
        'contract_type',
        'salary',
        'education_level',
        'specific_training',
        'certifications',
        'social_security_number',
        'bank_name',
        'bank_account_number',
        'emergency_contact_name',
        'emergency_contact_relation',
        'emergency_contact_phone',
        'marital_status',
        'occupation',
        'financial_information',
        'number_of_dependents',
        'source_of_income',
        'referral',
        'client_since',
        'previous_loan_details',
        'client_type',
        'average_monthly_income',
        'ifu',
        'identity_piece',
        'identity_picture',
        'proof_of_address',

        'type_client',
        'name_company',
        'ifu_company',
        'date_create',
        'address_company',
        'activity_sector',
        'number_employed',
        'tel_company',
        'mail_company',
        'capital',
        'annual_pension',
        'detail',
        'post_occupation',
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
        return $this->hasMany(Account::class, 'user_id');
    }

    public function operation(){
        return $this->hasMany(Operation::class);
    }

    public function loan(){
        return $this->hasMany(Loan::class, 'borrower_id');
    }


    public function profile(){
        return $this->belongsTo(Profile::class);
    }

    public function employeType(){
        return $this->belongsTo(EmployeeType::class);
    }

    // public function user(){
    //     return $this->belongsTo(User::class);
    // }

    public function useragent(){
        return $this->hasOne(User::class);
    }

    public function loans()
    {
        return $this->belongsToMany(Loan::class, 'loan_user_pams');
    }
}

