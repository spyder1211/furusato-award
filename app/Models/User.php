<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'is_approved',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_approved' => 'boolean',
        ];
    }

    /**
     * Get the municipality profile associated with the user.
     */
    public function municipalityProfile()
    {
        return $this->hasOne(MunicipalityProfile::class);
    }

    /**
     * Get the company profile associated with the user.
     */
    public function companyProfile()
    {
        return $this->hasOne(CompanyProfile::class);
    }

    /**
     * Get the company services associated with the user.
     */
    public function companyServices()
    {
        return $this->hasMany(CompanyService::class);
    }

    /**
     * Get the municipality offers sent by this user.
     */
    public function sentMunicipalityOffers()
    {
        return $this->hasMany(MunicipalityOffer::class, 'sender_id');
    }

    /**
     * Get the municipality offers received by this user.
     */
    public function receivedMunicipalityOffers()
    {
        return $this->hasMany(MunicipalityOffer::class, 'receiver_id');
    }

    /**
     * Get the company offers sent by this municipality user.
     */
    public function companyOffers()
    {
        return $this->hasMany(CompanyOffer::class, 'municipality_user_id');
    }
}
